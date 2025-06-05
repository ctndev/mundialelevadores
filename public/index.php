<?php 
 
include ('config.php');
include('header.php');


$url = "";

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');
$url = $path !== '' ? $path : 'home';

// Sanitiza a variável para evitar inclusão de arquivos indesejados
$url = basename($url);

$caminhoPagina = "pages/{$url}.php";

if (is_file($caminhoPagina)) {
    include($caminhoPagina);
} else {
    include('pages/404.php');
}



 include('footer.php');

/*
if (file_exists($url.'.php')) {
    echo 'existe';
}





*/








?>

 