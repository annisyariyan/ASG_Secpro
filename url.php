<?php
// Annisya Riyan Wulandini
//
    $user='root';
    $host="localhost"
    $password="";
    $host="localhost";
    $mysqli=new mysqli($user,$host,$password);

if($mysqli->connect_errno)
{
    die("Can not to connect Database<br>\n");
}
else
{
    if(!$mysqli->select_db('shortlink'))
    {
        die("Database does not exist<br>\n");
    }
    
}
function header_dynamic()
{

    header('Expires: Mon, 31 Jul 2024 04:00:00 GMT');
    header("Last-Modified: ".gmdate("D, d M Y H:i:s"));
    if($_SERVER["SERVER_PROTOCOL"]=="HTTP/1.0")
    {

        header("Pragma: no-cache");
    }

    else
    {
        
        header("Cache-control: no-cache, mut-revalidate");
    }
}
?>