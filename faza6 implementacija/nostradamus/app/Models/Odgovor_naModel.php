<?php namespace App\Models;
use CodeIgniter\Model;
use App\Models\PredvidjanjeModel;

class Odgovor_naModel extends Model
{
    protected $table="odgovor_na";
    protected $primaryKey="IdP";
    
    protected $returnType     = 'object';
    protected $allowedFields=["IdP","IdI"];
    
    /**
     * Isti preduslovi kao za ideju
     * @param type $idP
     * @param type $idI
     */
    public function sacuvaj_odgovor($idP,$idI)
    {
        $data=["IdP"=>$idP,"IdI"=>$idP];
        $this->save($data);
    }
    /**
     * 
     * @param type $idI Ideja cije odgovore trazimo
     * @return array $predvidjanja
     */
    public function vrati_sva_predvidjanja_na_datu_ideju($idI)
    {
        $odgovori= $this->where("IdI",$idI)->findAll();
        $predModel=new PredvidjanjeModel();
        $predvidjanja=[];
        foreach ($odgovori as $odg)
        {
            array_push($predvidjanja, $predModel->find($odg->IdP));
        }
        return $predvidjanja;
    }
}

