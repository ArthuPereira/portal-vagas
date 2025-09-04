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

    public function save(array $data): ?int
    {
        $sql = "
                INSERT INTO 
                    companies (name, cnpj, email, responsible, cep, phone, address, city, status, description) 
                VALUES 
                    (:name, :cnpj, :email, :responsible, :cep, :phone, :address, :city, :status, :description)
        ";
        
        $stmt = $this->pdo->prepare($sql);

        $state =  $stmt->execute([
            ":name"        => $data['name'],
            ":cnpj"        => $data['cnpj'],
            ":email"       => $data['email'],
            ":responsible" => $data['responsible'],
            ":cep"         => $data['cep'],
            ":phone"       => $data['phone'],
            ":address"     => $data['address'],
            ":city"        => $data['city'],
            ":status"      => $data['status'],
            ":description" => $data['description'],
        ]);

        if ($state) {
            return (int) $this->pdo->lastInsertId();
        }

        return null;
    }

    public function update(array $data): bool
    {
        $sql = "
            UPDATE companies
            SET 
                name        = :name,
                cnpj        = :cnpj,
                email       = :email,
                responsible = :responsible,
                cep         = :cep,
                phone       = :phone,
                address     = :address,
                city        = :city,
                status      = :status,
                description = :description
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":name"        => $data['name'],
            ":cnpj"        => $data['cnpj'],
            ":email"       => $data['email'],
            ":responsible" => $data['responsible'],
            ":cep"         => $data['cep'],
            ":phone"       => $data['phone'],
            ":address"     => $data['address'],
            ":city"        => $data['city'],
            ":status"      => $data['status'],
            ":description" => $data['description'],
            ":id"          => $data['id']
        ]);
    }

    public function getRecentlyCompanies(): array
    {
        $stmt = $this->pdo->query("SELECT id, cnpj, name, phone, address, created_at FROM companies ORDER BY created_at DESC LIMIT 3");
        $stmt->setFetchMode(PDO::FETCH_CLASS, CompanyModel::class);

        $companies = $stmt->fetchAll();
        return $companies;
    }

    public function findCompanyById(int $companyId): ?CompanyModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM companies WHERE id = :id");
        $stmt->execute([':id' => $companyId]);

        $company = $stmt->fetchObject(CompanyModel::class);
        return $company ?: null;
    }

    public function getCompanyVacancies(int $companyId): int
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM vacancies WHERE company_id = :company_id");
        $stmt->execute([':company_id' => $companyId]);

        $totalVacancies = $stmt->fetchColumn();
        return $totalVacancies;
    }
}
