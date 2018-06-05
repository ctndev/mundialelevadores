<?php 
 /*
    echo 'this';   
       var_dump($_GET);
echo $_GET['url'];



*/
include ('config.php');
include('header.php');


$url = "";
 

if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    $url = "home";
}
 


if (file_exists('pages/'.$url.'.php')) {
    include('pages/'.$url.'.php');
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

 