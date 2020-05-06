<?php namespace App\Models;
use CodeIgniter\Model;

/**
 * @author Dusan Vojinovic 2017/80
 * Model ideje
 */
class IdejaModel extends Model
{
    protected $table="ideja";
    protected $primaryKey="IdI";
    protected $returnType     = 'object';
    protected $allowedFields=["IdK","Naslov","DatumEvaluacije","Sadrzaj","Popularnost"];
     
    /**
     * Ubacuje novu ideju.
     * Preduslovi: Ne postoji ideja sa istim naslovom, autor je veran korisnik ili admin/moderator. 
     * @param uniqueid $Id_autor autor ideje
     * @param string $naslov
     * @param date $datum
     * @param string $sadrzaj
     */
    public function ubaci_novu_ideju($Id_autor,$naslov,$datum,$sadrzaj)
    {
        $data=["IdK"=>$Id_autor,"Naslov"=>$naslov,"DatumEvaluacije"=>$datum,"Sadrzaj"=>$sadrzaj,"Popularnost"=>0];
        $this->save($data);
    }
    /**
     * Dohvata sve ideeje iz baze
     * @return ideja[]
     */
    public function dohvati_sve_ideje()
    {
        return $this->findAll();
    }
    
    /**
     * Dohvata sve ideje iz baze i sortira po popularnosti
     * @return ideja[]
     */
    public function dohvati_najpopularnije_ideje()
    {
        
        return $this->orderBy("Popularnost","desc")->findAll();   
    }
    /**
     * Dohvata sve ideje iz baze i sortira po datumu evalacije
     * @return ideja[]
     */
    public function dohvati_najaktuelnije_ideje()
    {
        $ideje= $this->findAll();
        usort($ideje,function ($i1,$i2)
        {
            //proveriti je l' ovo tranzitivno, idejno jeste, samo da li sam napravio gresku
           $dat1= strtotime($i1->DatumEvaluacije); 
           $dat2= strtotime($i2->DatumEvaluacije); 
           $danas= strtotime(date("d/m/Y"));
           if ($dat1==$dat2)
           {
               return 0;
           }
           if ($dat1>$danas)
           {
               if ($dat2<$danas)//dat2 nije aktuelno, jer je vec proslo, a d1 jeste te ide ispred
               {
                   return -1;
               }
               else//oba tek treba da se dogode aktuelnije je ono sto ce pre da se dogodi
               {
                   if ($dat1<$dat2)
                   {
                       return -1;
                   }
                   else
                   {
                       return 1;
                   }
               }
           }
           else//dat1 nije aktuelno
           {
               if ($dat2>$danas)//dat2 ide ispred
               {
                   return 1;
               }
               else//nijedan nije aktuelan zato zelimo da bude ispred onaj sa vecim datumom jer je on blizi sadasnjosti
               {
                   if ($dat1<$dat2)
                   {
                       return 1;
                   }
                   else 
                   {
                       return -1;
                       
                   }
               }
               
           }
        });
        
    }
    /**
     * Vraca sve ideje korisnika
     * @param unique_id $id_korisnika
     * @return ideje[]
     */
    public function dohvati_ideje_korisnika($id_korisnika)
    {
        return $this->where("IdK",$id_korisnika);
    }
    /**
     * Inkrementira popularnost ideje. Okida se (o tome kontroler vodi racuna) kad se napravi predvidjanje sa #NaslovIdeje
     * @param unique_id $idI Identifikator ideje na koju je odgovoreno
     */
    public function povecaj_popularnost($idI)
    {
        $ideja= $this->find($idI);
        $ideja->Popularnost++;
        $this->save($ideja);
    }
}

