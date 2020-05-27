<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\Obican_ili_VeranModel;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;

class KorisnikModel extends Model
{
    protected $table      = 'korisnik';
    protected $primaryKey = 'IdK';

    protected $returnType     ='object';

    protected $allowedFields = ['Username', 'Password','DatumReg','Email','Skor','Popularnost'];
   

    //protected $useTimestamps = false;
    
    public function dodaj_korisnika($korIme,$email,$password,$datumReg){
        //ubacimo korisnika
        //skor i popularnost na 0
        $this->insert([
            'Username' =>$korIme, 
            'Password'=>$password,
            'DatumReg'=>$datumReg,
            'Email'=>$email,
            'Skor'=>0,
            'Popularnost'=>0
        ]);
    }
    public function dohvati_korisnika($korIme){
        return $this->where('Username', $korIme)->first();
    }
    /**
     * NETESTIRANO!
     * @param Korisnik $korisnik (kompletan objekat, ne samo id, ili tako nesto), ok promeniti, ali voditi racuna
     * @param int $za_koliko inkrement skora
     * @return void 
     */
    public function uvecaj_skor($korisnik,$za_koliko)
    {
        $korisnik->Skor+=$za_koliko;
        $this->save($korisnik);
    }
    /**
     * NETESTIRANO! 
     * Ista je funkcija, samo je semantika drukcija
     * @param Korisnik $korisnik (kompletan objekat, ne samo id, ili tako nesto), ok promeniti, ali voditi racuna
     * @param int $za_koliko inkrement skora
     * @return void 
     */
    public function sankcionisi($korisnik,$za_koliko)
    {
        $this->uvecaj_skor($korisnik,-$za_koliko);
    }
    /**
     * NETESTIRANO!
     * @param type $korisnik
     * @param String $stara_uloga (ovde cu smatrati "ADMIN", "MODERATOR","VERAN" (smatrati da ce se uvek verni korisnici birati za vise uloge), ako menjate, promenite ifove)
     * @param String $nova_uloga 
     */
    public function promovisi($korisnik,$stara_uloga,$nova_uloga)
    {
        
        $obican_model=new Obican_ili_VeranModel();
        $moderator_model=new ModeratorModel();
        $admin_model=new AdministratorModel();
        //brisi iz stare
        $idK=$korisnik->IdK;
        if ($stara_uloga=="VERAN")
        {
            $obican_model->delete($idK);
        }
        if ($stara_uloga=="MODERATOR")
        {
            $moderator_model->delete($idK);
        }
        if ($stara_uloga=="ADMIN")
        {
            $admin_model->delete($idK);
        }
        //dodaj u novu
        if ($nova_uloga=="VERAN")
        {
            $obican_model->dodaj($idK, true);//smatra se da ne bi ni bio moderator ako nije par dana na sajtu ili je povlascen
        }
        if ($nova_uloga=="ADMIN")
        {
            $admin_model->dodaj($idK);
        }
        if ($nova_uloga=="MODERATOR")
        {
            $moderator_model->dodaj($idK);
        }
    }
    /**
     * Vraca kog je tipa dati korisnik
     * @param Korisnik $korisnik
     * @return string tip korisnika
     */
    public function pronadjiUlogu($korisnik)
    {
        $administratorModel=new AdministratorModel();
        $moderatorModel=new ModeratorModel();
        if ($administratorModel->find($korisnik->IdK)!=null)
        {
            return "ADMIN";
        }
        if ($moderatorModel->find($korisnik->IdK)!=null)
        {
            return "MODERATOR";
        }
        $obican_ili_veran_model=new Obican_ili_VeranModel();
        $obican_ili_veran=$obican_ili_veran_model->where("IdK",$korisnik->IdK)->first();
        if ($obican_ili_veran->Veran)
        {
            return "VERAN";
        }
        return "OBICAN";
    }
}