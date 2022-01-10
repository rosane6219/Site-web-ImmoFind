<!DOCTYPE html>
<!-- banderolle + bien à la une + menu pour acceder aux autres pages?-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImmoFind Administration</title>
    <!--link rel="stylesheet" href="../css/banderolle.css"-->
    <style type="text/css">
        <?php echo $style_for_content; ?>
    </style>
</head>

<body>

    <title> <?php echo isset($title_layout) ? $title_layout : 'ImmoFind'; ?></title>

    <div id="boutonAcceuil">
        <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <h3>Administration</h3>
            <p> </p>
            <a href="<?php echo Router::url("admin/bien/list"); ?>" class="nav-link text-dark">Bien</a> &nbsp;
            <a href="<?php echo Router::url("admin/collabo/list"); ?>" class="nav-link text-dark">Collaborateurs</a> &nbsp;
            <a href="<?php echo Router::url("admin/partner/list"); ?>" class="nav-link text-dark">Partenaires</a> &nbsp;
            <a href="<?php echo Router::url("home"); ?>" class="nav-link text-dark">Voir le site</a> &nbsp;
            <a href="<?php echo Router::url("user/logout"); ?>" class="nav-link text-dark">Se déconnecter</a> &nbsp;
        </nav>
    </div>

    <?php echo $this->Session->flash(); ?>
    <?php echo  $content_for_layout; ?>

</body>

</html>