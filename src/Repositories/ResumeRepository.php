<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\ResumeModel;
use App\Models\VacancyModel;
use PDO;

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Models/ResumeModel.php';

class ResumeRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function save(ResumeModel $resume) : bool 
    {
        $sql = "INSERT INTO resumes (vacancy_id, name, email, path, phone) VALUES (:vacancy_id, :name, :email, :path, :phone)";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            ':vacancy_id' => $resume->vacancy_id,
            ':name' => $resume->name,
            ':email' => $resume->email,
            ':path' => $resume->path,
            ':phone' => $resume->phone
        ]);
    }

    public function findResumesByCompany($CompanyId) : array
    {
        $stmt = $this->pdo->prepare("
            Select resumes.*, vacancies.name AS vacancy_name
            FROM resumes
            JOIN vacancies 
            ON resumes.vacancy_id = vacancies.id 
            WHERE vacancies.company_id = :company_id"
        );
        $stmt->execute([":company_id" => $CompanyId]);

        $resumes = $stmt->fetchAll(PDO::FETCH_CLASS, ResumeModel::class);
        return $resumes;
    }

    public function findVacanciesByCompany($CompanyId) : array
    {
        $stmt = $this->pdo->prepare("SELECT id, name FROM vacancies WHERE company_id = :id");
        $stmt->execute([":id" => $CompanyId]);

        $vacancies = $stmt->fetchAll(PDO::FETCH_CLASS, VacancyModel::class);
        return $vacancies;
    }

    public function findCompanyNameById($CompanyId) : string
    {
        $stmt = $this->pdo->prepare("SELECT name from companies WHERE id = :id");
        $stmt->execute([":id" => $CompanyId]);

        $companyName = $stmt->fetchColumn();
        return $companyName;
    }
}
