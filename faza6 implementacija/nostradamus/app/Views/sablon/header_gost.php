<html>
    <head>
        <title>Nostradamus</title>
    </head>
    <link rel="stylesheet" href="<?php echo base_url();?>/css.css">
    <body>
        <div class="header">
        <form name="loginform" action="<?= site_url("Gost/loginSubmit") ?>" method="post">
        <table style="width:100%;" border="0px">
            <tr>
                <td rowspan="3" width="60%">
                    <a href="<?php echo base_url(); ?>"><?php echo img('crystal_ball.png'); ?>
                    </a></td>
                <td width="10%">Korisnicko ime</td>
                <td width="10%">Lozinka</td>
                <td width="10%"></td>
            </tr>
            <tr>
                <td width="10%"><input type="text" placeholder="Username" value="<?= set_value('user')?>" name="user"></td>
                <td width="10%"><input type="password" placeholder="********" name="pass"></td>
                <td width="10%"><input type="submit" class="button1" value="Uloguj se"></td>
            </tr>
            <tr>
                <td> <font color='darkred'> <?php if(!empty($error)) echo $error; ?></font> </td>
                <td colspan="2">
                    <div style="float:right">                        
            <?= anchor("Gost/registracija", "Nemate nalog? Registrujte se!") ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                   
                </td>
            </tr>    
        </table> 
        </form>
    </div>