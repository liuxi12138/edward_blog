<?php
session_start();
include("../../php/conn.php");
if(isset($_POST['id']))
{
	$name=$_POST['name'];
	$nick=$_POST['nick'];
	$check_query=mysql_query("select * from (select * from `user` where id not in ($_POST[id]))as `table` where name='$name' limit 1");
	if(mysql_fetch_array($check_query))
	{
		echo '用户名 ',$name,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
	}
	else
	{
		if($_POST['pwd']==NULL)
		{
			mysql_query("update `user` set `name`='$name',`nick`='$nick' where id=$_POST[id]");
		}
		else
		{
			$pwd=MD5($_POST['pwd']);
			mysql_query("update `user` set `name`='$name',`nick`='$nick',`pwd`='$pwd' where id=$_POST[id]");
		}
			unset($_SESSION['admin']);
			unset($_SESSION['name']);
			unset($_SESSION['nick']);
			echo"更新成功，点击<a href='../back.php'>登录</a>";
	}
}
?>