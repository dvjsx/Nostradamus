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
    /**  pregled sopstvenog profila odredjenog korisnika,imamo dve metode,jednu za pregled predvidjanja a drugu za pregled ideja **/
   public function pregledprofilapredvidjanja() {
      $data['user']=$this->session->get('korisnik');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($data['user']->Username);
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('profilkorisnikpredvidjanja', $data);
   }
   public function pregledprofilaideje() {
      $data['user']=$this->session->get('korisnik');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($data['user']->Username);
      $data['ideje']=$ideje;
      $this->prikaz('profilkorisnikideje', $data);
   }
   
   /** pregled tudjeg profila,ukoliko se korisnik nalazi na pocetnoj stranici i zeli da pogleda profil drugog korisnika,
    *  takodje 2 metode jedna za ideje,druga za predvidjanja   **/
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

}
