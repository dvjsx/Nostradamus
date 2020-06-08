<?php namespace App\Models;
use CodeIgniter\Model;

/**
 * @author Dusan Vojinovic 2017/80
 * Model ideje
 */
class IdejaModel extends Model
{
    protected $table='ideja';
    protected $primaryKey='IdI';
    protected $returnType     = 'object';
    protected $allowedFields=['IdK','IdI','Username','Naslov','DatumEvaluacije','Sadrzaj','Popularnost'];
     
    /**
     * Ubacuje novu ideju.
     * Preduslovi: Ne postoji ideja sa istim naslovom, autor je veran korisnik ili admin/moderator. 
     * @param uniqueid $Id_autor autor ideje
     * @param string $naslov
     * @param date $datum
     * @param string $sadrzaj
     */
    public function ubaci_novu_ideju($Id_autor,$username,$naslov,$datum,$sadrzaj)
    {
        $data=["IdK"=>$Id_autor,"Username"=>$username,"Naslov"=>$naslov,"DatumEvaluacije"=>$datum,"Sadrzaj"=>$sadrzaj,"Popularnost"=>0];
        $this->insert($data);
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
           $danas= strtotime(date("Y-m-d H:i:s"));
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
        return $ideje;
        
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
     * Lista predvidjanja za korisnika po korisnickom imenu, korisno za pretragu po autoru
     * @param string $username
     * @return ideja[]
     */
    public function dohvati_ideje_po_korisnickom_imenu($username)
    {
        //moza "%".$username."%" za deo imena, ali to nismo predvidjali u specifikaciji
        return $this->where("Username",$username)->findAll();
    }
    /**
     * Inkrementira popularnost ideje. Okida se (o tome kontroler vodi racuna) kad se napravi predvidjanje sa #NaslovIdeje
     * @param unique_id $idI Identifikator ideje na koju je odgovoreno
     * @return void 
     */
    public function povecaj_popularnost($idI)
    {
        $ideja= $this->find($idI);
        $ideja->Popularnost++;
        $this->save($ideja);
    }
    /**
     * 
     * @param int $idI
     * @return void
     */
    public function obrisi_ideju($idI)
    {
        $this->delete($idI);
    }
}

