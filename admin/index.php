<?php
    include('action/action.php');
    $db = new Action;
    if(isset($_GET['newpass'])){
      $new_pass = $_GET['newpass']; //369411
      $email = $_GET['email']; //2sreyka@gmail.//
      $code = $_GET['code'];
      $new_pass = md5($new_pass);
    	$new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
      $db->upd_data("tbl_user","pass='".$new_pass."'","email='".$email."'");
      echo '<h1> Reset new Passowrd is complete.</h1>';
    }



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Dashbord</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="js/jquery-3.4.1.min.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <div class="form-login">

            <div id="welcome">Sign In</div>

          <div class="form-body">
            <input type="text" name="txt-email" id="txt-email" class="frm-login" placeholder="Email">
            <input type="text" name="txt-pass" id="txt-pass" class="frm-login" placeholder="Passowrd">
            <div class="btn-login form-button frm-login">
              <a href="#">Sign In</a>
            </div class="btn-reset-pass">
              <a href="#" id="btn-reset-pass">Forgot Password</a>
          </div>

          <div class="form-footer">

          </div>
      </div>
    </div>
  </body>
<script>
  $(document).ready(function(){
    //reset password
    $('#btn-reset-pass').click(function(){
      var email= $('#txt-email');
      if(email.val()==''){
        alert('Please input Email.');
        email.focus();
        return;
      }$.ajax({
        url:'action/new-pass.php',
        type: 'POST',
        data: {email:email.val()},
        cache: false,
        dataType: 'JSON',
        success: function(data){
            if(data.dpl==false){
              alert('Please input Email Again.');
              return;
            }else if(data.send==false){
              alert('Please try Again.');
              return;
            }else{
              alert('Please check ur Email.');
              return;
            }
        }
      });
    });

    $('.btn-login').click(function(){
      var email= $('#txt-email');
      var pass= $('#txt-pass');
      if(email.val()==''){
        alert('Please input Email.');
        email.focus();
        return;
      }else if(pass.val()==''){
        alert('Please input Password.');
        pass.focus();
        return;
      }
      $.ajax({
        url:'action/login.php',
        type: 'POST',
        data: {email:email.val(),pass:pass.val()},
        cache: false,
        dataType: 'JSON',
        success: function(data){
          if(data.login=='1'){
            window.location.href = "admin.php";
          }else {
            alert('Please input Again.');
          }
        }
      });

    });


  });
</script>
</html>
