<?php namespace App\Models;
use CodeIgniter\Model;
use App\Models\PredvidjanjeModel;

/**
 * @author Dusan Vojinovic 2017/80
 *  Model za rad sa tabelom odgovor_na koja prati koja su predvidjanja odgovor na koju ideju
 */

class Odgovor_naModel extends Model
{
    protected $table="odgovor_na";
    protected $primaryKey="IdP";
    
    protected $returnType     = 'object';
    protected $allowedFields=["IdP","IdI"];
    
    /**
     * Isti preduslovi kao za ideju
     * @param int $idP
     * @param int $idI
     */
    public function sacuvaj_odgovor($idP,$idI)
    {
        $data=["IdP"=>$idP,"IdI"=>$idI];
        $this->insert($data);
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

