<?php
$Server_name = "localhost";
$Db_account = "ad32131";
$Password = "dpem@dnjem2";
$Db_select = "ad32131";
$connect=mysqli_connect( $Server_name, $Db_account, $Password,$Db_select) or die( "SQL server에 연결할 수 없습니다.");
?>