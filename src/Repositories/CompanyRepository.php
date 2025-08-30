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

    public function getCompanies(): ?array
    {
        $stmt = $this->pdo->query("SELECT id, cnpj, name, phone, address, created_at FROM companies");
        $stmt->setFetchMode(PDO::FETCH_CLASS, CompanyModel::class);

        $companies = $stmt->fetchAll();
        
        return $companies;
    }
}
