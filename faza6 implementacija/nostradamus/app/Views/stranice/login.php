<html>
    <head>
     <title>Nostradamus</title>
        <meta charset="UTF-16le">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    </head>
    
    <body>
        <form method="post" action="<?= site_url("Gost/loginSubmit") ?>">
            <table>
                <tr>
                    <td>Korisničko ime:</td>
                    <td><input type='text' name='user' value="<?= set_value('user')?>"></td>
                    <td> <font color='red'> <?php if(!empty($errors['user'])) echo $errors['user'];?></font> </td>
                </tr>
                <tr>
                    <td>Lozinka:</td>
                    <td><input type='password' name='pass'"></td>
                    <td> <font color='red'> <?php if(!empty($errors['pass'])) echo $errors['pass'];?></font> </td>
                </tr>
                <tr>
                    <td><button type='submit'>Uloguj se</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>