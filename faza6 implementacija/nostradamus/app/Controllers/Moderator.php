<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\KorisnikModel;
use CodeIgniter\I18n\Time;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;
use App\Models\PredvidjanjeModel;
use App\Models\IdejaModel;
class Moderator extends BaseController
{
	
	protected function prikaz($page,$data){
        $data['controller']='Moderator';
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
      $trenprikaz='prikazprofpredv_admin';      
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      if(($data['user']->Username)==($this->session->get('korisnik')->Username)) {$data['user']=$this->session->get('korisnik');  $trenprikaz='profilkorisnikpredvidjanja'; }
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($data['user']->Username);
      $data['predvidjanja']=$predvidjanja;
      $data['kor_tip']=$this->session->get('kor_tip');
      $this->prikaz($trenprikaz, $data);
     }
     public function pregledtudjegideja() {
      $trenprikaz='prikazideja_admin';
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      if(($data['user']->Username)==($this->session->get('korisnik')->Username)) {$data['user']=$this->session->get('korisnik');  $trenprikaz='profilkorisnikideja'; }
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($data['user']->Username);
      $data['ideje']=$ideje;
      $data['kor_tip']=$this->session->get('kor_tip');
      $this->prikaz($trenprikaz, $data); 
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
  public function dajPredvidjanje()
  {
      $korisnik= $this->session->get('korisnik');
      
      $predvidjanjeModel=new PredvidjanjeModel();
      
      //provera
      $errors=[];
      $naslov=$this->request->getVar('naslovPredvidjanja');
      $datum=$this->request->getVar("datumPredvidjanja");
      if ($naslov!="" && $naslov[0]=="#")
      {
          $odgovor= substr($naslov, 1);
          $idejaModel=new IdejaModel();
          if ($idejaModel->where("Naslov",$odgovor)->find()==null)//znaci da nije odgovor ni na jednu ideju, a pocinje sa #
          {
              
              $errors["naslov"]="Ako Vase tvrdjenje nije odgovor na ideju, nemojte stavljati # kao pocetni karakter";
              //return;
              //odavde prikazati gresku i zavrsiti
          }
      }
      if ($datum<date("Y-m-d H:i:s"))
      {
          $errors["datum"]="Morate uneti datum u buducnosti";
      }
      $validation =\Config\Services::validation();
      $validation->setRuleGroup('dodavanje_predvidjanja');
      if (!$validation->run(["datum"=>$this->request->getVar("datumPredvidjanja"),"sadrzaj"=>$this->request->getVar("sadrzajPredvidjanja"),"naslov"=>$naslov],'dodavanje_predvidjanja')) {
          $errors=$validation->getErrors(); 
          //return;
       }
      
      if (!empty($errors))
      {
          //ovde zavrsiti, print_r je za testiranje
          print_r($errors);
          return;
      }
      //ako je sve ok
      $predvidjanjeModel->ubaci_novo_predvidjanje($korisnik->IdK,$korisnik->Username, $this->request->getVar('naslovPredvidjanja'), 
              $this->request->getVar("datumPredvidjanja"), $this->request->getVar("sadrzajPredvidjanja"));
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($korisnik->Username);
      $this->prikaz("profilkorisnikpredvidjanja", ['user'=>$korisnik,'predvidjanja'=>$predvidjanja]);
  }  
  public function uputstvo()
   {
       $this->prikaz("uputstvo", []);
   }
}
