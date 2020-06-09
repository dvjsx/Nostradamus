<?php namespace App\Models;

use CodeIgniter\Model;
/**
 * Model za rad sa tabelom moderator
 * @version 1.0
 * @author Smiljana Spasic 2014/588
 */
class ModeratorModel extends Model
{
    protected $table      = 'moderator';
    protected $primaryKey = 'IdM';

    protected $returnType     = 'object';
    
    protected $allowedFields = ['IdM'];
    /**
     * Vraca red iz tabele sa datim id-em (IdM odgovara IdK iz tabele korisnik)
     * @param int $id
     * @return moderator
     */
     public function dohvati_korisnika($id){
         return $this->where('IdM', $id)->first();
    }
    /**
     * Dodaje red u tabelu, tj. oznacava da je dati korisnik moderator
     * @param int $id
     * @return Moderator
     */
    public function dodaj($id){
         return $this->insert(['IdM'=>$id]);
    }
}