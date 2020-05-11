<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KorisnikModel;
use CodeIgniter\I18n\Time;
use App\Models\AdministratorModel;
use App\Models\ModeratorModel;

class Gost extends BaseController
{
    protected function prikaz($page,$data){
        
    }
    public function index()
    {
        echo view('login');
    }
    public function registracija(){
        echo view('registracija');
    }
    public function loginSubmit(){
//dohvatim podatke
        $korIme= $this->request->getVar('user');
        $lozinka = $this->request->getVar('pass');
//provera podataka (sifra i korime)
     
        if($korIme==null || $lozinka==null){
            return view('login');
        }
        $korModel = new KorisnikModel();
   
        $korisnik=$korModel->dohvati_korisnika($korIme);
        if($korisnik==null){
             return view('login',['errors'=>['user'=>"Korisničko ime ne postoji"]]);
        }
        if($korisnik->Password != $lozinka){
            return view('login',['errors'=>['pass'=>"Pogresno sete uneli šifru"]]);
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


}
