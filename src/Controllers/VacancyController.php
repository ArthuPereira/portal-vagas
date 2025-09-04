<?php

namespace App\Controllers;

use App\Repositories\VacancyRepository;
use App\Utils\Flash;
use App\Utils\Render;

class VacancyController
{
    private VacancyRepository $vacancyRepository;

    public function __construct(VacancyRepository $vacancyRepository)
    {
        $this->vacancyRepository = $vacancyRepository;
    }

    /**
     * carrega a página de vagas de uma empresa
    */
    public function show(int $id)
    {
        if ($id < 0) {
            Flash::set('error', '❌ Acesso inválido!');
            header("Location: /mvc-php/");
            exit;
        }

        Render::load("vacancy", [
            "companyId" => $id,
            "companyName" => $this->getCompanyName($id),
            "vacancies" => $this->getVacancies($id)
        ]);
    }

    /**
     * função que cuida da criação de uma vaga
    */
    public function create($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flash::set('error', 'Acesso inválido');
            header("Location: /mvc-php/");
            exit;
        }

        $fields = ['name', 'description', 'responsible', 'wage', 'requirements'];
        $formData = [];

        foreach ($fields as $field) {
            $formData[$field] = trim($_POST[$field] ?? '');
        }

        $formData['company_id'] = $id;

        try {
            // $vacancy = VacancyModel::fromArray($formData);
            // eventual verificação dos campos de vacancy vem aqui

            $this->vacancyRepository->save($formData);
            
            Flash::set('success', '✅ Vaga cadastrada com sucesso!');

        } catch (\Throwable $e) {
            Flash::set('error', '❌ Falha ao criar a vaga: ' . $e->getMessage());
            
        }

        header("Location: /mvc-php/vacancy/" . $id);
        exit;
    }

    public function getVacancies(int $companyId): array
    {
        $vacancies = $this->vacancyRepository->findVacanciesById($companyId);
        return $vacancies;
    }

    /**
     * recupera o nome da empresa para qual a vaga está sendo criada
     * * home com mensagem de erro para id inválido
    */
    public function getCompanyName(int $companyId): string 
    {
        $companyName = $this->vacancyRepository->companyNameById($companyId);

        if (is_null($companyName)) {
            Flash::set('error', '❌ Acesso inválido!');
            header("Location: /mvc-php/");
            exit;
        }

        return $companyName;
    }
}
