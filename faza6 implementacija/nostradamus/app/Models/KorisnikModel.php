<?php namespace App\Models;

use CodeIgniter\Model;

class KorisnikModel extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'IdK';

    protected $returnType     ='object';

    protected $allowedFields = ['Username', 'Password','DatumReg','Email','Skor','Popularnost'];
   

    //protected $useTimestamps = false;
    
    public function dodaj_korisnika($korIme,$email,$password,$datumReg){
        //ubacimo korisnika
        //skor i popularnost na 0
        $this->insert([
            'Username' =>$korIme, 
            'Password'=>$password,
            'DatumReg'=>$datumReg,
            'Email'=>$email,
            'Skor'=>0,
            'Popularnost'=>0
        ]);
    }
    public function dohvati_korisnika($korIme){
        return $this->where('Username', $korIme)->first();
    }
}