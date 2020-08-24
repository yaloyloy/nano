<?php
	session_start();
	include('../../_config_inc.php');
	$BASE_URL = BASE_URL;
	include('action.php');
	$db=new Action;
	$res['dpl']=false;
	$email= $_POST['email']; //la3la3168@gmail.com

	$pass=mt_rand(100000, 999999);
	$verify_code = mt_rand(100000, 999999);

	$dpl = $db->dpl_data("*","tbl_user","email='".$email."'");

	if($dpl==true){
		$db->upd_data("tbl_user","verify_code='".$verify_code."'","email='".$email."'");
		$headers = "MIME-Version: 1.0". "\r\n";
		$headers .= "Content-type:text/html; charset=UTF-8" . "\r\n";
		$headers .= 'From: Rean Web noreplay@reanweb.com'. "\r\n";

		$msg='<html><body><p>Dear: User</p>'.
			'<p>We have received a request to reset your system password.</p>'.
			'<h4>New Password: '.$pass.'</h4>'.
			'<p>Click link below to verify your new password:</p>'.
			'<p><a href="'.$BASE_URL.'admin/index.php?email='.$email.'&newpass='.$pass.'&code='.$verify_code.'"> Click here to verify password. </a></p></body></html>';

		$subject= $pass.' is your new password.';

		if(mail($email, $subject, $msg, $headers,"-f noreplay@reanweb.com")){
			$res['send']=true;
		}else{
			$res['send']=false;
		}

		$res['dpl']=true;

	}
	echo json_encode($res);

?>
