<?php

namespace App\Models;

use CodeIgniter\Model;

class NyobaModel extends Model
{
    protected $table = 'tb_all_inv';
    protected $primaryKey = 'nomor';
    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useSoftDeletes = 'deleted_at';

    protected $allowedFields = ['id_inventaris', 'nama_aset', 'status', 'kondisi', 'jumlah_kapasitas', 'gambar'];

    public function getNyoba($nomor = false)
    {
        if ($nomor == false) {
            $this->orderBy('nomor', 'DESC');
            return $this->findAll();
        }
        $this->orderBy('nomor', 'DESC');

        // return $this->db->table('tb_all_inv')
        //     ->join('tb_bem', 'tb_bem.id_inventaris = tb_all_inv.id_inventaris')
        //     ->join('tb_dpm', 'tb_dpm.id_inventaris = tb_all_inv.id_inventaris')
        //     ->get()->getResultArray();

        $builder = $this->db->table('tb_all_inv');
        $builder->join('bem', 'bem.id_inventaris = tb_all_inv.id_inventaris_bem');
        $builder->join('dpm', 'dpm.id_inventaris = tb_all_inv.id_inventaris_dpm');
        $query = $builder->get();
        return $query->getResult();
    }
}
