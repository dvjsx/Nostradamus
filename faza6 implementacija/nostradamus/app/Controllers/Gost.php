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
         $this->session->set('kor_tip', 'gost');
        if($page=='registracija')
            echo view('sablon/header_login');
        else
            echo view('sablon/header_gost',$data);
        echo view("stranice/$page",$data);
        echo view('sablon/footer');         
    }
    public function index()
    {$data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->findAll();    
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);
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
            $data['kor_ime']=$this->session->get('kor_tip');
            $predvidjanjeModel=new PredvidjanjeModel();
            $predvidjanja=$predvidjanjeModel->findAll();
            $data['predvidjanja']=$predvidjanja;
            $data['error']=$error;
            return $this->prikaz('pregled_predvidjanja', $data);
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
            $treba_da_postane_veran=((strtotime(date("Y-m-d H:i:s"))- strtotime($korisnik->DatumReg))>'VERNOST');
            if ($treba_da_postane_veran)
            {
                $veranKor->Veran=true;
                $veranModel->save($veranKor);
            }
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
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->findAll();    
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);
  }
  public function sortPredvidjanjeNovo() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najnovija_predvidjanja();      
      $data['predvidjanja']=$predvidjanja;
      $_SESSION['predvidjanje']='novo';
      $this->prikaz('pregled_predvidjanja', $data);     
  }
  public function sortPredvidjanjePopularno() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najpopularnija_predvidjanja();      
      $data['predvidjanja']=$predvidjanja;
      $_SESSION['predvidjanje']='popularno';
      $this->prikaz('pregled_predvidjanja', $data);        
  }
    public function sortPredvidjanjeNajteze() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najteza_predvidjanja();     
      $data['predvidjanja']=$predvidjanja;
      $_SESSION['predvidjanje']='tezina';      
      $this->prikaz('pregled_predvidjanja', $data);          
  }
  public function pretragaPredvidjanja(){
       $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $korisnik= $this->request->getVar("pretraga");
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($korisnik);
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);     
  }
  public function pregled_ideja() {
       $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->findAll(); 
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  }
  public function sortIdejaAktuelno() {
       $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_najaktuelnije_ideje();      
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);     
  }
  public function sortIdejaPopularno() {
       $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_najpopularnije_ideje();      
       $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  } 
  public function pretragaIdeja(){
      $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $korisnik= $this->request->getVar("pretraga");
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($korisnik);
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  } 

/** pregled tudjeg profila,gost moze pogledati profile drugih ljudi   **/
   public function pregledtudjegpredv() {
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($data['user']->Username);
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('tudjprofilpredvidjanja_korisnik', $data);
   }
   public function pregledtudjegideja() {
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($data['user']->Username);
      $data['ideje']=$ideje;
      $this->prikaz('tudjprofilideje_korisnik', $data); 
   }
   public function uputstvo()
   {
       $this->prikaz("uputstvo", []);
   }
  public function voliPredvidjanje(){
      $stranica= $this->session->get('predvidjanje');
      if($stranica=="novo"){
          $this->sortPredvidjanjeNovo();
      }else if($stranica=="popularno"){
          $this->sortPredvidjanjePopularno();
      }else if($stranica=="tezina"){
          $this->sortPredvidjanjeNajteze();
      }else{
          $this->pregled_predvidjanja();
      }
  }  
  public function neVoliPredvidjanje(){
      $stranica= $this->session->get('predvidjanje');
      if($stranica=="novo"){
          $this->sortPredvidjanjeNovo();
      }else if($stranica=="popularno"){
          $this->sortPredvidjanjePopularno();
      }else if($stranica=="tezina"){
          $this->sortPredvidjanjeNajteze();
      }else{
          $this->pregled_predvidjanja();
      }
  }
  public function oceniPredvidjanje(){
      $stranica= $this->session->get('predvidjanje');
      if($stranica=="novo"){
          $this->sortPredvidjanjeNovo();
      }else if($stranica=="popularno"){
          $this->sortPredvidjanjePopularno();
      }else if($stranica=="tezina"){
          $this->sortPredvidjanjeNajteze();
      }else{
          $this->pregled_predvidjanja();
      }
  }   
  
}
