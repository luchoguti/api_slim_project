<?php 

require 'vendor/autoload.php';	
require 'app/config/database.php';
$config = require 'app/config/config.php';

$app = new Slim\App($config);

require 'app/routes/producto.php';

$app->run();
?>