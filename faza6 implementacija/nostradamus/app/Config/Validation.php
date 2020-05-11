<?php namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
        
         public $registracija = [
        'korIme' => [
            'rules'  => 'required|min_length[2]|max_length[20]|alpha_dash|is_unique[korisnik.Username]',
            'errors' => [
                'required' => 'Molimo Vas da unesete korisničko ime',
                'min_length'=>'Molimo Vas da uneste korisničko ime koje sadrži bar 2 znaka',
                'max_length'=>'Molimo Vas da uneste korisničko ime koje je kraće od 20 znakova',
                'alpha_dash'=>'Unešeno korisničko sadrži nedozvoljene znake. Dozvoljeni znaci su A-Z,a-z,0-9,-,_',
                'is_unique'=> 'Korisničko ime već postoji'
            ]
        ],
        'mail'    => [
            'rules'  => 'required|valid_email|is_unique[korisnik.Email]',
            'errors' => [
                'valid_email' => 'Unešeni e-mail nije ispravan',
                'required'=>'Molimo Vas da unesete mail',
                'is_unique'=> 'Već postoji nalog sa unetom e-mail adresom'
            ]
        ],
        'lozinka' =>[
            'rules' => 'required|min_length[6]|max_length[20]|alpha_numeric_punct|regex_match[/\d/]|regex_match[/[A-Z]/]',
            'errors'=>[
                'required' => 'Molimo Vas da unesete lozinku',
                'min_length'=>'Molimo Vas da uneste lozinku koja sadrži bar 6 znakova',
                'max_length'=>'Molimo Vas da uneste lozinku koja sadrži manje od 20 znakova',
                'alpha_dash'=>'Unešena lozinka sadrži nedozvoljene znake. Dozvoljeni znaci su A-Z,a-z,0-9,~,!,#,$,%,&,*,-, _,+,=,|,:,.',
                'regex_match'=>'Molimo Vas da uneste lozinku koja sadrži bar jedan broj i bar jedno veliko slovo'
            ]
        ],
        'reLozinka'=>[
            'rules'=>'required|matches[lozinka]',
            'errors'=>[
                'required'=>'Molimo Vas da potvrdite unešenu lozinku',
                'matches'=>'Lozinka nije ispravno potvrđena. Molimo Vas da ponovo potvrdite lozinku',
            ]
        ]
    ];
   public $login = [
        'user' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Molimo Vas da uneste korisničko ime'
            ]
        ],
        'pass'    => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Molimo Vas da uneste lozinku'
            ]
        ],
    ];
}
