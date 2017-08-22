<?php
    header("Content-Type:application/json;charset=utf-8;Access-Control-Allow-Origin:*");
    @$username =$_REQUEST["username"] or die('{"code":-2,"msg":"用户名不可少"}');
    @$userpwd=$_REQUEST['userpwd'] or die('{"code":"-3","msg":"userpwd 是必须的"}');
    $conn=mysqli_connect("127.0.0.1","uroot","","palmstore");
    mysqli_query($conn,"SET NAMES UTF8");
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    $count  = mysql_num_rows($result);
    if($result){
        echo '{"code":"-4","msg":"此用户名已被注册"}';
    }else{
        $sql = "INSERT INTO user VALUES(null,'$username','$userpwd')";
        $rst = mysqli_query($conn,$sql);
        if($rst){
            echo '{"code":"1","msg":"注册成功"}';
        }else{
            echo '{"code":"-1","msg":"服务器故障，请稍后再试"}';
        }
    }
?>