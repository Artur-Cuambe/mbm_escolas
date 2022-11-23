<?php
date_default_timezone_set('Africa/Maputo');
session_start();
ob_start();
define('URL', 'http://localhost/sis_stock/');

define('CONTROLER', 'controle-login');
define('METODO', 'login');

//Credenciais de acesso ao BD
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'vertrigo');
define('DBNAME', 'sis_stock');

function __autoload($Class) {
    $dirName = array(
        'controllers',
        'models',
        'models/helper',
        'views',
        'config'
    );
    foreach ($dirName as $diretorios) {
        if (file_exists("{$diretorios}/{$Class}.php")):
            require("{$diretorios}/{$Class}.php");        
        endif;
    }
    
}
