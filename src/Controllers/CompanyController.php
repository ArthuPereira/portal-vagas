<?php

namespace App\Controllers;

use App\Utils\Render;
use App\Repositories\CompanyRepository;


class CompanyController
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function show(string $id)
    {
        Render::load("company", [
            "company" => $this->findById($id),
            "vacancies" => $this->getVancacies($id)
        ]);
    }

    public function findById(string $id)
    {
        $selectedCompany = $this->companyRepository->findById($id);
        return $selectedCompany;
    }

    public function getVancacies(string $id)
    {
        $vacancies = $this->companyRepository->getCompanyVacancies($id);
        return $vacancies;
    }
}