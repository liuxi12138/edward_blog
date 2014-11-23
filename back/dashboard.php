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
	<!--[if lt IE 9]><link rel="stylesheet" href="css/lt-ie-9.css" media="all" /><![endif]-->
</head>
<body>
<?php
include("../php/conn.php");
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
		<li class="section"><a href="dashboard.php"><span class="icon">&#128711;</span> 空白首页 </a></li><!-- class="section"-->
		<li>
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
<!--
	<section class="widget">
		<header>
			<span class="icon">&#128200;</span>
			<hgroup>
				<h1>Website Statistics</h1>
				<h2>An insiders view</h2>
			</hgroup>
		</header>
		<div class="content cycle">
			<div id="flot-example-2" class="graph-area"></div>
			<div id="flot-example-1" class="graph-area"></div>
		</div>
		</div>
	</section>
-->	
	<div class="widget-container">
		<section class="widget small">
			<header>
				<span class="icon">&#59168;</span>
				<hgroup>
					<h1>最新评论</h1>
					<h2>What they're saying</h2>
				</hgroup>
			</header>
			<div class="content no-padding timeline">
            <?php
			$lastsql=mysql_query("select * from (select * from `comment` order by `time` desc) as `table` limit 2");
			while($last=mysql_fetch_array($lastsql))
			{
            ?>
				<div class="tl-post comments">
					<span class="icon">&#59168;</span>
					<p>
						<a href="#">
						<?php
						$user=mysql_fetch_array(mysql_query("select * from `user` where `id`='$last[userId]'"));
						echo $user['nick'];
						?> says: </a><?php echo mb_substr($last['comment'],0,55,'utf-8')?>...
						<span class="reply"><input type="text" value="Respond to comment..."/></span>
					</p>
				</div>
            <?php }?>
				<span class="show-more"><a	 href="#">More</a></span>
			</div>
		</section>
		
		<section class="widget 	small">
			<header>
				<span class="icon">&#128319;</span>
				<hgroup>
					<h1>Quick Post</h1>
					<h2>Speed things up</h2>
				</hgroup>
			</header>
			<div class="content">
				<div class="field-wrap">
					<input type="text" value="Title"/>
				</div>
				<div class="field-wrap">
					<textarea id="quick_post" rows="5"></textarea>
				</div>
				<button type="submit" class="green">Post</button> <button type="submit" class="">Preview</button>
			</div>
		</section>
	</div>
	
	<div class="widget-container">
		<section class="widget small">
			<header> 
				<span class="icon">&#128318;</span>
				<hgroup>
					<h1>网站的数据</h1>
					<h2>Facts &amp; figures</h2>
				</hgroup>
			</header>
			<div class="content">
				<section class="stats-wrapper">
					<div class="stats">
						<p>
                            <span>
                <?php
				$sum_1=mysql_fetch_array(mysql_query("select count(*) from `article`"));
				echo $sum_1[0];
                ?>
                            </span>
                        </p>
						<p>文章</p>
					</div>
					<div class="stats">
						<p>
                            <span>
                <?php
				$sum_2=mysql_fetch_array(mysql_query("select count(*) from `comment`"));
				echo $sum_2[0];
                ?>
                            </span>
                        </p>
						<p>评论</p>
					</div>
				</section>
				<section class="stats-wrapper">
					<div class="stats">
						<p>
                            <span>
                <?php
				$sum_3=mysql_fetch_array(mysql_query("select count(*) from `user`"));
				echo $sum_3[0];
                ?>
                            </span>
                        </p>
						<p>用户</p>
					</div>
					<div class="stats">
						<p>
                            <span>
                <?php
				$sum_4=mysql_fetch_array(mysql_query("select count(*) from `category`"));
				echo $sum_4[0];
                ?>
                            </span>
                        </p>
						<p>分类</p>
					</div>
				</section>
			</div>
		</section>
		
		<section class="widget small">
			<header> 
				<span class="icon">&#128363;</span>
				<hgroup>
					<h1>Timeline</h1>
					<h2>Insiders news</h2>
				</hgroup>
			</header>
			<div class="content no-padding timeline">
				<div class="tl-post">
					<span class="icon">&#128206;</span>
					<p><a href="#">John Doe</a> attached an image to a blog post.</p>
				</div>
				<div class="tl-post">
					<span class="icon">&#59172;</span>
					<p><a href="#">John Doe</a> added his location.</p>
				</div>
				<div class="tl-post">
					<span class="icon">&#59170;</span>
					<p><a href="#">John Doe</a> edited his profile.</p>
				</div>
				<div class="tl-post">
					<span class="icon">&#9993;</span>
					<p><a href="#">John Doe</a> has sent you  private message.</p>
				</div>
				<div class="pie graph-area"></div>
			</div>
		</section>
		
	</div>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.wysiwyg.js"></script>
<script src="js/custom.js"></script>
<script src="js/cycle.js"></script>
<script src="js/jquery.checkbox.min.js"></script>
<!--<script src="js/flot.js"></script>
<script src="js/flot.resize.js"></script>
<script src="js/flot-time.js"></script>
<script src="js/flot-pie.js"></script>
<script src="js/flot-graphs.js"></script>-->
<script src="js/jquery.tablesorter.min.js"></script>
<script type="text/javascript">
// Feature slider for graphs
$('.cycle').cycle({
	fx: "scrollHorz",
	timeout: 0,
    slideResize: 0,
    prev:    '.left-btn', 
    next:    '.right-btn'
});
</script>
<?php }?>
</body>
</html>