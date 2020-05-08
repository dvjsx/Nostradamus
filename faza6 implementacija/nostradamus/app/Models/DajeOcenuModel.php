<?php namespace App\Models;
use CodeIgniter\Model;
/**
 * Model za rad sa tabelom voli, koja prati koji je korisnik ocenio koje predvidjanje, 
 * kako niko ne bi mogao da oceni isto predvidjanje vise puta
 * @author Dusan Vojinovic 2017/80
 */
class DajeOcenuModel extends Model
{
    protected $table="daje_ocenu";
    protected $primaryKey="VestackiId";
    
    protected $returnType     = 'object';
    protected $allowedFields=["IdP","IdK","VestackiId"];
    
    /**
     * Vraca da li je korisnik vec voleo dato predvidjanje
     * @param uniqueid $idK Korisnik koji je voleo predvidjanje
     * @param uniqueid $idP Description
     * @return boolean 
     */
    public function vec_dao_ocenu($idK,$idP)
    {
        $element= $this->where("IdP",$idP)->where("idK",$idK)->find();
        return $element!=null;
    }
    
    /**
     * Ubacuje red u tabelu
     * @param int $idK
     * @param int $idP
     * @return void
     */
    public function daje_ocenu($idK,$idP,$ocena)
    {
        $data=["idK"=>$idK,"idP"=>$idP,"ocena"=>$ocena];
        $this->save($data);
    }
    
    
}



