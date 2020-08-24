<?php
	$cn = new MySQLi("localhost","root","","nanosound");

	for($i=1;$i<5000;$i++){
		$sql="INSERT INTO tbl_menu VALUES(null,'Yaya".$i."','imag.jpg".$i."',$i,1)";
		$cn->query($sql);
	}
?>