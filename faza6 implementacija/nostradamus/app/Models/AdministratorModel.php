<?php namespace App\Models;

use CodeIgniter\Model;

class AdministratorModel extends Model
{
 protected $table      = 'admin';
    protected $primaryKey = 'IdA';

    protected $returnType     = 'object';
    
    
    public function dohvati_korisnika($id){
         return $this->where('IdA', $id)->first();
    }
}