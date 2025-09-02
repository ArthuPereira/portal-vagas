<?php

namespace App\Controllers;

use App\Repositories\VacancyRepository;
use App\Utils\Flash;
use App\Utils\Render;

class VacancyController
{
    private VacancyRepository $vacancyRepository;

    public function __construct(VacancyRepository $vacancyRepository) {
        $this->vacancyRepository = $vacancyRepository;
    }

    public function show(string $id)
    {
        Render::load("vacancy", [
            "vacancies" => $this->getVacancies($id),
            "companyId" => $id,
            "companyName" => $this->getCompanyName($id)
        ]);
    }

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

        if (!$this->vacancyRepository->save($formData)) {
            Flash::set('error', '❌ Falha ao criar vaga.');
        } else {
            Flash::set('success', '✅ Vaga criada com sucesso!');
        }

        header("Location: /mvc-php/vacancy/" . $id);
        exit;
    }

    public function getVacancies(string $id)
    {
        $vacancies = $this->vacancyRepository->findVacanciesById($id);
        return $vacancies;
    }

    public function getCompanyName(string $id) {
        $companyName = $this->vacancyRepository->companyNameById($id);
        return $companyName;
    }
}
