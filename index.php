<?php
// session start
session_start();
// Declaring the Global error Variable
$error = "";

// check user clicked logout button and destroy the session and cookie

if(array_key_exists('logout', $_GET)){
    // destroy the session
    session_destroy();
unset($_SESSION);
// set cookie back to empty
setcookie("id", "", time() - 60*60);
$_COOKIE['id'] = " ";
}
// redirect if authenticated
else if((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])){

    header("Location: loggedin.php");
}

// Check if array key exists.. whether user clicked the Submit button
if(array_key_exists("submit", $_POST)){
    
    // Connect to database 
   include('conn.php');

    // check if the email field has value or empty.


    if($_POST['email'] == ""){
    
    
    // if empty Pushing/appending the error message to error variable
    
    
    $error .= "An email is Required <br/>";


}

    // check if the Password field has value or empty.


if($_POST['password'] == ""){

    // if empty Pushing/appending the error message to error variable

    $error .= "  An Password is Required ";

}

if($error != ""){
    
    // if error array is not empty.. then show the error messages

    $error = "<p> Errors in your Details</p>".$error;

}
// if there is no errors do further step.

else {
    // check if it login and signup
    // if it is signup
    if($_POST['signup'] == '1'){
// check for email id already exists
// in my case table name is users.

// check with query

$query = "SELECT id FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1 ";

// run the query
$result = mysqli_query($link, $query);

// check our rows whether email already exists
if(mysqli_num_rows($result) > 0){
    // pass the error
    $error = "Email is Already taken";
}
else{
    

    // insert the user
    $query = "INSERT INTO `users` (`email` , `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."') ";
    
    // run the query with checking whether response is success or not
    
  if(!mysqli_query($link, $query)){

    // failed message
    $error = "Failed";

  }else{ 
    // hash password
    // getting latest inserted id and then hashing
    $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password']) ."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

    // run the query

    mysqli_query($link, $query);

// start/set session for that user

$_SESSION['id'] = mysqli_insert_id($link);

// if user requested Remember me stay setcookie (in my case I'm setting cookie for an year)

if($_POST['alwayslogin'] == '1'){

    setcookie("id", mysqli_insert_id($link) , time() + 60*60*24*365);

}
    //   success message


    header("Location: loggedin.php");

}

}

}
// or login 
// that is login form
else{
// select the user
    $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' ";
// result
    $result = mysqli_query($link, $query);

    // fetch the array 
    $row = mysqli_fetch_array($result);
    // check if passwords match
    if(isset($row)){
        $hash = md5(md5($row["id"]).$_POST['password']);
        // if matched then set cookie and session
        if($hash == $row['password']){
            $_SESSION['id'] = $row['id'];
            // if remember me then it should be stay looged in
            if($_POST['alwayslogin'] == '1'){
                       // In my case i set cookie for 365 days
                setcookie("id", row['id'] , time() + 60*60*24*365);
            
            }
                //   success message
            
            // redirect
                header("Location: loggedin.php");
        }
// or email/password error
        else{
            $error = "Email password combination not found or error";
        }
    }
    // or Email and Password not exist
    else{

       $error = "Password and email not Exist";

    }

}
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
    <div> <?php 
    // echo error
    echo $error; 
    ?></div>
<div class="container">
<h1>Sign Up</h1>

<form method="post">
<div class="form-group">
<input type="email" name="email" id="" class="form-control">
</div>
<div class="form-group">
<input type="password" name="password" class='form-control'>
</div>
<div class="form-check mt-3 text-center">
  <input class="form-check-input " type="checkbox" name="alwayslogin" value="1" id="defaultCheck1">
  <label class="form-check-label"  for="defaultCheck">
    Remember me
  </label>
</div>
<input type="hidden" name="signup" value='1'>
<input type="submit" name="submit" class="btn btn-primary btn-block mt-3 " value="submit">


</form>
</div>

<div class="container mt-5">
<h1>Login</h1>

<form method="post">
<div class="form-group">
<input type="email" name="email" id="" class="form-control">
</div>
<div class="form-group">
<input type="password" name="password" class='form-control'>
<div class="form-check mt-3 text-center">
  <input class="form-check-input " type="checkbox" value="" id="defaultCheck1">
  <label class="form-check-label" name="alwayslogin" for="defaultCheck">
    Remember me
  </label>
</div>
<input type="hidden" name="signup" value="0">
<input type="submit" name="submit" class="btn btn-info mt-3 btn-block " value="submit">



</form>
</div>


</body>
</html>
