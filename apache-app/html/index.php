<?php

$usr = "";
$psw = "";
$pswErr = "";
$usrErr = "";


$logErr = true;
$display = "display:none;";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  $display = "display:block;";

  $usr = validate_fields($_POST['usr']);
  $pattern = "/^[a-zA-Z ]*$/";
  if (empty($usr)) {
    $usrErr = "Username is required";
    $logErr = true;
  } elseif (!preg_match($pattern,$usr)) {
     $usrErr = "Only letters allowed";
     $logErr = true;
  } else {
     $logErr = false;
  }

  $psw = validate_fields($_POST['psw']);
  $pattern = "/^(?=.*[\p{P}\p{S}])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/";
  if (empty($psw)) {
    $pswErr = "Password is required";
    $logErr = true;
  } elseif (!preg_match($pattern,$psw)) {
     $pswErr = "Invalid Password";
     $logErr = true;
  } else {
    $logErr = false;
  }
}

if ( !$logErr)  {
session_start();
session_id();

}

function validate_fields($data_field) {
  $data_field = str_replace('\n', "", $data_field);
  $data_field = trim($data_field);
  $data_field = str_replace('\\', "", $data_field);
  $data_field = htmlentities($data_field);

  return $data_field;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Login Form</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <script href="js/bootstrap.min.js"></script>
   <style>

body {
background: linear-gradient(to bottom, red, white, blue);
background-attachment: fixed;
background-repeat: no-repeat;
overflow: scroll;
font-family: "Comic Sans MS", cursive, sans-serif;
}
input {
width: 100%;
padding: 12px;
border: 1px solid #ccc;
border-radius: 10px;
box-sizing: border-box;
margin-top: 6px;
margin-bottom: 16px;
}

#sub {
background-color: blue;
border-radius: 10px;
color: white;
}

.container {
width: 300px;
margin: 0 auto;
border-radius: 10px;
background-color: #f1f1f1;
padding: 20px;
}

#message {
display:none;
width: 300px;
margin: 0 auto;
background: #f1f1f1;
color: #000;
position: relative;
padding: 20px;
margin-top: 10px;
}

#message p {
padding: 10px 35px;
font-size: 18px;
}

.valid {
color: green;
}

.invalid {
color: red;
}
   </style>
</head>
<body>
   <div class="container">
      <form name="loginform" id="loginform" method="post" action="<?=($_SERVER['PHP_SELF'])?>">
         <p>Username<br>
         <input type="text" id="usr" name="usr">*Required</p>
	     <p>Password<br>
         <input type="password" id="psw" name="psw">*Required, 1 uppercase 1 lowercase, 1 number, 8-20 characters</p>
         <input type="submit" id="sub" name="sub" value="Log In">
      </form>
   </div>
   <div id="message" style="<?php echo $display; ?>">
     <?php if (!empty($usrErr)) { ?>
     <p class="invalid"><?php echo $usrErr; ?></p>
     <?php } ?>
     <?php if (!empty($pswErr)) { ?>
     <p class="invalid"><?php echo $pswErr; ?></p>
     <?php } ?>

     <p>Review in WireShark these fields:</p>
     <p>Username: <?php echo $usr; ?></p>
     <p>Password: <?php echo $psw; ?></p>
   </div>
</body>
</html>
