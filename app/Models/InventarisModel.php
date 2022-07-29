<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'nomor';
    protected $useTimestamps = true;
    protected $deletedField = true;

    protected $allowedFields = ['gambar', 'id_inventaris', 'nama_aset', 'jumlah_kapasitas', 'status_kondisi'];

    public function getInventaris($nomor = false)
    {
        if ($nomor == false) {
            $this->orderBy('nomor', 'DESC');
            return $this->findAll();
        }
        $this->orderBy('nomor', 'DESC');
        return $this->where(['nomor' => $nomor]);
    }
}
