<?php
date_default_timezone_set('Africa/Maputo');
session_start();
ob_start();
define('URL', 'http://localhost/mbm_escolas/');

define('CONTROLER', 'controle-login');
define('METODO', 'login');

//Credenciais de acesso ao BD
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'vertrigo');
define('DBNAME', 'mbm_escolas');

function __autoload($Class) {
    $dirName = array(
        'controllers',
        'models',
        'models/helper',
        'views',
        'config',
        'modules/estudante',
        'modules/estudante/views',
        'modules/inscricao',
        'modules/inscricao/views',
        'modules/home',
        'modules/home/views',
    );
    foreach ($dirName as $diretorios) {
        if (file_exists("{$diretorios}/{$Class}.php")):
            require("{$diretorios}/{$Class}.php");        
        endif;
    }
    
}
