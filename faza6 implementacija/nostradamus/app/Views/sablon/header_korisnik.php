<html>
    <head>
        <title>Nostradamus</title>
    </head>
    <link rel="stylesheet" href="<?php echo base_url();?>/css.css">    
    <body>
        <?= anchor("Korisnik/index", "Nostradamus") ?>
        <div style="float: right">
            Autor: <?php  echo $autor->ime." ".$autor->prezime." "; ?>
            <?= anchor("Korisnik/logout", "Izloguj se") ?> 
        </div>
        <br>
        <hr>
        