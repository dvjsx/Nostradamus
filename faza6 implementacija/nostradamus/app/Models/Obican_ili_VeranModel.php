<?php namespace App\Models;

use CodeIgniter\Model;

class Obican_ili_VeranModel extends Model
{
    protected $table      = 'obican_ili_veran';
    protected $primaryKey = 'IdK';

    protected $returnType     = 'object';
    protected $allowedFields = ['IdK','Veran'];
    public function dodaj($id,$veran=false){
         return $this->insert(['IdK'=>$id, 'Veran'=>$veran]);
    }
    public function dohvati($id){
        return $this->find($id);
    }
}