<?php

namespace App\Models;

class VacancyModel
{
    public $id;
    public $company_id;
    public $name;
    public $description;
    public $requirements;
    public $wage;
    public $created_at;

    public function __construct() {}
}