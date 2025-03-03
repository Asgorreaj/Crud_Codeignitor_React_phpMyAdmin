<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProductModel;

class Products extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        $model = new ProductModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $model = new ProductModel();
        $data = $model->find($id);
        if (!$data) return $this->failNotFound('No Data Found');
        return $this->respond($data);
    }

    public function create()
    {
        helper(['form']);
        $rules = [
            'title' => 'required',
            'price' => 'required'
        ];

        // ✅ Read JSON Input Properly
        $jsonData = $this->request->getJSON(true);

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new ProductModel();
        $model->insert($jsonData);

        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Data Inserted'
            ]
        ];
        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'title' => 'required',
            'price' => 'required'
        ];

        // ✅ Read JSON Input Properly
        $jsonData = $this->request->getJSON(true);

        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new ProductModel();
        $findById = $model->find($id);
        if (!$findById) return $this->failNotFound('No Data Found');

        $model->update($id, $jsonData);

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new ProductModel();
        $findById = $model->find($id);
        if (!$findById) return $this->failNotFound('No Data Found');

        $model->delete($id);

        $response = [
            'status' => 200,
            'error' => null,
            'message' => [
                'success' => 'Data Deleted'
            ]
        ];
        return $this->respond($response);
    }
}
