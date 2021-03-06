<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KorisnikModel;
use CodeIgniter\I18n\Time;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;
use App\Models\PredvidjanjeModel;
use App\Models\IdejaModel;
use \App\Models\Odgovor_naModel;
use App\Models\VoliModel;
use App\Models\DajeOcenuModel;

/***
 * @version 1.0
 * @author Dusan Vojinovic 2017/80
 * @author Janko Kitanovic 2016/694
 * @author Smiljana Spasic 2014/588 - funkcije za pregled sopstvenog i tudjeg profila
 */
class Korisnik extends BaseController
{
   /**
     * 
     * @param string $page stranica koja se prikazuje
     * @param array $data podaci, mogu biti predvidjanja ideje, greske...
     */
    protected function prikaz($page,$data){
        $data['controller']='Korisnik';
        $data['korisnik']=$this->session->get('korisnik');
        $data['kor_tip']=$this->session->get('kor_tip');
        echo view('sablon/header_korisnik',$data);
        echo view("stranice/$page",$data);
        echo view('sablon/footer');         
    }
     /**
     * Pocetna stranica
     * @return void 
     */
    public function index()
    {$data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->findAll();    
      $data['predvidjanja']=$predvidjanja;
      $_SESSION['predvidjanje']='index';      
      $this->prikaz('pregled_predvidjanja', $data);
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
      $trenprikaz='tudjprofilpredvidjanja_korisnik';      
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
      $trenprikaz='tudjprofilideje_korisnik';
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      if(($data['user']->Username)==($this->session->get('korisnik')->Username)) {$data['user']=$this->session->get('korisnik');  $trenprikaz='profilkorisnikideje'; }
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($data['user']->Username);
      $data['ideje']=$ideje;
      $this->prikaz($trenprikaz, $data); 
   }
      /**
       * Prikaz korisnickog uputstva
       */
  public function uputstvo()
   {
       $this->prikaz("uputstvo", []);
   }
   /**
    * Korisnik se izloguje
    * @return void
    */
  public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
    /**
     * Prikazuju se sva predvidjanja
     */
 public function pregled_predvidjanja() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->findAll();    
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);
  }
   /**
     * Prikazuju se sva predvidjanja sortirana po datumu nastanka
     */
  public function sortPredvidjanjeNovo() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najnovija_predvidjanja();      
      $data['predvidjanja']=$predvidjanja;
      $_SESSION['predvidjanje']='novo';
      $this->prikaz('pregled_predvidjanja', $data);     
  }
  /**
     * Prikazuju se sva predvidjanja sortirana po popularnosti
     */
  public function sortPredvidjanjePopularno() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najpopularnija_predvidjanja();      
      $data['predvidjanja']=$predvidjanja;
      $_SESSION['predvidjanje']='popularno';
      $this->prikaz('pregled_predvidjanja', $data);        
  }
  /**
     * Prikazuju se sva predvidjanja sortirana po tezini
     */
    public function sortPredvidjanjeNajteze() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najteza_predvidjanja();     
      $data['predvidjanja']=$predvidjanja;
      $_SESSION['predvidjanje']='tezina';
      $this->prikaz('pregled_predvidjanja', $data);          
  }
  /**
     * Prikazuju se sva predvidjanja datog korisnika
     */
  public function pretragaPredvidjanja(){
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $korisnik= $this->request->getVar("pretraga");
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($korisnik);
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);     
  }
  /**
   * Prikazuju se sve ideje
   */
  public function pregled_ideja() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->findAll(); 
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  }
  /**
     * Prikazuju se sve ideje sortirane po aktuelnosti
     */
  public function sortIdejaAktuelno() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_najaktuelnije_ideje();      
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);     
  }
  /**
     * Prikazuju se sve ideje sortirane po popularnosti
     */
  public function sortIdejaPopularno() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_najpopularnije_ideje();      
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  } 
  /**
   * Prikazuju se sve ideje datog autora
   */
  public function pretragaIdeja(){
      $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $korisnik= $this->request->getVar("pretraga");
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($korisnik);
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  }
  /***
   * Verni korisnik daje ideju
   */
  public function dajIdeju()
  {
      $korisnik= $this->session->get('korisnik');
      $kor_tip= $this->session->get('kor_tip');
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
      $this->prikaz("profilkorisnikideje", ['user'=>$korisnik,'ideje'=>$ideje]);
  }

  /**
   * Korisnik daje predvidjanje. Predvidjanje se cuva u bazi (i prikazuje na stranici). 
   * Ako je predvidjanje odgovor na ideju popularnost ideje i njenog autora se povecavaju.
   */
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
          
          //povecavanje popularnosti korisnika
          $korisnikModel=new KorisnikModel();
          $autor_ideje=$korisnikModel->where("IdK",$ideja->IdK)->first();
          $autor_ideje->Popularnost++;
          $korisnikModel->save($autor_ideje);
      }
      //ako je sve ok
      $predvidjanjeModel->ubaci_novo_predvidjanje($korisnik->IdK,$korisnik->Username, $this->request->getVar('naslovPredvidjanja'), 
              $datum, $this->request->getVar("sadrzajPredvidjanja"));
      if ($ideja!=null)
      {
          $idP=$predvidjanjeModel->poslednje_predvidjanje();
          $odgovor_na->sacuvaj_odgovor($idP, $ideja->IdI);
      }
      $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($korisnik->Username);
      
      
      $this->prikaz("profilkorisnikpredvidjanja", ['user'=>$korisnik,'predvidjanja'=>$predvidjanja]);
  }
  /**
   * Korisnik voli dato predvidjanje. Ako je vec oznacio da ga voli ili ne voli, ne desava se nista, inace se povecava popularnost
   * predvidjanja
   */
  public function voliPredvidjanje()
  {
      $korisnik= $this->session->get("korisnik");
      $predvidjanjeId= $this->request->uri->getSegment(3);
      $predvidjanjeModel=new PredvidjanjeModel();      
      $predvidjanje= $predvidjanjeModel->dohvati_predvidjanja_id($predvidjanjeId);
      $voliModel=new VoliModel();
      if (!$voliModel->vec_voli($korisnik->IdK, $predvidjanje->IdP))
      {          
          $predvidjanjeModel->voli($predvidjanje->IdP, true);
          $posl_id=$voliModel->poslednji_vestackiId();
          $voliModel->voli($korisnik->IdK, $predvidjanje->IdP, $posl_id+1);   
      }
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
  /**
   * Korisnik ne voli dato predvidjanje. Ako je vec oznacio da ga voli ili ne voli, ne desava se nista, inace se povecava popularnost
   * predvidjanja
   */
  public function neVoliPredvidjanje()
  {
      $korisnik= $this->session->get("korisnik");
      $predvidjanjeId= $this->request->uri->getSegment(3);
      $predvidjanjeModel=new PredvidjanjeModel();      
      $predvidjanje= $predvidjanjeModel->dohvati_predvidjanja_id($predvidjanjeId);      
      $voliModel=new VoliModel();
      if (!$voliModel->vec_voli($korisnik->IdK, $predvidjanje->IdP))
      {
          $predvidjanjeModel->voli($predvidjanje->IdP, false);
          $posl_id=$voliModel->poslednji_vestackiId();
          $voliModel->voli($korisnik->IdK, $predvidjanje->IdP, $posl_id+1);
      }
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
  /**
   * Korisnik daje ocenu datom predvidjanju, sto ne radi nista ako je vec bio dao ocenu, inace azurira tezinu.
   */
  public function oceniPredvidjanje()
  {
      $korisnik= $this->session->get("korisnik");
      $predvidjanjeId= $this->request->uri->getSegment(3);
      $predvidjanjeModel=new PredvidjanjeModel();      
      $predvidjanje= $predvidjanjeModel->dohvati_predvidjanja_id($predvidjanjeId);        
      $ocena=$_POST[$predvidjanjeId];//pretpostavljam da ce tako biti najlakse dohvatiti, slovbodno promeniti
      $oceniModel=new DajeOcenuModel();
      if (!$oceniModel->vec_dao_ocenu($korisnik->IdK, $predvidjanje->IdP) || !date("Y-m-d H:i:s")>$predvidjanje->DatumEvaluacije)
      {          
          $predvidjanjeModel->daje_ocenu($predvidjanje->IdP, $ocena);
          $posl_id=$oceniModel->poslednji_vestackiId();
          $oceniModel->daje_ocenu($korisnik->IdK, $predvidjanje->IdP, $ocena, $posl_id+1);
      }
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
  /**
   * 
   * Kad istekne datum evaluacije korisnik daje status svom predvidjanju. Ako je ispunjeno, povecava mu se skor.
   */
  public function dajStatusSvomPredvidjanju()
  {
      $korisnik=$this->session->get("korisnik");
      $idPred=$_COOKIE['idTek'];
      setcookie("idTek", "", time() - 3600);
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanje=$predvidjanjeModel->dohvati_predvidjanja_id($idPred);
      $danas=date("Y-m-d H:i:s");
      //moze da se podeli u tri ifa, radi lepseg ispisa, ali ovde mislim da su svi slucajevi
      if ($danas<$predvidjanje->DatumEvaluacije || $predvidjanje->Status!="CEKA" || $korisnik->IdK!=$predvidjanje->IdK)//ne sme jos da mu daje status
      {
          echo "Greska";
          return;
      }
      $statusV=$this->request->getVar("dane");
      if($statusV=='DA') $status="ISPUNJENO";
      else $status="NEISPUNJENO";
      $predvidjanjeModel->postavi_status($predvidjanje, $status);
      if ($status=="ISPUNJENO")
      {
          $korisnikModel=new KorisnikModel();
          $korisnikModel->uvecaj_skor($korisnik, $predvidjanje->Tezina);
      }
     return redirect()->to( $_SERVER['HTTP_REFERER']);
  }
}
