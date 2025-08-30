<?php

namespace App\Models;

class CompanyModel
{
    public $id;
    public $cnpj;
    public $name;
    public $phone;
    public $email;
    public $city;
    public $status;
    public $cep;
    public $address;
    public $responsible;
    public $description;
    public $created_at;

    public function __construct()
    {
        
    }
}