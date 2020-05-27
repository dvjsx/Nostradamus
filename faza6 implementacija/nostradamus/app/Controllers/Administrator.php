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
      $trenprikaz='prikazprofpredv_admin';      
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      if(($data['user']->Username)==($this->session->get('korisnik')->Username)) {$data['user']=$this->session->get('korisnik');  $trenprikaz='profilkorisnikpredvidjanja'; }
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($data['user']->Username);
      $data['predvidjanja']=$predvidjanja;
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
  //netestirano, promeniti ako je promenjeno u Korisnik
  public function dajIdeju()
  {
      $korisnik= $this->session->get('korisnik');
      $kor_tip= $this->sesssion->get('kor_tip');
      $idejaModel=new IdejaModel();
      $errors=[];
      $naslov=$this->request->getVar('naslovPredvidjanja');
      $datum=$this->request->getVar("datumPredvidjanja");
      if ($datum<date("Y-m-d H:i:s"))
      {
          $errors["datum"]="Morate uneti datum u buducnosti";
      }
      if ($kor_tip=="korisnice")
      {
          $errors["korisnik"]="Morate da budete verni korisnik (bar 3 dana na sajtu) da biste davali ideje"; 
      }
      $validation =\Config\Services::validation();
      $validation->setRuleGroup('dodavanje_ideja');
      if (!$validation->run(["datum"=>$this->request->getVar("datumPredvidjanja"),"sadrzaj"=>$this->request->getVar("sadrzajPredvidjanja"),"naslov"=>$naslov],'dodavanje_ideja')) {
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
      $idejaModel->ubaci_novu_ideju($korisnik->IdK,$korisnik->Username, $this->request->getVar('naslovPredvidjanja'), 
              $datum, $this->request->getVar("sadrzajPredvidjanja"));
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($korisnik->Username);
      $this->prikaz("profilkorisnikideje", ['user'=>$korisnik,'predvidjanja'=>$predvidjanja]);
  }
  public function dajPredvidjanje()
  {
      $korisnik= $this->session->get('korisnik');
      
      $predvidjanjeModel=new PredvidjanjeModel();
      //provera
      $errors=[];$ideja=null;
      $naslov=$this->request->getVar('naslovPredvidjanja');
      $datum=$this->request->getVar("datumPredvidjanja");
      if ($naslov!="" && $naslov[0]=="#")
      {
          $odgovor= substr($naslov, 1);
          $idejaModel=new IdejaModel();
          $ideja=$idejaModel->where("Naslov",$odgovor)->first();
          if ($ideja==null)//znaci da nije odgovor ni na jednu ideju, a pocinje sa #
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
      //ako je odgovor na ideju
      if ($ideja!=null)//Povecava se popularnost ideje, povecava se popularnost korisnika,pamti se odgovor na ideju
      {
          $datum=$ideja->DatumEvaluacije;//ako je promasio, smatracemo da je slucajno i da je sigurno hteo dobar datum
          //povecanje popularnosti ideje
          $idejaModel->povecaj_popularnost($ideja->IdI);
          //cuvanje odgovora
          $odgovor_na=new Odgovor_naModel();
          $idP=$predvidjanjeModel->poslednje_predvidjanje();
          $odgovor_na->sacuvaj_odgovor($idP, $ideja->IdI);
          //povecavanje popularnosti korisnika
          $korisnikModel=new KorisnikModel();
          $autor_ideje=$korisnikModel->where("IdK",$ideja->IdK)->first();
          $autor_ideje->Popularnost++;
          $korisnikModel->save($autor_ideje);
      }
      //ako je sve ok
      $predvidjanjeModel->ubaci_novo_predvidjanje($korisnik->IdK,$korisnik->Username, $this->request->getVar('naslovPredvidjanja'), 
              $datum, $this->request->getVar("sadrzajPredvidjanja"));
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($korisnik->Username);
      
      
      $this->prikaz("profilkorisnikpredvidjanja", ['user'=>$korisnik,'predvidjanja'=>$predvidjanja]);
  }
  public function uputstvo()
   {
       $this->prikaz("uputstvo", []);
   }  
    

}
