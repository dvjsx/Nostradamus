<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KorisnikModel;
use CodeIgniter\I18n\Time;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;
use App\Models\PredvidjanjeModel;
use App\Models\IdejaModel;
use App\Models\Odgovor_naModel;
use App\Models\VoliModel;
use App\Models\DajeOcenuModel;

/**
 * @author Katarina Svrkota 2015/648
 * @author Dusan Vojinovic 2017/80
 * @author Smiljana Spasic 2014/588 - funkcije za pregled sopstvenog i tudjeg profila
 * @version 1.0
 */
class Administrator extends BaseController
{
    /**
     * Prikazuje odgovarajucu stranicu
     * @param type $page stranica koja se prikazuje
     * @param type $data podaci koji su joj potrebni (npr. koji je korisnik ili koja predvidjanja itd.)
     */
	protected function prikaz($page,$data){
        $data['controller']='Administrator';
        $data['korisnik']=$this->session->get('korisnik');
        $data['kor_tip']=$this->session->get('kor_tip');
        if (!empty($this->session->getFlashdata('errors'))) 
            $data['errors'] = $this->session->getFlashdata('errors');
        echo view('sablon/header_korisnik',$data);
        echo view("stranice/$page",$data);
        echo view('sablon/footer');         
    }
    /**
     * Pocetna stranica
     */
     public function index()
    {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->findAll();    
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);
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
      $data['kor_ime']=$this->session->get('kor_tip');
      $trenprikaz='prikazprofpredv_admin';      
      $username=$this->request->uri->getSegment(3);
      $korisnikModel=new KorisnikModel();
      $data['user']=$korisnikModel->dohvati_korisnika($username);
      if(($data['user']->Username)==($this->session->get('korisnik')->Username)) {$data['user']=$this->session->get('korisnik'); $trenprikaz='profilkorisnikpredvidjanja'; }
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
    /**
     * Prikazuje predvidjanja
     */
  public function pregled_predvidjanja() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->findAll();    
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);
  }
  /**
   * Prikazuje predvidjanja sortirana po datumu nastanka (novija na vrhu)
   */
  public function sortPredvidjanjeNovo() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najnovija_predvidjanja();      
      $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);     
  }
  /**
   * Prikazuje predvidjanja sortirana po popularnosti (popularnija na vrhu)
   */
  public function sortPredvidjanjePopularno() {
      $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najpopularnija_predvidjanja();      
    $data['predvidjanja']=$predvidjanja;
      $this->prikaz('pregled_predvidjanja', $data);        
  }
  /**
   * Prikazuje predvidjanja sortirana po tezzini (teza na vrhu)
   */
    public function sortPredvidjanjeNajteze() {
        $data['kor_ime']=$this->session->get('kor_tip');
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanja=$predvidjanjeModel->dohvati_najteza_predvidjanja();     
      $data['predvidjanja']=$predvidjanja;
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
  /**
   * Prikaz svih ideja
   */
   public function pregled_ideja() {
       $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->findAll(); 
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  }
  /**
   * Prikaz ideja sortiranih po aktuelnosti (aktuelnija pri vrhu)
   */
  public function sortIdejaAktuelno() {
       $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_najaktuelnije_ideje();      
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);     
  }
  /**
   * Prikaz ideja sortiranih po popularnosti (popularnija pri vrhu)
   */
  public function sortIdejaPopularno() {
       $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $ideje=$idejaModel->dohvati_najpopularnije_ideje();      
       $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  } 
  /**
   * Prikaz ideja datog autora
   */
  public function pretragaIdeja(){
      $data['kor_ime']=$this->session->get('kor_tip');
      $idejaModel=new IdejaModel();
      $korisnik= $this->request->getVar("pretraga");
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($korisnik);
      $data['ideje']=$ideje;
      $this->prikaz('pregled_ideja', $data);
  } 
  /**
   * 
   * Administrator daje ideju. Ideja se cuva u bazi, ili se prikazuje greska na stranici.
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
          //print_r($errors);
          //return;
           $this->session->setFlashdata('errors', $errors);
          return redirect()->to(base_url("Administrator/pregledprofilaideje"));
      }
      
      //ako je sve ok
      $idejaModel->ubaci_novu_ideju($korisnik->IdK,$korisnik->Username, $this->request->getVar('naslovPredvidjanja'), 
              $datum, $this->request->getVar("sadrzajPredvidjanja"));
      
      $ideje=$idejaModel->dohvati_ideje_po_korisnickom_imenu($korisnik->Username);
     // $this->prikaz("profilkorisnikideje", ['user'=>$korisnik,'ideje'=>$ideje]);
      return redirect()->to(base_url("Administrator/pregledprofilaideje"));
  }
  /**
   * 
   * Administrator daje predvidjanje. Predvidjanje se cuva u bazi (i prikazuje na stranici). 
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
        
          $this->session->setFlashdata('errors', $errors);
          return redirect()->to(base_url("Administrator/pregledprofilapredvidjanja"));
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
     // $predvidjanja=$predvidjanjeModel->dohvati_predvidjanja_po_korisnickom_imenu($korisnik->Username);
      
      
       return redirect()->to(base_url("Administrator/pregledprofilapredvidjanja"));
  }
  /**
   * Prikazuje se korisnicko uputstvo
   */
  public function uputstvo()
  {
       $this->prikaz("uputstvo", []);
  }  
  /**
   * Administrator voli dato predvidjanje. Ako je vec oznacio da ga voli ili ne voli, ne desava se nista, inace se povecava popularnost
   * predvidjanja
   */
  public function voliPredvidjanje()
  {
      $korisnik= $this->session->get("korisnik");
      $predvidjanjeId= $this->request->uri->getSegment(3); //slobodno promeniti nacin dohvatanja, poenta je da mi treba predvidjanje koje je voljeno
      $voliModel=new VoliModel();
      if ($voliModel->vec_voli($korisnik->IdK, $predvidjanjeId))
      {
          return redirect()->to( $_SERVER['HTTP_REFERER']);
      }
      else
      {
          $predvidjanjeModel=new PredvidjanjeModel();
          $predvidjanjeModel->voli($predvidjanjeId, true);
          $posl_id=$voliModel->poslednji_vestackiId();
          $voliModel->voli($korisnik->IdK, $predvidjanjeId, $posl_id+1);
      }
       return redirect()->to( $_SERVER['HTTP_REFERER']);
  }
  /**
   * Administrator voli dato predvidjanje. Ako je vec oznacio da ga voli ili ne voli, ne desava se nista, inace se dekrementira popularnost
   * predvidjanja
   */
  public function neVoliPredvidjanje()
  {
      $korisnik= $this->session->get("korisnik");
      $predvidjanjeId= $this->request->uri->getSegment(3); //slobodno promeniti nacin dohvatanja, poenta je da mi treba predvidjanje koje je voljeno
      $voliModel=new VoliModel();
      if ($voliModel->vec_voli($korisnik->IdK, $predvidjanjeId))
      {
          return redirect()->to( $_SERVER['HTTP_REFERER']);
      }
      else
      {
          $predvidjanjeModel=new PredvidjanjeModel();
          $predvidjanjeModel->voli($predvidjanjeId, false);
          $posl_id=$voliModel->poslednji_vestackiId();
          $voliModel->voli($korisnik->IdK, $predvidjanjeId, $posl_id+1);
      }
      return redirect()->to( $_SERVER['HTTP_REFERER']);
  }
  /**
   * Administrator ocenjuje predvidjanje. Ako ga je vec ocenio, ne desava se nista, inace se azurira tezina predvidjanja.
   */
  public function oceniPredvidjanje()
  {
      $korisnik= $this->session->get("korisnik");
      $predvidjanjeId= $this->request->uri->getSegment(3);
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanje= $predvidjanjeModel->dohvati_predvidjanja_id($predvidjanjeId);       
      $ocena=$_POST[$predvidjanjeId];//pretpostavljam da ce tako biti najlakse dohvatiti, slovbodno promeniti
      $oceniModel=new DajeOcenuModel();
     
      if ($oceniModel->vec_dao_ocenu($korisnik->IdK, $predvidjanje->IdP) || date("Y-m-d H:i:s")>$predvidjanje->DatumEvaluacije)
      {
           return redirect()->to( $_SERVER['HTTP_REFERER']);
      }
      else
      {
          
          
          $predvidjanjeModel->daje_ocenu($predvidjanje->IdP, $ocena);
          $posl_id=$oceniModel->poslednji_vestackiId();
          $oceniModel->daje_ocenu($korisnik->IdK, $predvidjanje->IdP, $ocena, $posl_id+1);
      }
      return redirect()->to( $_SERVER['HTTP_REFERER']);
  }
  /**
   * 
   * Kad istekne datum evaluacije administrator daje status svom predvidjanju. Ako je ispunjeno, povecava mu se skor.
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
          echo "GRESKA";
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
  /**
   * 
   * Sankcionise datog korisnika. Korisniku se smanjuje skor za izabrani broj poena (moze da "ode u minus")
   */
  public function sankcionisi_korisnika()
  {

      $sankcionisaniIme= $this->request->getVar('korisnik');
      $kazna=$this->request->getVar('kazna');
     // echo $sankcionisaniIme;
      //echo $kazna;
     $admin= $this->session->get("korisnik");
      $sankcionisaniIme= $this->request->getVar('korisnik');//ili na bilo koji drugi nacin dohvatanje
      $kazna=$this->request->getVar('kazna');//ili na bilo koji drugi nacin dohvatanje
      $korisnikModel=new KorisnikModel();
      $sankcionisani=$korisnikModel->dohvati_korisnika($sankcionisaniIme);
      $korisnikModel->sankcionisi($sankcionisani, $kazna);
      return redirect()->to( $_SERVER['HTTP_REFERER']);
     
  }
  /**
   * 
   * Brise dato predvidjanje
   */
  public function obrisati_predvidjanje()
  {
   
    $idPOST=$_COOKIE['idTek'];
    //$idPolje=$this->request->getVar('tekID');
     //echo "Ok ";
     //if(isset($idPOST)) echo $idPOST;
    setcookie("idTek", "", time() - 3600);
    
    
    //echo "  POST "+ $idPOST;
      //$korisnik=$this->session->get("korisnik");
      //$predvidjanje= $this->session->get("predvidjanje");//ista stvar sa dohvatanjem ovoga
      $predvidjanjeModel=new PredvidjanjeModel();
      $predvidjanjeModel->obrisi_predvidjanje($idPOST);
      $odgovor_na_model=new Odgovor_naModel();
      $odgovor_na_model->obrisi_predvidjanje($idPOST);
      return redirect()->to( $_SERVER['HTTP_REFERER']);
     
  }
 /**
  * 
  * Brise se data ideja i svi odgovori na nju.
  */
  public function obrisati_ideju()
  {
      $IdI=$_COOKIE['idTekIdeja'];
      setcookie("idTekIdeja", "", time() - 3600);
      $idejaModel=new IdejaModel();
      $odgovor_na_model=new Odgovor_naModel();
      $predvidjanja=$odgovor_na_model->vrati_sva_predvidjanja_na_datu_ideju($IdI);
      $odgovor_na_model->obrisi_ideju($IdI);
      
      $predvidjanjeModel=new PredvidjanjeModel();
      $indexi=[];
      foreach ($predvidjanja as $predvidjanje)
      {
           // echo $predvidjanje->Sadrzaj;
           array_push($indexi,$predvidjanje->IdP);
            //$predvidjanjeModel->obrisi_predvidjanje($predvidjanje->IdP);
            
      }
      foreach ($indexi as $idp)
      {
          $predvidjanjeModel->obrisi_predvidjanje($idp);
      }
      //return;
      $idejaModel->obrisi_ideju($IdI);
      return redirect()->to( $_SERVER['HTTP_REFERER']);
  }
  /**
   * 
   * Izabranom korisniku se menja uloga.
   */
  public function promovisati()
  {
      
      $promovisaniIme=$this->request->getVar('korisnik');
      $korisnikModel=new KorisnikModel();
      $promovisani=$korisnikModel->dohvati_korisnika($promovisaniIme);
      $stara_uloga=$korisnikModel->pronadjiUlogu($promovisani);
      if($stara_uloga=='OBICAN' || $stara_uloga=="ADMIN") { 
          return redirect()->to( $_SERVER['HTTP_REFERER']);
      }
      $uloga=$this->request->getVar('uloga');
      if($uloga=='admin') $nova_uloga='ADMIN';
      else if($uloga=='mod') $nova_uloga='MODERATOR';
      $korisnikModel->promovisi($promovisani, $stara_uloga, $nova_uloga);
      return redirect()->to( $_SERVER['HTTP_REFERER']);
      
  }
  
}