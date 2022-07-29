<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'id_agenda';
    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useSoftDeletes = 'deleted_at';

    protected $allowedFields = ['agenda', 'penyelenggara', 'waktu', 'jam', 'tempat'];

    public function getHomeModel($id_agenda = false)
    {
        if ($id_agenda == false) {
            $this->orderBy('id_agenda', 'DESC');
            return $this->findAll();
        }
        $this->orderBy('id_agenda', 'DESC');
        return $this->where(['id_agenda' => $id_agenda]);
    }

    public function filter_laporan($dari = null, $sampai = null)
    {
        // condition for filter by date
        if ($dari == null && $sampai == null) {
            return $this->orderBy('created_at', 'DESC')->findAll();
        } elseif ($dari == null && $sampai != null) {
            return $this->where('created_at <=', $sampai)->orderBy('created_at', 'ASC')->find();
        } elseif ($dari != null && $sampai == null) {
            return $this->where('created_at >=', $dari)->orderBy('created_at', 'ASC')->find();
        } elseif ($dari != null && $sampai != null) {
            return $this->where('created_at >=', $dari)->where('created_at <=', $sampai)->orderBy('created_at', 'ASC')->find();
        }
    }

    public function hitung($table)
    {
        return $this->countAll($table);
    }

    public function tambah($table, $field)
    {
        $this->selectSum($field);
        return $this->get($table)->row_array()[$field];
    }
}
