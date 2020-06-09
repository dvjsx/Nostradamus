<?php namespace App\Models;

use CodeIgniter\Model;
/**
 * Model za rad sa tabelom obican_ili_veran, koja govori koji su korisnici obicni, i koji su verni
 * @version 1.0
 * @author Katarina Svrkota 2015/648
 */
class Obican_ili_VeranModel extends Model
{
    protected $table      = 'obican_ili_veran';
    protected $primaryKey = 'IdK';

    protected $returnType     = 'object';
    protected $allowedFields = ['IdK','Veran'];
    /**
     * Dodaje red u tabelu, tj. oznacava da je dati korisnik obican ili veran
     * @param int $id
     * @param bool $veran da li je korisnik veran
     * @return Moderator
     */
    public function dodaj($id,$veran=false){
         return $this->insert(['IdK'=>$id, 'Veran'=>$veran]);
    }
    /**
     * Vraca red iz tabele sa datim id-em (IdK odgovara IdK iz tabele korisnik)
     * @param int $id
     * @return Obican_ili_veran
     */
    public function dohvati($id){
        return $this->find($id);
    }
}