<?php
    include_once("./dbcon.php");
    $sql = "SELECT Response FROM ChatBotAi WHERE Request=\"$_GET[q]\";";
    $result = mysqli_query($connect, $sql);

    mysqli_data_seek($result, 0);
    $row = mysqli_fetch_array($result);

    $response = $row[Response];
    $noresponse = "No Data Response";
    if( strlen($response)<1){
        echo $noresponse;
    }
    else{
        echo $response;
    }
?>