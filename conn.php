<?php

// connect
 $link = mysqli_connect('localhost', 'root', '', 'dbss');


 // if error
 if(mysqli_connect_error()){
 
 
     // die
 
     die('Connection error');

 }

?>