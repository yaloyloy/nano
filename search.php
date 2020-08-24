<?php
  $conn =new Mysqli("localhost","root","","nano_web");
  
  // $conn = mysql_connect("localhost","root","");
  // mysql_select_db('nano_web',$conn);
  $s=$_GET['usearch'];

  $sql ="SELECT * FROM tbl_product WHERE name LIKE '%$s%'";
  $rs=mysql_query($sql);
  while ($row = mysql_fetch_array($rs)) {
    echo $row['name']."<br>";
  }


?>
