<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Korisnik extends BaseController
{
    public function index()
    {
        echo 'Hello World!';
    }
    public function proba($vreme)
    {
        echo 'Hello World!';
        echo $vreme;
    }
}