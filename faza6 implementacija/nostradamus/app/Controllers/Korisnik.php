<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KorisnikModel;
use CodeIgniter\I18n\Time;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;
use App\Models\PredvidjanjeModel;
use App\Models\IdejaModel;

class Korisnik extends BaseController
{
   
    protected function prikaz($page,$data){
        $data['controller']='Korisnik';
        $data['korisnik']=$this->session->get('korisnik');
        echo view('sablon/header_korisnik',$data);
        echo view("stranice/$page",$data);
        echo view('sablon/footer');         
    }
    public function index()
    {
        $predvidjanjeModel=new PredvidjanjeModel();
        $predvidjanja=$predvidjanjeModel->findAll();
	$this->prikaz('pregled_predvidjanja', ['predvidjanja'=>$predvidjanja]);
    }
    /** Pregled profila,u planu je i poboljsanje dizajna
     * potrebno je sacuvati i niz predvidjanja i ideja koje pripadaju korisniku(trenutno to ne radi)
     * 
     *  **/
   public function pregledprofila() {
      $data['korisnik']=$this->session->get('korisnik');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja[]=$predvidjanjeModel->dohvati_predvidjanja_korisnika($data['korisnik']->IdK);
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('profil', $data);
   }
  public function uputstvo() {
      return redirect()->to(site_url('stranice/uputstvo.php'));
  }
  public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('/'));
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
