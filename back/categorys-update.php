<?php session_start();?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<title>Retina Dashboard</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" />
	<!--[if IE]><link rel="stylesheet" href="css/ie.css" media="all" /><![endif]-->
</head>
<body>
<?php
include("../php/conn.php");
include("../php/pager.class.php");
if(!isset($_SESSION['admin']))
	header("Location:back.php");
else
{
?>
<div class="testing">
<header class="main">
	<h1><strong>iron_man</strong></h1>
	<input type="text" value="search" />
</header>
<section class="user">
	<div class="profile-img">
		<p><img src="images/uiface2.png" alt="" height="40" width="40" /> Welcome back <?php echo $_SESSION['nick']?></p>
	</div>
	<div class="buttons">
		<button class="ico-font">&#9206;</button>
		<span class="button"><a href="../index.php">返回首页</a></span>
		<span class="button blue"><a href="php/land.php?action=logout">注销</a></span>
	</div>
</section>
</div>
<nav>
	<ul>
		<li><a href="dashboard.php"><span class="icon">&#128711;</span> 空白首页 </a></li><!-- class="section"-->
		<li class="section">
			<a href="category-timeline.php"><span class="icon">&#128196;</span> 分类 </a>
			<ul class="submenu">
				<li><a href="category-new.php">创建分类</a></li>
				<li><a href="categorys-table.php">显示分类</a></li>
			</ul>	
		</li>
		<li>
			<a href="blog-timeline.php"><span class="icon">&#59160;</span> 文章 </a>
			<ul class="submenu">
				<li><a href="blog-new.php">新建文章</a></li>
				<li><a href="blog-table.php">所有文章</a></li>
				<li><a href="comments-timeline.php">展示评论</a></li>
			</ul>
		</li>
		<li>
            <a href="users.php"><span class="icon">&#128101;</span> 用户 </a>
			<ul class="submenu">
				<li><a href="personal_center.php">个人中心</a></li>
			</ul>
        </li>
	</ul>
</nav>
<section class="content">
	<section class="widget" style="height: 400px; min-height:300px">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>分类</h1>
				<h2>创建分类，书写你心灵的独白</h2>
			</hgroup>
		</header>
<?php
if(isset($_POST['id']))
{
	$check_query=mysql_query("select * from (select * from `category` where id not in ($_POST[id]))as `table` where categoryName='$_POST[category]' limit 1");
	if(mysql_fetch_array($check_query))
	{
		echo "<p style=\"font-size:2em;margin-top:20px;\">分类 \"",$_POST['category'],"\" 已存在。<a href=\"javascript:history.back(-1);\">返回</a></p>";
	}
	else
	{
		$sql="update `category` set `categoryName`='".$_POST['category']."',`categoryMeans`='".$_POST['categoryMeans']."' where `id`='".$_POST['id']."'";
		mysql_query($sql);
		echo"<script>alert(\"修改成功\");window.setTimeout(\"window.location=\'categorys-table.php\'\",0);</script>";
	}
}
if(isset($_GET['id']))
{
	$select_query=mysql_query("select * from category where id='$_GET[id]'");
	$row=mysql_fetch_array($select_query);
?>
		<div class="content">
        <form action="categorys-update.php" method="post">
			<div class="field-wrap">
                <input type="hidden" name="id" value="<?php echo $row['id']?>" />
				<input type="text" name="category" value="<?php echo $row['categoryName']?>"/>
			</div>
			<div class="field-wrap wysiwyg-wrap">
				<textarea class="post" rows="5" name="categoryMeans"><?php echo $row['categoryMeans']?></textarea>
			</div>
			<button type="submit" class="green">Post</button>
        </form>
		</div>
<?php }?>
	</section>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.wysiwyg.js"></script>
<script src="js/custom.js"></script>
<script src="js/cycle.js"></script>
<script src="js/jquery.checkbox.min.js"></script>
<script src="js/flot.js"></script>
<script src="js/flot.resize.js"></script>
<script src="js/flot-graphs.js"></script>
<script src="js/flot-time.js"></script>
<script src="js/jquery.tablesorter.min.js"></script>
<?php }?>
</body>
</html>