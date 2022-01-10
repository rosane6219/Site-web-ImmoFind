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
            <h2>Créez votre compte:</h2>

            <form action="<?php echo Router::url('user/inscription') ?>" method="post">
                <div class="row">
                    <?php echo $this->Form->input('nom', 'Nom ') ?>

                    <?php echo $this->Form->input('prenom', 'Prenom ') ?>

                    <?php echo $this->Form->input('mail', 'Adresse e-mail ') ?>

                    <?php echo $this->Form->input('pass', 'Mot de passe ', array('type' => 'password')) ?>

                    <br>
                    <div class="action">
                        <input type="submit" value="Valider"> <!-- modifier action form -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>