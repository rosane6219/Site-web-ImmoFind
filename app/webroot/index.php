<?php
//inclure les fichiers necessaire pour le fonctionement du projet
$debut = microtime(true);

define('WEBROOT', dirname(__File__));
define('ROOT', dirname(WEBROOT));
define('DS',DIRECTORY_SEPARATOR);
define('CORE',ROOT.DS.'core');
define('BASE_URL',dirname(dirname($_SERVER['SCRIPT_NAME'])));

require CORE.DS.'include.php';
new Dispatcher();
?>
<div style="position:fixed;bottom:0; background:#900;  line-height:30px; left:0; right:0; padding-left:10px;">
<?php //echo 'Page generée en '.round(microtime(true) -$debut,5).' secondes';?>
</div>
