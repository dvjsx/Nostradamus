<?php namespace App\Models;
use CodeIgniter\Model;
/**
 * Model za rad sa tabelom voli, koja prati koji je korisnik voleo (ili oznacio da ne voli) koje predvidjanje, 
 * kako niko ne bi mogao da voli isto predvidjanje vise puta
 * @version 1.0
 * @author Dusan Vojinovic 2017/80
 */
class VoliModel extends Model
{
    protected $table="voli";
    protected $primaryKey="VestackiId";
    
    protected $returnType     = 'object';
    protected $allowedFields=["IdP","IdK","VestackiId"];
    
    /**
     * Vraca da li je korisnik vec voleo dato predvidjanje
     * @param int $idK Korisnik koji je voleo predvidjanje
     * @param int $idP Predvidjanje koje je (ne)voljeno
     * @return boolean
     */
    public function vec_voli($idK,$idP)
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
    public function voli($idK,$idP,$vestackiId)
    {
        $data=["IdK"=>$idK,"IdP"=>$idP,"VestackiId"=>$vestackiId];
        $this->insert($data);
    }
    
    /**
     * Vraca poslednji vestacki id posto to nije auto increment polje
     * @return int vestackiId 
     */
    public function poslednji_vestackiId() 
    {
        $voljenja=$this->findAll();
        $maxId=-1;
        foreach ($voljenja as $voli)
        {
            if ($voli->VestackiId>$maxId)
            {
                $maxId=$voli->VestackiId;           
            }
        }
        return $maxId;
    }
    
}



