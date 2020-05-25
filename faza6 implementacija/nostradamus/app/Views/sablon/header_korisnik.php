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
                <td class="podesavanje" width="4%" >Dobro dosli </td>
                <td class="podesavanje" ><?php echo $kor_tip ?></td>
            </tr>
            <tr>
                <td with="1%" class="podesavanje">Profil:</td>            
                <td width="5%" height="4%">  <a href='<?php echo base_url()."/$controller/pregledprofilapredvidjanja" ?>' class="linkstyle"><?php echo $korisnik->Username ?></a> </td>
                <td width="10%"> <a href='<?php echo base_url()."/$controller/logout" ?>' class="linkstyle">Izloguj se</a> </td>
                        
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