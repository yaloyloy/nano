<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Dashbord</title>
<link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Roboto:900,900italic,500,400italic,100,700italic,300,700,500italic,100italic,300italic,400' type='text/css'>
<link rel="stylesheet" href="style/login.css">
<link rel="stylesheet" href="style/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script>

</head>
<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img src="img/uiux/logo.png" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form>
        <input type="text" id="login" class="fadeIn second" name="login" placeholder="login" autocomplete="additional-name">
        <input type="text" id="password" class="fadeIn third" name="login" placeholder="password">
        <input type="submit" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover txt-forgot" href="#">Forgot Password?</a>
      </div>

    </div>
  </div>
</body>
<script>
  $(document).ready(function(){
    $('.btn')


  });
</script>


</html>
