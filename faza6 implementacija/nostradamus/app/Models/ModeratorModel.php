<?php namespace App\Models;

use CodeIgniter\Model;

class ModeratorModel extends Model
{
    protected $table      = 'moderator';
    protected $primaryKey = 'IdM';

    protected $returnType     = 'object';
   
     public function dohvati_korisnika($id){
         return $this->where('IdM', $id)->first();
    }
}