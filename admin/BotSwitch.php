<?php


include_once("../dbcon.php");

if(empty(!$_GET[mode])){
    if( $_GET[mode] == "ON"){
        $sql = "UPDATE BotModSetting SET ModSwitch='ON';";
    }
    else{
        $sql = "UPDATE BotModSetting SET ModSwitch='OFF';";
    }
    
    $result = mysqli_query($connect, $sql);
}

?>