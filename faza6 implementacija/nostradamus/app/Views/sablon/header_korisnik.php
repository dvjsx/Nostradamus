<html>
    <head>
        <title>ETF Vesti</title>
    </head>
    <body>
        <?= anchor("Korisnik/index", "Predvidjanja") ?>
        <?= anchor("Korisnik/mojeVesti", "Ideje") ?> 
        <?= anchor("Korisnik/dodajVest", "Dodaj predvidjanje") ?> 
        <div style="float: right">
            Autor: <?php  echo $autor->ime." ".$autor->prezime." "; ?>
            <?= anchor("Korisnik/logout", "Izloguj se") ?> 
        </div>
        <br>
        <hr>
        