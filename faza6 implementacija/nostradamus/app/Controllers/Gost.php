<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KorisnikModel;
use CodeIgniter\I18n\Time;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;
use App\Models\PredvidjanjeModel;
use App\Models\IdejaModel;
use App\Models\Obican_ili_VeranModel;

class Gost extends BaseController
{
    protected function prikaz($page,$data){
        $data['controller']='Gost';
        if($page=='registracija')
            echo view('sablon/header_login');
        else
            echo view('sablon/header_gost',$data);
        echo view("stranice/$page",$data);
        echo view('sablon/footer');         
    }
    public function index()
    {
        $predvidjanjeModel=new PredvidjanjeModel();
        $predvidjanja=$predvidjanjeModel->findAll();
	$this->prikaz('pregled_predvidjanja', ['predvidjanja'=>$predvidjanja]);
    }
    public function registracija(){
        $this->prikaz('registracija',[]);
    }
    public function loginSubmit(){
//dohvatim podatke
        $korIme= $this->request->getVar('user');
        $lozinka = $this->request->getVar('pass');
//provera podataka (sifra i korime)
     
        if($korIme==null || $lozinka==null){            
            return redirect()->to('/');
        }
        $korModel = new KorisnikModel();
   
        $korisnik=$korModel->dohvati_korisnika($korIme);
        $error=null;
        if($korisnik==null){
             $error="Korisničko ime ne postoji";
        }
        else if($korisnik->Password != $lozinka){
            $error="Pogrešna lozinka";
        }
        if($error!=null){
            $predvidjanjeModel=new PredvidjanjeModel();
            $predvidjanja=$predvidjanjeModel->findAll();
            return $this->prikaz('pregled_predvidjanja', ['predvidjanja'=>$predvidjanja,'error'=>$error]);
        } 
//ako su ok
     
 //nadjem tip korisnika      
        $admModel = new AdministratorModel();
        $modModel = new ModeratorModel();
        $kor_tip='korisnice';
        if($admModel->dohvati_korisnika($korisnik->IdK)!=null) $kor_tip='administratoru';
        else if($modModel->dohvati_korisnika($korisnik->IdK)!=null) $kor_tip='moderatoru';
        if($kor_tip=='korisnice'){
            $veranModel=new Obican_ili_VeranModel();
            $veranKor=$veranModel->dohvati($korisnik->IdK);
            if($veranKor->Veran==true) $kor_tip='Verni korisnice';
        }
//sacuvam podatke u sesiju         
        $this->session->set('korisnik', $korisnik);
        $this->session->set('kor_tip', $kor_tip);
        if($kor_tip=='administratoru') { return redirect()->to(site_url("Administrator/index"));}
        else if ($kor_tip=='moderatoru') { return redirect()->to(site_url("Moderator/index"));}
            else return redirect()->to(site_url("Korisnik/index"));
        
    }
    public function regSubmit() {

//dohvatimo sve podatke
        $korIme = $this->request->getVar('korIme');
        $email = $this->request->getVar('mail');
        $lozinka = $this->request->getVar('lozinka');
        $reLozinka = $this->request->getVar('reLozinka');
//provera podataka
       
        $validation =\Config\Services::validation();
        $validation->setRuleGroup('registracija');
        if (!$validation->run(['korIme'=>$korIme,'mail'=> $email,'lozinka'=> $lozinka,'reLozinka'=>$reLozinka],'registracija')) {
           return $this->prikaz('registracija',['errors'=>$validation->getErrors()]);   
        }
//ako je sve ok
        $vreme = new Time('now');
        $korModel = new KorisnikModel();
//sacuvam korisnika
        $korModel->dodaj_korisnika($korIme, $email, $lozinka, $vreme);
        $obican_ili_veran=new Obican_ili_VeranModel();
        $korisnik=$korModel->dohvati_korisnika($korIme);
        $obican_ili_veran->dodaj($korisnik->IdK);
//zapocenm sesiju
        $this->session->set('korisnik', $korisnik);
        $this->session->set('kor_tip', 'korisnice');
        return redirect()->to(site_url("Korisnik/index"));
  }
  public function pregled_predvidjanja() {
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->findAll();      
      $this->prikaz('pregled_predvidjanja', ['predvidjanja'=>$predvidjanja]);
  }
  public function sortPredvidjanjeNovo() {
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najnovija_predvidjanja();      
      $this->prikaz('pregled_predvidjanja', ['predvidjanja'=>$predvidjanja]);     
  }
  public function sortPredvidjanjePopularno() {
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najpopularnija_predvidjanja();      
      $this->prikaz('pregled_predvidjanja', ['predvidjanja'=>$predvidjanja]);     
  }
    public function sortPredvidjanjeNajteze() {
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najteza_predvidjanja();     
      $this->prikaz('pregled_predvidjanja', ['predvidjanja'=>$predvidjanja]);     
  }
  public function pretragaPredvidjanja(){
      
      
      $predvidjanjeModel=new PredvidjanjeModel();
      $korisnik= $this->request->getVar("pretraga");
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($korisnik);
      $this->prikaz('pregled_predvidjanja', ['predvidjanja'=>$predvidjanja]);
  }
  public function pregled_ideja() {
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->findAll();      
      $this->prikaz('pregled_ideja', ['ideje'=>$ideje]);
  }
  public function sortIdejaAktuelno() {
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_najaktuelnije_ideje();      
      $this->prikaz('pregled_ideja', ['ideje'=>$ideje]);     
  }
  public function sortIdejaPopularno() {
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_najpopularnije_ideje();      
      $this->prikaz('pregled_ideja', ['ideje'=>$ideje]);         
  } 
  public function pretragaIdeja(){
      $idejaModel=new IdejaModel();
      $korisnik= $this->request->getVar("pretraga");
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($korisnik);
      $this->prikaz('pregled_ideja', ['ideje'=>$ideje]);
  } 

/** pregled tudjeg profila,gost moze pogledati profile drugih ljudi   **/
   public function pregledtudjegpredv() {
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($data['user']->Username);
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('profilkorisnikpredvidjanja', $data);
   }
   public function pregledtudjegideja() {
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($data['user']->Username);
      $data['ideje']=$ideje;
      $this->prikaz('profilkorisnikideje', $data); 
   }
}
