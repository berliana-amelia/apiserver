<?php

namespace App\Controllers;


use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\FoodModel;

class Food extends ResourceController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new FoodModel();
    }

    public function index()
    {
        $data = $this->model->orderBy('nama', 'desc')->findAll();
        return $this->respond($data, 200);

    }
    public function create()
    {
        $data = $this->request->getPost();  
        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Makanan berhasil ditambahkan.'
            ]
        ];
        return $this->respond($response);
    }

    public function show($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
    }
    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $data['id'] = $id;
        $isExist = $this->model->where('id', $id)->findAll();
        if (!$isExist) {
            return $this->failNotFound("Data tidak ditemukan untuk id $id");
        }
        if (!$this->model->save($data)) {
            return $this->fail($this->model->errors());
        }
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Makanan berhasil diupdate.'
            ]
        ];
        return $this->respond($response);
    }
    public function delete($id = null)
    {
        $data = $this->model->where('id', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data makanan berhasil dihapus'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}