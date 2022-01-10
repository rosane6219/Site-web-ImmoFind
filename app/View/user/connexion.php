<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>

    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <h2>Connectez-vous</h2>

            <form id="userConnection" action="<?php echo Router::url('user/connexion') ?>" method="post">


                <?php echo $this->Form->input('mail', 'Mail') ?>
                <br> <br>


                <?php echo $this->Form->input('pass', 'Mot de passe', array('type' => 'password')) ?>
                <br><br>

                <br>
                <div class="action">
                    <input type="submit" name="connexion" value="Se connecter">
                </div>
            </form>

            <br>
            
            <a href="<?php echo Router::url("accueil/index"); ?>" title=""> Home</a>
            <br> <br>
            <span>Vous n'avez pas encore de compte ?</span> <a href="<?php echo Router::url("user/inscription"); ?>">Créez-en un maintenant !</a>
        </div>
    </div>

</body>

</html>