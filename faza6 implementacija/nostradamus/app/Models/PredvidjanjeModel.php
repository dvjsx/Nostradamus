
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
    protected $returnType     = 'object';
    protected $allowedFields=["IdK","Naslov","DatumNastanka","DatumEvaluacije","Sadrzaj","Nominalna_Tezina","Tezina","Popularnost","BrOcena","Status"];
    
    /**
     * Ubacuje predvidjanje u bazu, provere na kontrolerskoj strani
     * Preduslovi: Polja popunjena, naslov ili ne sadrzi znak '#' ili je '#' + naslov_ideje, ako je odgovor na ideju,
     * mora da ima isti datum evaluacije
     * @param string $naslov 
     * @param Date $datum_evaluacije kada ce se videti da li je predvidjanje ispunjeno
     * @param string $sadrzaj 
     */
    public function ubaci_novo_predvidjanje($idK,$naslov,$datum_evaluacije,$sadrzaj)
    {
        //proveriti ovo za datum, da li je kompaktibilno sa sqlom
        $data=["IdK"=>$idK,"Naslov"=>$naslov,"DatumNastanka"=> date("d/m/Y"),"DatumEvaluacije"=>$datum_evaluacije,
            "Sadrzaj"=>$sadrzaj,"Nominalna_Tezina"=>0,"Tezina"=>0,"Popularnost"=>0,"Br_Ocena"=>0,
            "Status"=>"CEKA"];
        $this->save($data);
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
        return $this->orderBy("Tezina","desc")->findAll();
    }
    
    
    /**
     * Dohvata sva predvidjanja iz baze i sortira po popularnosti
     * @return predvidjanje[]
     */
    public function dohvati_najpopularnija_predvidjanja()
    {
        
        return $this->orderBy("Popularnost","desc")->findAll();   
    }
    /**
     * Dohvata sva predvidjanja iz baze i sortira po datumu nastanka
     * @return predvidjanje[]
     * 
     */
    public function dohvati_najnovija_predvidjanja()
    {
        
        return $this->orderBy("DatumNastanka","desc")->findAll();   
    }
    /**
     * Dohvata sva predvidjanja datog korisnika preko id-a (veza izmedju $username i $idK implementirati u modelima za korisnike)
     * @param unique_id $id_korisnika
     * @return predvidjanja[]
     */
    public function dohvati_predvidjanja_korisnika($id_korisnika)
    {
        return $this->where("IdK",$id_korisnika);
    }
    /**
     * Povecava popularnost predvidjanja, treba pozvati i metodu voli za VoliModel
     * @param unique_id $idP identifikator predvidjanja koje je voljeno
     * @param bool $pozitivno da li je korisnik oznacio da mu se predvidjanje svidja (true) ili ne svidja (false)
     * @return Void 
     */
    public function voli($idP,$pozitivno)
    {
        $inkrement= ($pozitivno) ? 1:-1;
        $predvidjanje= $this->find($idP);
        $predvidjanje->Popularnost=$predvidjanje->Popularnost+$inkrement;
        $this->save($predvidjanje);
    }
    /**
     * Izravunavanje tezine iz nominalne tezine
     * @var 
     */
    private function izracunaj_tezinu($nominalna_tezina,$datum_nastanka,$datum_evaluacije)
    {
        $dani=(strtotime($datum_evaluacije)- strtotime($datum_nastanka))/DAY;
        return sqrt($dani*1.0)*$nominalna_tezina;
    }
    /**
     * Poziva se kad korisnik da svoje misljenje o tezini predvidjanja, izracunava ukupnu tezinu na osnovu misljenja svih korisnika i koliko je rano
     * predvidjanje napravljeno. Proveriti da li je korisnik vec dao ocenu
     * @param unique_id $idP Identifkator ocenjenog predvidjanja
     * @param double $ocena Ocena nominalne tezine 
     * @return Void 
     */
    public function daje_ocenu($idP,$ocena)
    {
        $predvidjanje= $this->find($idP);
        $nom=$predvidjanje->NominalnaTezina;
        $predvidjanje->NominalnaTezina=($nom*$predvidjanje->BrOcena+$ocena)/($predvidjanje->BrOcena+1);
        $predvidjanje->BrOcena++;
        $predvidjanje->Tezina= $this->izracunaj_tezinu($predvidjanje->NominalnaTezina, $predvidjanje->DatumNastanka, $predvidjanje->DatumEvaluacije);
        $this->save($predvidjanje);
        
    }
    
    /**
     * Postavlja status predvidjanja
     * Poziva je korisnik nakon datuma evaluacije, ili admin koji zeli da promeni. 
     * Provera ima li dati korisnik pravo na poziv funkcije je na strani kontrolera.
     * Autorovo povecavanje skora, u slucaju ispunjenja takodje na strani kontrolera
     * @param string $status status predvidjanja, moze biti ISPUNJENO,NEISPUNJENO, CEKA
     */
    public function postavi_status($idP,$status)
    {
        $status= strtoupper(trim($status));
        if (in_array($status, ["ISPUNJENO","NEISPUNJENO"]))//za svaki slucaj
        {
             $predvidjanje= $this->find($idP);
             $this->save($predvidjanje); 
        }
    }
    
}
