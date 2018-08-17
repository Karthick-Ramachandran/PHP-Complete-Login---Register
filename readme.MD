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

   <div class="container">
<h2 class="mb-3 mt-3 center">Complete Login and Signup Form for CORE PHP Developers with Remember me System (Somewhat Secure too).</h2>
<h3 class='mb-3 center mt-2'>This is how it will look Like.. Check the code.. it is pretty Straight forward..</h3>
</div>
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


<h3> Free for all!! </h3>

</body>
</html>