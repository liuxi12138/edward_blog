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
ini_set("date.timezone","Asia/Chongqing");
include("../php/conn.php");
include("../php/pager.class.php");
if(!isset($_SESSION['admin']))
	header("Location:back.php");
else
{
?>
<?php
function sjc($startdate,$enddate)
{
/*$a=strtotime($enddate);
$b=strtotime($startdate);
$c=$a-$b;
$d=ceil($c/3600/24);
$h=ceil($c%(3600/24)/3600);
$m=ceil($c%(3600/24)/60);
echo " $d days $h hours $m minute ago";*/
$date=floor((strtotime($enddate)-strtotime($startdate))/86400);
$hour=floor((strtotime($enddate)-strtotime($startdate))%86400/3600);
$minute=floor((strtotime($enddate)-strtotime($startdate))%86400%60);
$second=floor((strtotime($enddate)-strtotime($startdate))%86400/60%60);
if($date!=0) echo $date."days ";
if($hour!=0) echo $hour."hours ";
if($minute!=0) echo $minute."minutes ";
if($second!=0) echo $second."seconds ";
echo"ago";
}
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
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>分类</h1>
				<h2>将心情归归类</h2>
			</hgroup>
		</header>
		<div class="content no-padding timeline">
			<?php
                $select_query=mysql_query("SELECT * FROM `category`");
				$datetime=date("Y-m-d H:i:s");
                while($row=mysql_fetch_array($select_query))
                {
            ?>
			<div class="tl-post">
				<span class="icon">&#59185;</span>
				<p><a href="#"><?php echo $row['categoryName']?></a><span class="time">Created <?php echo sjc($row['setTime'],$datetime)?></span></p>
			</div>
            <?php }?>
		</div>
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
<script src="js/cycle.js"></script>
<script src="js/jquery.tablesorter.min.js"></script>
<?php }?>
</body>
</html>