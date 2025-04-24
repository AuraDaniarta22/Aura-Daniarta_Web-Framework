<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ImagesController extends Controller
{
    public function upload()
    {
        $imageFile = $this->request->getFile('image');
        $description = $this->request->getPost('description');
        $category = $this->request->getPost('category');

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageData = file_get_contents($imageFile->getTempName());

            $db = \Config\Database::connect();
            $builder = $db->table('images');
            $builder->insert([
                'image' => $imageData,
                'description' => $description,
                'category' => $category,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return redirect()->to('/success'); // Redirect ke halaman sukses
        }

        return redirect()->back()->with('error', 'Gagal mengupload gambar.');
    }

    public function success()
    {
        return view('success'); // Menampilkan halaman sukses
    }
    public function uploadFromCamera()
    {
        // Ambil data gambar dari request
        $imageData = $this->request->getPost('image');
        $description = $this->request->getPost('description');
        $category = $this->request->getPost('category');

        // Decode data gambar dari base64
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = base64_decode($imageData);

        // Simpan data ke database
        $db = \Config\Database::connect();
        $builder = $db->table('images');
        $builder->insert([
            'image' => $imageData,
            'description' => $description,
            'category' => $category,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Kirim respons JSON
        return $this->response->setJSON(['status' => 'success', 'message' => 'Foto berhasil diunggah']);
    }
}