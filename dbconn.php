<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "parkirinaja";
$conn = mysqli_connect($server,$user,$password,$db);
if($conn){
echo '';

}else{
    echo 'Not Connected';
}

?>