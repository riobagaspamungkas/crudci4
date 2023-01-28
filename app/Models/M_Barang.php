<?php

namespace App\Models;
use CodeIgniter\Model;

class M_Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';

    //protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['kode_barang', 'nama_barang', 'jumlah_barang', 'harga_barang'];

    // Dates
    //protected $useTimestamps = false;
    //protected $dateFormat    = 'datetime';
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    // Validation
    //protected $validationRules      = [];
    //protected $validationMessages   = [];
    //protected $skipValidation       = false;
    //protected $cleanValidationRules = true;

    // Callbacks
    //protected $allowCallbacks = true;
    //protected $beforeInsert   = [];
    //protected $afterInsert    = [];
    //protected $beforeUpdate   = [];
    //protected $afterUpdate    = [];
    //protected $beforeFind     = [];
    //protected $afterFind      = [];
    //protected $beforeDelete   = [];
    //protected $afterDelete    = [];

    /*method getAll bisa diganti dengan bawaan method findAll
    public function getAll($table){
        $query=$this->db->query("SELECT * FROM $table");
        return $query->getresult();
    }*/
    
    public function getByField($table,$field,$value){
        $query=$this->db->query("SELECT * FROM $table WHERE $field='$value'");
        return $query->getRowArray();
    }

    public function cekdata($table,$field,$value){
        $query=$this->db->query("SELECT * FROM $table WHERE $field='$value'");
        return $query->getNumRows();
    }

    public function cekvalidasi($table,$field,$value1,$value2){
        $query=$this->db->query("SELECT * FROM $table WHERE $field = '$value1' AND $field != '$value2'");
        return $query->getNumRows();
    }

    public function tambahbarang($gambar){
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];
        $jumlah_barang = $_POST['jumlah_barang'];
        $harga_barang = $_POST['harga_barang'];
        $query=$this->db->query("insert into barang values('$kode_barang', '$nama_barang', '$jumlah_barang', '$harga_barang', '$gambar')");
        if ($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function editbarang($foto){
        $getid = $_POST['getid'];
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];
        $jumlah_barang = $_POST['jumlah_barang'];
        $harga_barang = $_POST['harga_barang'];
        $query=$this->db->query("update barang set kode_barang='$kode_barang', nama_barang='$nama_barang', jumlah_barang='$jumlah_barang', harga_barang='$harga_barang' $foto where kode_barang='$getid'");
        if ($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function hapus_barang($id)
    {
        $rowfoto = $this->getByField('barang','kode_barang',$id);
        $foto = $rowfoto['gambar'];
        $query = $this->db->table($this->table)->delete(['kode_barang' => $id]);
        if ($query){
            if ($foto != '') {
                unlink('assets/images/'.$foto);
            }
            return TRUE;
        }else{
            return FALSE;
        }
    }
}