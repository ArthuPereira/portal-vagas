<?php

namespace App\Controllers;

use App\Models\ResumeModel;
use App\Repositories\ResumeRepository;
use App\Utils\Flash;
use App\Utils\Render;

class ResumeController
{
    private ResumeRepository $resumeRepository;

    public function __construct(ResumeRepository $resumeRepository) {
        $this->resumeRepository =$resumeRepository;
    }

    /**
     * carrega a página com os currículos de uma empresa
     * * home com erro para id inválido
    */
    public function show(int $companyId): void
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        if ($companyId < 0) {
            Flash::set('error', 'Acesso inválido!');
            header("Location: {$baseUrl}/");
            exit;
        }

        Render::load("resume", [
            "companyId" => $companyId,
            "companyName" => $this->getCompanyName($companyId),
            "resumes" => $this->getResumes($companyId),
            "vacancies" => $this->getVacancies($companyId)
        ]);
    }

    /**
     * função que cuida da criação de um currículo
     * * redireciona para home se a rota não for válida
    */
    public function create($id): void 
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flash::set('error', 'Acesso inválido');
            header("Location: {$baseUrl}/");
            exit;
        }

        $fields = ['name', 'email', 'phone', 'requirements', 'vacancy_id'];
        $formData = [];

        foreach ($fields as $field) {
            $formData[$field] = trim($_POST[$field] ?? '');
        }
        $formData['company_id'] = $id;
        $formData['resume'] = $_FILES['resume'];
        
        try {
            // cria a model
            $resume = ResumeModel::fromArray($formData);

            // salva o arquivo no servidor
            $resume->saveFile(__DIR__ . '/../../uploads/resumes');

            // insere no banco
            $this->resumeRepository->save($resume);

            Flash::set('success', 'Currículo enviado com sucesso!');
            header("Location: {$baseUrl}/resume/" . $id);
            exit;

        } catch (\Exception $e) {
            Flash::set('error', 'Erro ao enviar o currículo: ' . $e->getMessage());
            header("Location: {$baseUrl}/resume/" . $id);
            exit;
        }
    }

    public function getResumes(int $companyId): array
    {
        $resumes = $this->resumeRepository->findResumesByCompany($companyId);
        return $resumes;
    }
    
    /**
     * recupera o nome de uma empresa
     * * home com mensagem de erro para id inválido
    */
    public function getCompanyName(int $companyId): string
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        $companyName = $this->resumeRepository->findCompanyNameById($companyId);

        if (is_null($companyName)) {
            Flash::set('error', 'Acesso inválido!');
            header("Location: {$baseUrl}/");
            exit;
        }

        return $companyName;
    }

    public function getVacancies(int $companyId): array
    {
        $vacancies = $this->resumeRepository->findVacanciesByCompany($companyId);
        return $vacancies;
    }
}
