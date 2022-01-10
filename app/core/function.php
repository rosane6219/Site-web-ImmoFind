<?php
function debug($var)
{
    if (Conf::$debug > 0) {
        $debug = debug_backtrace();
        echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>' . $debug[0]['file'] . ' </strong> l.' . $debug[0]['line'] . '</a></p>';
        echo '<ol>'; //style="display:none"
        foreach ($debug as $k => $v) {
            if ($k > 0) {
                echo '<li><strong>' . $v['file'] . ' </strong> l.' . $v['line'] . '</li>';
            }
        }
        echo '</ol>';
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

function uploadImage($file, $error)
{
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png', '.jfif', '.tiff');
    if ($file['error'] > 0) {
        $error = " Une erreur est survenue lors du transfert.";
        return null;
    }

    $fileName = $file['name'];
    $fileExt = '.'.pathinfo($fileName, PATHINFO_EXTENSION);

    if (!in_array($fileExt, $validExtensions)) {
        $error = " Le fichier n'est pas une image";
        return null;
    }

    $tmpName = $file['tmp_name'];
    $uniqueName = md5(uniqid(rand(), true));
    $fileName = "uploads/" . $uniqueName . $fileExt;

    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    $result = move_uploaded_file($tmpName, $fileName);
    
    if ($result) return $fileName;
    else return null;
}

function downloadImage($url)
{
    $fileExt = pathinfo($url, PATHINFO_EXTENSION);
    header('Content-type: image/' . $fileExt);
    //$image=file_get_contents($url);
    //$response = '<img src="'.$url.'" alt="Chargement de l\'image"';
    return file_get_contents($url);
}
