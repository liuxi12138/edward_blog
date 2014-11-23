<html>
<?php
session_start();
include("conn.php");
if(isset($_POST['publish'])&&isset($_SESSION['name']))
{
	$date=date("Y-m-d H:i:s");
	mysql_query("insert into `comment`(`id`,`comment`,`userId`,`articleId`,`time`) values ('','$_POST[comment]','$_POST[uid]','$_POST[aid]','$date')");
	header("Location:../article.php?id=".$_POST['aid']);
}
else if(isset($_POST['update'])&&isset($_SESSION['name']))
{
	echo"<title>更新</title>";
	$date=date("Y-m-d H:i:s");
	mysql_query("update `comment` set `comment`='$_POST[comment]',`userId`='$_POST[uid]',`articleId`='$_POST[aid]',`time`='$date' where `id`='$_POST[id]'");
	echo "<script>alert('输入成功');window.location.href=\"../article.php?id=".$_POST['aid']."\";</script>";
}
else if(isset($_GET['update'])&&isset($_SESSION['name']))
{
?>
    <form action="comment.php" method="post">
    <div class="pinglunkuang">
    <?php 
    if(isset($_SESSION['name']))
    {
        $uid=mysql_fetch_array(mysql_query("select * from `user` where `name`='".$_SESSION['name']."'"));
    ?>
        <input type="hidden" name="uid" value="<?php echo $uid['id'];?>"/>
    <?php
    }
	$row=mysql_fetch_array(mysql_query("select * from `comment` where `id`='".$_GET['update']."'"))
	?>
        <input type="hidden" name="id" value="<?php echo $_GET['update'];?>"/>
        <input type="hidden" name="aid" value="<?php echo $row['articleId'];?>" />
        <textarea name="comment"><?php echo $row['comment']?></textarea>
        <input type="submit" name="update" value="发布" />
    </div>
    </form>
<?php
}
else if(isset($_GET['delete'])&&isset($_SESSION['name']))
{
	$id=mysql_fetch_array(mysql_query("select `articleId` from `comment` where `id`='".$_GET['delete']."'"));
	mysql_query("delete from `comment` where `id`='".$_GET['delete']."'");
	header("Location:../article.php?id=".$id['articleId']);
}else
echo "您未登录，请先点击<a href=\"../back/back.php\">登录</a>";
?>
<style>
	textarea{width:300px;height:70px;resize: none;}
</style>
</html>
