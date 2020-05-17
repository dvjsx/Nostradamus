<html>
    <head>
        <title>Nostradamus</title>
    </head>
    <link rel="stylesheet" href="<?php echo base_url();?>/css.css">
    <body>
        <div class="header">
        <form name="loginform" action="<?php site_url("Gost/loginSubmit") ?>" method="post">
        <table style="width:100%;" border="0px">
            <tr>
                <td rowspan="3" width="60%">
                    <a href="<?php echo base_url()."/$controller"; ?>">
                        <?php echo "<img src='".base_url()."/slike/crystal_ball.png'>"; ?>
                    </a></td>
                <td >Dobro dosli <?php echo $kor_tip ?></td>
                
            </tr>
            <tr>
                
                <td width="10%">  <?= anchor("$controller/pregledprofilapredvidjanja", "$korisnik->Username") ?></td>
                <td width="10%"> <?= anchor("Korisnik/logout", "Izloguj se") ?> </td>
            </tr>
            <tr>
                <td colspan="3">
                    <div style="float:right">                        
           
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                   
                </td>
            </tr>    
        </table> 
        </form>
    </div>