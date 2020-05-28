<html>
    <head>
        <title>Nostradamus</title>
    </head>
    <link rel="stylesheet" href="<?php echo base_url();?>/css.css">
    <body>
        <div class="header">
        <form name="loginform" action="<?php site_url("Gost/loginSubmit") ?>" method="post">
        <table style="width:100%;" border="0">
            <tr>
                <td rowspan="0" width="60%">
                    <a href="<?php echo base_url()."/$controller"; ?>">
                        <?php echo "<img src='".base_url()."/slike/crystal_ball.png'>"; ?>
                    </a></td>
                    <td class="podesavanje" width="" ><span class="cursive">Dobro dosli, <?php echo $korisnik->Username ?></span></td>
                <td width="5%" rowspan="0">                    
                    <a href='<?php echo base_url()."/$controller/pregledprofilapredvidjanja" ?>'><image src="/slike/avatar.png" height="70px"></a> </td>              
                <td width="10%"> &nbsp&nbsp;<a href='<?php echo base_url()."/$controller/logout" ?>' class="linkstyle">Izloguj se</a> </td>                
            </tr> 
        </table> 
        </form>
    </div>