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

    public function __construct() {}

    /**
     * instancia uma model a partir de um array
    */
    public static function fromArray(array $data): self
    {
        $instance = new self();

        $instance->name        = $data['name'];
        $instance->cnpj        = $data['name'];
        $instance->email       = $data['email'];
        $instance->responsible = $data['responsible'];
        $instance->cep         = $data['cep'];
        $instance->phone       = $data['phone'];
        $instance->address     = $data['address'];
        $instance->city        = $data['city'];
        $instance->status      = $data['status'];
        $instance->description = $data['description'];

        return $instance;
    }
}
