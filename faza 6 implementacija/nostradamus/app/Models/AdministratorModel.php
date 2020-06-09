<?php namespace App\Models;

use CodeIgniter\Model;
/**
 * Model za rad sa tabelom administrator koja cuva koji su korisnici administratori (IdA odgovara IdK iz tabele korisnici)
 * @version 1.0
 * @author Smiljana Spasic 2014/588
 */
class AdministratorModel extends Model
{
 protected $table      = 'admin';
    protected $primaryKey = 'IdA';

    protected $returnType     = 'object';
    
    protected $allowedFields = ['IdA'];
    /**
     * Vraca red iz tabele sa zadatim id-em
     * @param int $id
     * @return Administrator
     */
    public function dohvati_korisnika($id){
         return $this->where('IdA', $id)->first();
    }
    /**
     * Pamti da je dati korisnik (sa id-em) administrator
     * @param int $id
     * @return Admministrator
     */
    public function dodaj($id){
         return $this->insert(['IdA'=>$id]);
    }
}