<?php

namespace App\Models;

use App\Utils\Flash;

class ResumeModel
{
    public $id;
    public $vacancy_id;
    public $name;
    public $email;
    public $phone;
    public $path;
    public $created_at;

    public $resume;
    public $vacancy_name;
    public $company_id;

    public function __construct() {}

    public static function fromArray(array $data) : self
    {
        $instance = new self();

        $instance->vacancy_id = $data['vacancy_id'];
        $instance->name       = $data['name'];
        $instance->email      = $data['email'];
        $instance->phone      = $data['phone'];
        $instance->company_id = $data['company_id'];
        $instance->resume     = $data['resume']; // array completo do $_FILES

        return $instance;
    }

    public function validateUpload() : void
    {
        if ($_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
            Flash::set('error', 'Erro no upload');
            header("Location: /mvc-php/resume/" . $this->company_id);
            exit;
        }
        
        $allowedExtensions = ['pdf', 'doc', 'docx'];
        $ext = strtolower(pathinfo($this->resume['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExtensions)) {
            Flash::set('error', 'Formato inválido. Permitido: PDF/DOC/DOCX');
            header("Location: /mvc-php/resume/" . $this->company_id);
            exit;
        }

        if ($this->resume['size'] > 5 * 1024 * 1024) { // 5MB
            Flash::set('error', 'Arquivo muito grande (máx 5MB)');
            header("Location: /mvc-php/resume/" . $this->company_id);
            exit;
        }
    }

    public function saveFile(string $uploadDir) : void
    {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $this->validateUpload();

        $ext = strtolower(pathinfo($this->resume['name'], PATHINFO_EXTENSION));
        $filename = 'curriculo_vaga_' . $this->vacancy_id . '_' . time() . '.' . $ext;

        $target = $uploadDir . '/' . $filename;

        if (!move_uploaded_file($this->resume['tmp_name'], $target)) {
            Flash::set('error', 'Falha ao salvar arquivo');
            header("Location: /mvc-php/resume/" . $this->company_id);
            exit;
        }

        $this->path = $filename; // path que vai pro banco de dados
    }
}
