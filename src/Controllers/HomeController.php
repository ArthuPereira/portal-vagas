<?php

namespace App\Controllers;

use App\Repositories\CompanyRepository;
use App\Utils\Render;

class HomeController
{
    private CompanyRepository $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    
    /**
     * carrega a página inicial
    */
    public function index(): void
    {
        Render::load("home", [
            "companies" => $this->getCompanies()
        ]);
    }
    
    public function getCompanies(): array
    {
        $companies = $this->companyRepository->getRecentlyCompanies();
        return $companies;
    }
}
