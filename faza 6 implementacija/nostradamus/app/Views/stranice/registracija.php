<html>
    <head>
        <title>NOSTRADAMUS</title>
        <meta charset="UTF-16le">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url();?>/reg.css">
    </head>
    <body>
    
        <form class='form' id='reg_forma' method='post' action="<?= site_url("Gost/regSubmit") ?>">
            <table>
                <tr> 
                    <td>Korisničko ime: </td> 
                    <td> <input type='text' name='korIme' value="<?php set_value('korIme')?>"></td>     
                </tr>
                <tr>
                    <td colspan="2" > <font class='message' color='red'> <?php if(!empty($errors['korIme'])) echo $errors['korIme'];?></font> </td>  
                </tr>
                <tr> 
                    <td>E-mail: </td> 
                    <td><input type='Email' name='mail' value="<?= set_value('mail') ?>"> </td>
                </tr>
                <tr>
                    <td colspan="2"> <font class='message' color='red'> <?php if(!empty($errors['mail'])) echo $errors['mail'];?></font></td>  
                </tr>
                <tr> 
                    <td> Lozinka: </td> 
                    <td><input type='password' name='lozinka'> </td>
                    <td> </td>
                </tr>
                <tr>
                    <td colspan="2" style="max-width:10px">  <font class='message' color='red'> <?php if(!empty($errors['lozinka'])) echo $errors['lozinka'];?></font></td>  
                </tr>
                <tr> 
                    <td> Potvrdite lozinku: </td> 
                    <td> <input type='password' name='reLozinka'></td>
                    <td>  </td>
                </tr>
                <tr>
                    <td colspan="2"> <font class='message' color='red'> <?php if(!empty($errors['reLozinka'])) echo $errors['reLozinka'];?></font></td>  
                </tr>
                <tr > <td colspan='2'> <button type='submit' name='submit'>Registruj se</button> </td> </tr>

            </table>
        </form>
      
    </body>
</html>
