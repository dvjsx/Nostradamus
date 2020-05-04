
<?php namespace App\Models;
use CodeIgniter\Model;



/**
 * *@author Dusan Vojinovic 2017/80 
 * Model za rad sa predvidjanjima u bazi
 */
class PredvidjanjeModel extends Model
{
    protected $table="predvidjanja";
    protected $primaryKey="IdP";
    protected $returnObject;
    protected $allowedFields=["IdP","Naslov","DatumNastanka","DatumEvaluacije","Sadrzaj","Nominalna_Tezina,Tezina,Popularnost,BrOcena"];
    
    /**
     * Izravunavanje tezine iz nominalne tezine
     * @var 
     */
    private function izracunaj_tezinu($nominalna_tezina,$datum_nastanka)
    {
        
    }
    /**
     * Dohvata sva predvidjanja iz baze
     * @return predvidjanje[]
     */
    public function dohvati_sva_predvidjanja()
    {
        return $this->findAll();
    }
    
    
    /**
     * Dohvata sva predvidjanja iz baze i sortira po tezini
     * @return predvidjanje[]
     */
    public function dohvati_najteza_predvidjanja()
    {
        $predvidjanja=$this->findAll();
        //otvoreno pitanje: ima li nesto u codeigniter modelu tipa order_by, kako se koristi i sta je bolje
        usort($vesti,function($v1,$v2)
	{
		$raz=$v1->Tezina-$v2->Tezina;
		if ($raz<0)
			$raz=-1;
		if ($raz==0)
			$raz=1;
                //zelimo opadajuce da sortiramo
		return -1*$raz;
	});
        return $predvidjanja;  
    }
    
    
    /**
     * Dohvata sva predvidjanja iz baze i sortira po popularnosti
     * @return predvidjanje[]
     */
    public function dohvati_najteza_predvidjanja()
    {
        $predvidjanja=$this->findAll();
        //otvoreno pitanje: ima li nesto u codeigniter modelu tipa order_by, kako se koristi i sta je bolje
        usort($vesti,function($v1,$v2)
	{
		$raz=$v1->Popularnost-$v2->Popularnost;
		if ($raz<0)
			$raz=-1;
		if ($raz==0)
			$raz=1;
		return $raz;
	});
        return $predvidjanja;   
    }
    /**
     * Dohvata sva predvidjanja iz baze i sortira po popularnosti
     * @return predvidjanje[]
     * 
     */
    public function dohvati_najnovija_predvidjanja()
    {
        $predvidjanja=$this->findAll();
        //otvoreno pitanje: ima li nesto u codeigniter modelu tipa order_by, kako se koristi i sta je bolje
        usort($vesti,function($v1,$v2)
	{
		//TODO: sort prema datumima
	});
        return $predvidjanja;   
    }
    /**
     * Dohvata sva predvidjanja datog korisnika
     * @param type $id_korisnika
     * @return predvidjanja[]
     */
    public function dohvati_predvidjanja_korisnika($id_korisnika)
    {
        return $this->where("IdK",$id_korisnika);
    }
}

