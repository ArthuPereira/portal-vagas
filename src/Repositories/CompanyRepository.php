<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\CompanyModel;
use PDO;

class CompanyRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function save(array $data): bool
    {
        $sql = "INSERT INTO companies (name, cnpj, email, responsible, cep, phone, address, city, status, description) 
                VALUES 
                (:name, :cnpj, :email, :responsible, :cep, :phone, :address, :city, :status, :description)";
        
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":name" => $data['name'],
            ":cnpj" => $data['cnpj'],
            ":email" => $data['email'],
            ":responsible" => $data['responsible'],
            ":cep" => $data['cep'],
            ":phone" => $data['phone'],
            ":address" => $data['address'],
            ":city" => $data['city'],
            ":status" => $data['status'],
            ":description" => $data['description']
        ]);
    }

    public function getRecentlyCompanies(): ?array
    {
        $stmt = $this->pdo->query("SELECT id, cnpj, name, phone, address, created_at FROM companies ORDER BY created_at DESC LIMIT 3");
        $stmt->setFetchMode(PDO::FETCH_CLASS, CompanyModel::class);

        $companies = $stmt->fetchAll();
        
        return $companies;
    }

    public function findById(string $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM companies WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $company = $stmt->fetchObject(CompanyModel::class);
        return $company;
    }

    public function getCompanyVacancies(string $id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM vacancies WHERE company_id = :company_id");
        $stmt->bindValue(":company_id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $totalVacancies = $stmt->fetchColumn();
        return $totalVacancies;
    }
}
