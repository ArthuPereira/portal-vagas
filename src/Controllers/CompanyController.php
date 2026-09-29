<?php

namespace App\Controllers;

use App\Models\CompanyModel;
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
    
    /**
     * carrega a página com as informações de uma empresa
     * * home com erro para id inválido
    */
    public function show(int $id): void
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        if ($id < 0) {
            Flash::set('error', 'Acesso inválido!');
            header("Location: {$baseUrl}/");
            exit;
        }

        Render::load("company", [
            "company" => $this->findById($id),
            "vacancies" => $this->getVacancies($id)
        ]);
    }

    /**
     * carrega a página de formulário de criação da empresa
    */
    public function form(): void
    {
        Render::load("formCompany");
    }

    /**
     * função que cuida da criação de uma empresa
     * * redireciona para o formulário de criação se a rota não for válida
    */
    public function create(): void
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        // caso de carregar a página por GET
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Flash::set('error', 'Acesso inválido!');
            header("Location: {$baseUrl}/company/form");
            exit;
        }

        // caso de enviar para o repository e criar registro
        $fields = ['name', 'cnpj', 'email', 'responsible', 'cep', 'phone', 'address', 'city', 'status', 'description'];
        $formData = [];

        foreach ($fields as $field) {
            $formData[$field] = trim($_POST[$field] ?? '');
        }

        try {
            // $company = CompanyModel::fromArray($formData);
            // eventual verificação dos campos de company vem aqui

            $companyId = $this->companyRepository->save($formData);
            
            Flash::set('success', 'Empresa cadastrada com sucesso!');
            header("Location: {$baseUrl}/company/" . $companyId);
            exit;
        } catch (\Throwable $e) {
            Flash::set('error', 'Falha ao cadastrar a empresa: ' . $e->getMessage());
            header("Location: {$baseUrl}/company/form");
            exit;
        }
    }

    /**
     * função que cuida da atualização de uma empresa
     * * redireciona para home se a rota não for válida
    */
    public function update(int $id): void
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        if ($id < 0) {
            Flash::set('error', 'Acesso inválido!');
            header("Location: {$baseUrl}/");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Render::load("editCompany", [
                "company" => $this->findById($id)
            ]);
            exit;
        }

        $fields = ['name', 'cnpj', 'email', 'responsible', 'cep', 'phone', 'address', 'city', 'status', 'description'];
        $formData = [];

        foreach ($fields as $field) {
            $formData[$field] = trim($_POST[$field] ?? '');
        }
            
        $formData['id'] = trim($id ?? '');

        try {
            // $company = CompanyModel::fromArray($formData);
            // eventual verificação dos campos de company vem aqui

            $this->companyRepository->update($formData);
            
            Flash::set('success', 'Empresa atualizada com sucesso!');
            header("Location: {$baseUrl}/company/" . $id);
            exit;
        } catch (\Throwable $e) {
            Flash::set('error', 'Erro ao atualizar a empresa: ' . $e->getMessage());
            header("Location: {$baseUrl}/company/" . $id);
            exit;
        }

        header("Location: {$baseUrl}/");
        exit;
    }

    /**
     * recupera os dados de uma empresa
     * * home com mensagem de erro para id inválido
    */
    public function findById(int $id): CompanyModel
    {
        $baseUrl = defined('BASE_URL') ? BASE_URL : '';
        $selectedCompany = $this->companyRepository->findCompanyById($id);

        if (is_null($selectedCompany)) {
            Flash::set('error', 'Acesso inválido!');
            header("Location: {$baseUrl}/");
            exit;
        }

        return $selectedCompany;
    }

    public function getVacancies(int $id): int
    {
        $vacancies = $this->companyRepository->getCompanyVacancies($id);
        return $vacancies;
    }
}
