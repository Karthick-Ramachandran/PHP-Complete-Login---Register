<?php
// session start

session_start();
// check if cookie exists
if(array_key_exists('id', $_COOKIE)){
    // if yes, then set that
    $_SESSION['id'] = $_COOKIE['id'];



}
// check if there is a session !!
if(array_key_exists("id", $_SESSION)){

    

echo "<h3>Beautiful you made it!! <a href='index.php?logout=1'>Log out</a> <h3>";



}
else{
    header("Location: index.php");
}

?>