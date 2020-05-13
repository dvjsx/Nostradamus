<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KorisnikModel;
use CodeIgniter\I18n\Time;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;
use App\Models\PredvidjanjeModel;
use App\Models\IdejaModel;

class Gost extends BaseController
{
    protected function prikaz($page,$data){
        $data['controller']='Gost';
        if(($page=='login'||$page=='registracija'))
            echo view('sablon/header_login');
        else
            echo view('sablon/header_gost');
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
    public function login() {
        $this->prikaz('login', []);
    }
    public function loginSubmit(){
//dohvatim podatke
        $korIme= $this->request->getVar('user');
        $lozinka = $this->request->getVar('pass');
//provera podataka (sifra i korime)
     
        if($korIme==null || $lozinka==null){            
            $this->prikaz('login', $korIme);
        }
        $korModel = new KorisnikModel();
   
        $korisnik=$korModel->dohvati_korisnika($korIme);
        if($korisnik==null){
             return view('login',['errors'=>['user'=>"Korisničko ime ne postoji"]]);
        }
        if($korisnik->Password != $lozinka){
            return view('login',['errors'=>['pass'=>"Pogresno ste uneli šifru"]]);
        }
 //ako su ok
     
 //nadjem tip korisnika      
        $admModel = new AdministratorModel();
        $modModel = new ModeratorModel();
        $kor_tip='kor';
        if($admModel->dohvati_korisnika($korisnik->IdK)!=null) $kor_tip='admin';
        else if($modModel->dohvati_korisnika($korisnik->IdK)!=null) $kor_tip='mod';
//sacuvam podatke u sesiju         
        $this->session->set('korisnik', $korisnik);
        $this->session->set('kor_tip', $kor_tip);
        return redirect()->to(site_url("Korisnik/index"));
        
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
           return view('registracija',['errors'=>$validation->getErrors()]);   
        }
//ako je sve ok
        $vreme = new Time('now');
        $korModel = new KorisnikModel();
//sacuvam korisnika
        $korModel->dodaj_korisnika($korIme, $email, $lozinka, $vreme);
        $korisnik=$korModel->dohvati_korisnika($korIme);
//zapocenm sesiju
        $this->session->set('korisnik', $korisnik);
        $this->session->set('kor_tip', 'kor');
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
      $korisnik= pretragaPredvidjanja($this->request->getVar('pretraga'));
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_korisnika($korisnik);
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
      $ideje=$idejaModel->dohvati_ideje_korisnika("");
      $this->prikaz('pregled_ideja', ['ideje'=>$ideje]);
  } 


}
