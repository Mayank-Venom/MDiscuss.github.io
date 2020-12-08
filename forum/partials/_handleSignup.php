<?php
$showError ="false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    include '_dbconnect.php';
$user_email = $_POST["signupEmail"];
$pass = $_POST["signupPassword"];
$cpass = $_POST["signupcPassword"];
//$exists=false;
$existSql = "SELECT * FROM `users` WHERE user_email = '$user_email'";
$result = mysqli_query($conn, $existSql);
$numRows = mysqli_num_rows($result);
if($numRows >0){
  $showError = "email already in use";
//   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
//       <strong>error!</strong> Username Already Exist.
//       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//         <span aria-hidden="true">&times;</span>
//        </button>
//      </div>';
}
else {
  //$exists = false;

if(($pass == $cpass)){
  $hash = password_hash($pass,PASSWORD_DEFAULT);  
  $sql = "INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
  $result = mysqli_query($conn, $sql);
    if($result){
        $showAlert = true;
        
        header("Location: /forum/index.php?signupsuccess=true");
  exit();
    }
}
  else{

    
   $showError = "Password do not matched";   

  }
  
  
}  
        header("Location: /forum/index.php?signupsuccess=false&error=$showError");
}

?>

