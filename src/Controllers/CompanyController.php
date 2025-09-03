<?php

namespace App\Controllers;

use App\Utils\Render;
use App\Repositories\CompanyRepository;
use App\Utils\Flash;

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
            "vacancies" => $this->getVacancies($id)
        ]);
    }

    public function form()
    {
        Render::load("formCompany");
    }

    public function create()
    {
        // caso de carregar a página por GET
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return Render::load("formCompany");
        }

        // caso de enviar para o repository e criar registro
        $fields = ['name', 'cnpj', 'email', 'responsible', 'cep', 'phone', 'address', 'city', 'status', 'description'];
        $formData = [];

        foreach ($fields as $field) {
            $formData[$field] = trim($_POST[$field] ?? '');
        }

        if (!$this->companyRepository->save($formData)) {
            Flash::set('error', '❌ Falha ao cadastrar a empresa.');
        } else {
            Flash::set('success', '✅ Empresa cadastrada com sucesso!');
        }

        header("Location: /mvc-php/company/form");
        exit;
    }

    public function update(string $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fields = ['name', 'cnpj', 'email', 'responsible', 'cep', 'phone', 'address', 'city', 'status', 'description'];
            $formData = [];

            foreach ($fields as $field) {
                $formData[$field] = trim($_POST[$field] ?? '');
            }
            
            $formData['id'] = trim($id ?? '');

            if (!$this->companyRepository->update($formData)) {
                Flash::set('error', 'Erro ao atualizar empresa:');
            } else {
                Flash::set('success', '✅ Alterações salvas com sucesso!');
            }

            header("Location: /mvc-php/");
            exit;
        } else {
            $company = $this->findById($id);
            Render::load("editCompany", [
                "company" => $company
            ]);
        }
    }

    public function findById(string $id)
    {
        $selectedCompany = $this->companyRepository->findById($id);
        return $selectedCompany;
    }

    public function getVacancies(string $id)
    {
        $vacancies = $this->companyRepository->getCompanyVacancies($id);
        return $vacancies;
    }
}