
<div class="wrapper">
  <div class="close-area"> </div>
  <div class="form-login">
      <div id="welcome">Sign In</div>
      <div class="form-body">
        <input type="text" name="txt-email" id="txt-email" class="frm-login" placeholder="Email">
        <input type="text" name="txt-pass" id="txt-pass" class="frm-login" placeholder="Passowrd">
        <div class="btn-login form-button frm-login">
          <a href="#" id="login-user">Sign In</a>
        </div class="btn-reset-pass">
          <a href="#" id="btn-reset-pass">Forgot Password</a>
      </div>

      <div class="form-footer">

      </div>
  </div>
</div>
<script>
$(document).ready(function() {
  //login User
  $('#login-user').click(function() {
    var email =$('#txt-email');
    var pass  =$('#txt-pass');

    $.ajax({
    url:'./admin/action/login-user.php',
    type:'POST',
    data:{email:email.val(),pass:pass.val()},
    cache:false,
    dataType:'JSON',
      success:function(data){
        if(data.login=='1'){
          window.location.href = "index.php";
          
        }else{
          alert('Your E-mail or Password is incorrect. Please try again');
        }

      }
    });
  });

});
</script>
