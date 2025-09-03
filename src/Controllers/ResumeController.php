<?php

namespace App\Controllers;

use App\Models\ResumeModel;
use App\Repositories\ResumeRepository;
use App\Utils\Flash;
use App\Utils\Render;

require_once __DIR__ . '/../Models/ResumeModel.php';
require_once __DIR__ . '/../Repositories/ResumeRepository.php';
require_once __DIR__ . '/../Core/Database.php';

class ResumeController
{
    private ResumeRepository $resumeRepository;

    public function __construct(ResumeRepository $resumeRepository) {
        $this->resumeRepository =$resumeRepository;
    }

    public function show(string $id)
    {
        Render::load("resume", [
            "companyId" => $id,
            "companyName" => $this->getCompanyName($id),
            "resumes" => $this->getResumes($id),
            "vacancies" => $this->getVacancies($id)
        ]);
    }

    public function create($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flash::set('error', 'Acesso inválido');
            header("Location: /mvc-php/");
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
            header("Location: /mvc-php/resume/" . $id);
            exit;

        } catch (\Exception $e) {
            Flash::set('error', $e->getMessage());
            header("Location: /mvc-php/resume/" . $id);
            exit;
        }
    }

    public function getResumes($companyId)
    {
        $resumes = $this->resumeRepository->findResumesByCompany($companyId);
        return $resumes;
    }

    public function getCompanyName($companyId)
    {
        $companyName = $this->resumeRepository->findCompanyNameById($companyId);
        return $companyName;
    }

    public function getVacancies($companyId)
    {
        $vacancies = $this->resumeRepository->findVacanciesByCompany($companyId);
        return $vacancies;
    }
}
