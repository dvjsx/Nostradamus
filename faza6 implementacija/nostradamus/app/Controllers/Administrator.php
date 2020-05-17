<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KorisnikModel;
use CodeIgniter\I18n\Time;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;
use App\Models\PredvidjanjeModel;
use App\Models\IdejaModel;

class Administrator extends BaseController
{
	protected function prikaz($page,$data){
        $data['controller']='Administrator';
        $data['korisnik']=$this->session->get('korisnik');
        $data['kor_tip']=$this->session->get('kor_tip');
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
    /**  pregled sopstvenog profila ,imamo dve metode,jednu za pregled predvidjanja a drugu za pregled ideja **/
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
   
    /**  pregled profila odredjenog korisnika,imamo dve metode,jednu za pregled predvidjanja a drugu za pregled ideja **/
     public function pregledtudjegpredv() {
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($data['user']->Username);
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('prikazprofpredv_admin', $data);
   }
     public function pregledtudjegideja() {
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($data['user']->Username);
      $data['ideje']=$ideje;
      $this->prikaz('prikazideja_admin', $data); 
   }
      
    
    
    

}
