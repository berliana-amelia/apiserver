<?php
namespace App\Models;

use CodeIgniter\Model;

class FoodModel extends Model
{
    protected $table = 'food';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'deskripsi', 'harga', 'gambar'];

    protected $validationRules = [
        'nama' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
        'gambar' => 'required|valid_url',
    ];
    protected $validationMessages = [
        'nama' => [
            'required' => 'Silahkan masukkan nama'
        ],
        'deskripsi' => [
            'required' => 'Silahkan masukkan deskripsi'
        ],
        'harga' => [
            'required' => 'Silahkan masukkan harga',
            'numeric'=> 'Silahkan masukkan harga yang valid'
        ],
        'gambar' => [
            'required' => 'Silahkan masukkan link gambar',
            'vaid_url' => 'Silahkan masukkan link gambar yang valid'
        ]
    ];
}