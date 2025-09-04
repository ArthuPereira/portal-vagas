<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\VacancyModel;
use PDO;

class VacancyRepository
{
    private PDO $pdo;

    public function __construct() 
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function findVacanciesById(int $companyId): array
    {
        $stmt = $this->pdo->prepare("SELECT name, description, requirements, wage, created_at FROM vacancies WHERE company_id = :company_id");
        $stmt->execute([":company_id" => $companyId]);

        $vacancies = $stmt->fetchAll(PDO::FETCH_CLASS, VacancyModel::class);
        return $vacancies;
    }

    public function companyNameById(int $companyId): ?string
    {
        $stmt = $this->pdo->prepare("SELECT name from companies WHERE id = :id");
        $stmt->execute([":id" => $companyId]);

        $companyName = $stmt->fetchColumn();
        return $companyName ?: null;
    }

    public function save(array $data): bool
    {
        $sql = "
                INSERT INTO
                    vacancies (name, company_id, description, requirements, wage) 
                VALUES 
                    (:name, :company_id, :description, :requirements, :wage)
        ";
        
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":name"         => $data['name'],
            ":company_id"   => $data['company_id'],
            ":description"  => $data['description'],
            ":requirements" => $data['requirements'],
            ":wage"         => $data['wage'],
        ]);
    }
}
