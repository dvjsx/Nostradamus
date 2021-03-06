<?php namespace App\Models;
use CodeIgniter\Model;
/**
 * Model za rad sa tabelom voli, koja prati koji je korisnik ocenio koje predvidjanje, 
 * kako niko ne bi mogao da oceni isto predvidjanje vise puta
 * @version 1.0
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
        $element= $this->where("IdP",$idP)->where("IdK",$idK)->find();
        return $element!=null;
    }
    
    /**
     * Ubacuje red u tabelu
     * @param int $idK
     * @param int $idP
     * @return void
     */
    public function daje_ocenu($idK,$idP,$ocena,$vestackiId)
    {
        $data=["IdK"=>$idK,"IdP"=>$idP,"ocena"=>$ocena,"VestackiId"=>$vestackiId];
        $this->insert($data);
    }
    
    /**
     * Vraca poslednji vestacki id posto to nije auto increment polje
     * @return int vestackiId 
     */
    public function poslednji_vestackiId() 
    {
        $ocene=$this->findAll();
        $maxId=-1;
        foreach ($ocene as $ocena)
        {
            if ($ocena->VestackiId>$maxId)
            {
                $maxId=$ocena->VestackiId;           
            }
        }
        return $maxId;
    }
    
    
}



