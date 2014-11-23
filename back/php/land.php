<?php session_start();?>
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
        a:link {color: #FF0000}		/* 未访问的链接 */
        a:visited {color: #00FF00}	/* 已访问的链接 */
        a:hover {color: #FF00FF}	/* 鼠标移动到链接上 */
        a:active {color: #0000FF}
        </style>
    </head>
    <body>
        <?php
        error_reporting(0);
        include("../../php/conn.php");
        if($_GET['action'] == "logout")
        {
            unset($_SESSION['admin']);
            unset($_SESSION['name']);
            unset($_SESSION['nick']);
            echo "注销登录成功！点击此处 <a href=\"../../index.php\">返回首页</a>";
            exit;
        }
        else if(!isset($POST['submit']))
        {
            $user=$_POST['user'];
            $pwd=MD5($_POST['pwd']);
            $check_query=mysql_query("select * from `user` where name='$user' and pwd='$pwd' limit 1");
            if($row=mysql_fetch_array($check_query))
            {
                $_SESSION['admin']="ture";
                $_SESSION['name']=$row['name'];
                $_SESSION['nick']=$row['nick'];
                echo"登陆成功，正在跳转，请稍后！";
                echo"<script> window.setTimeout(\"window.location=\'../dashboard.php\'\",2000);</script>";
                //header("Location:index.php");
            }else
            {
                echo'用户名或密码错误，请点击<a href="../back.php">返回</a>，重新输入';
            }
        }
        else
            exit("非法访问！");
        
        ?>
    </body>
</html>