<link rel="stylesheet" href="../css/main.css">

<div class="container">
    <?php $title_layout = "Nos Partenaires" ?>
    <br>
    <h1>Nos Partenaires</h1>
    <br>
    <div class="row" id="myTopnav">
        <?php foreach ($pages as $p) : ?>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <p>
                <strong> Nom : </strong>  <?php echo  $p->nom; ?> <br>
                <strong> Site web : </strong>  <?php echo  $p->site; ?><br>
                <div>
                    <!--img style="<?php if (empty($p->url)) echo 'display: none' ?>" src="<?php echo pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_DIRNAME) . "/{$p->url}"; ?>" alt="Chargement de l'image..." width="300" height="300" /-->
                    <?php
                    $arrayUrl = explode('/', pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_DIRNAME));
                    $imageUrl = $arrayUrl[0] . '//' . $arrayUrl[2] . '/' . BASE_URL . '/' . $p->url;
                    echo '<img src="' . $imageUrl . '" alt="Chargement de l\'image..." width="40" height="40" />'
                    ?>
                </div>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>