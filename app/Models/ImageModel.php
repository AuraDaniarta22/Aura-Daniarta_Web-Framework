<?php
// filepath: c:\xampp2\htdocs\Aura-Daniarta_Web-Framework\app\Models\ImageModel.php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['image', 'description', 'category', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = null; // Nonaktifkan updated_at
}