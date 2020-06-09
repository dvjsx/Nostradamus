<?php namespace App\Models;
use CodeIgniter\Model;
use App\Models\PredvidjanjeModel;

/**
 * @version 1.0
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
     * Isti preduslovi kao za ideju. Cuva da je odgovarajuce predvidjanje odgovor na datu ideju
     * @param int $idP
     * @param int $idI
     */
    public function sacuvaj_odgovor($idP,$idI)
    {
        
        $data=["IdP"=>$idP,"IdI"=>$idI];
        $this->insert($data);
    }
    /**
     * Vraca sva predvidjanja na datu ideju
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
            //echo $predModel->first($odg->IdP)->IdP;
            array_push($predvidjanja, $predModel->where("IdP",$odg->IdP)->first());
        }
        
        return $predvidjanja;
    }
    /**
     * Ukoliko je obrisano predvidjanje koje je odgovor na neku ideju
     * @param int $idP
     */
    public function obrisi_predvidjanje($idP)
    {
        $this->delete($idP);
    }
    /**
     * Ukoliko je cela ideja obrisana
     * @param int $IdI
     */
    public function obrisi_ideju($IdI)
    {
        $this->where("IdI",$IdI)->delete();
    }
}

