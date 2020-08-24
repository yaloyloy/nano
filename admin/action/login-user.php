<?php
  session_start();
  include('action.php');
  $db = new Action;

  $email= $_POST['email'];
  $pass = $_POST['pass'];
  $pass = trim($pass);
  $pass = $db->real_string($pass);
  $pass = md5($pass);
  
  $utype= $_POST['user_type'];

  $res['login']='0';
  $ip = $_SERVER['REMOTE_ADDR'];
  $dpl = $db->dpl_data("*","tbl_userprice","email='".$email."'");

  if($dpl==true){
    $post_data=$db->get_cur_data("*","tbl_userprice","email='".$email."'");
    // $res['pass']=$post_data[2];
    if(password_verify($pass, $post_data[3])){
        // Success !
      $db->upd_data("tbl_userprice","ip='".$ip."'","email='".$email."'");
      $res['login']='1';
      $_SESSION['email']=$email;
      $_SESSION['user_type']=$post_data[4];

    }
    $res['dpl']=true;
  }else {
    $res['dpl']=false;
  }
  echo json_encode($res);

?>
