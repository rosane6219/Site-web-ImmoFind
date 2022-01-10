    <link rel="stylesheet" href="../css/main.css">

    <div class="container">
        <br>
        <?php $title_layout = "Nos collaborateurs" ?>
        <h1>Nos Collaborateurs</h1>
        <br>
        <div class="row" id="myTopnav">
            <?php foreach ($pages as $p) : ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <p>
                    <strong> Nom : </strong> <?php echo $p->nom; ?> <br>
                    <strong> Poste : </strong>     <?php echo  $p->poste; ?><br>
                    <div>
                        <?php
                        $arrayUrl = explode('/', pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_DIRNAME));
                        $imageUrl = $arrayUrl[0] . '//' . $arrayUrl[2] . '/' . BASE_URL . '/' . $p->url;
                        //echo '<img src="' . $imageUrl . '" alt="Chargement de l\'image..." width="40" height="40"/>'
                        echo '<img style="<?php if(empty($page->url)) echo \'display: none\' ?>" src="' . $imageUrl . '" alt="Chargement de l\'image..." width="40" height="40" />'

                        ?>
                        <!--img style="<?php if (empty($p->url)) echo 'display: none' ?>" src="<?php echo pathinfo($_SERVER['HTTP_REFERER'], PATHINFO_DIRNAME) . "/{$p->url}"; ?>" alt="Chargement de l'image..." width="300" height="300" /-->
                    </div>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>