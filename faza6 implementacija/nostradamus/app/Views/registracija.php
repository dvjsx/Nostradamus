<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-16le">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        <form id='reg_forma' method='post' action="<?= site_url("Gost/regSubmit") ?>">
            <table>
                <tr> 
                    <td>Korisničko ime: </td> 
                    <td> <input type='text' name='korIme' value="<?= set_value('korIme')?>"></td>
                    <td> <font color='red'> <?php if(!empty($errors['korIme'])) echo $errors['korIme'];?></font> </td>      
                </tr>
                <tr> 
                    <td>E-mail: </td> 
                    <td><input type='Email' name='mail' value="<?= set_value('mail') ?>"> </td>
                    <td> <font color='red'> <?php if(!empty($errors['mail'])) echo $errors['mail'];?></font> </td>
                </tr>
                <tr> 
                    <td> Lozinka </td> 
                    <td><input type='password' name='lozinka'> </td>
                    <td> <font color='red'> <?php if(!empty($errors['lozinka'])) echo $errors['lozinka'];?></font> </td>
                </tr>
                <tr> 
                    <td> Potvrdite lozinku:</td> 
                    <td> <input type='password' name='reLozinka'></td>
                    <td> <font color='red'> <?php if(!empty($errors['reLozinka'])) echo $errors['reLozinka'];?></font> </td>
                </tr>
                <tr > <td colspan='2'> <button type='submit' name='submit'>Registruj se</button> </td> </tr>

            </table>
        </form>
    </body>
</html>
