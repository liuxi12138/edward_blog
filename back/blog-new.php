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
		<li>
			<a href="category-timeline.php"><span class="icon">&#128196;</span> 分类 </a>
			<ul class="submenu">
				<li><a href="category-new.php">创建分类</a></li>
				<li><a href="categorys-table.php">显示分类</a></li>
			</ul>	
		</li>
		<li class="section">
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
	<section class="widget" style="min-height:300px">
		<header>
			<span class="icon">&#59160;</span>
			<hgroup>
				<h1>文章</h1>
				<h2>书写你内心最真实的故事</h2>
			</hgroup>
		</header>
        <?php
		if(isset($_POST['content']))
		{
			$date=date("Y-m-d H:i:s");
			mysql_query("insert into article(id,articleName,categoryId,articleContent,userId,setTime,changerId,changeTime)value('','$_POST[title]','$_POST[category]','$_POST[content]','$_POST[uid]','$date','$_POST[uid]','$date')");
			echo"<script>alert(\"添加成功\");</script>";
		}
		$name=$_SESSION['name'];
		$s_query=mysql_query("select `id` from `user` where `name`='$name'");
		$array=mysql_fetch_array($s_query);
        ?>
        <form method="post" action="blog-new.php">
		<div class="content">
			<div class="field-wrap">
            	<input type="hidden" name="uid" value="<?php echo $array['id'];?>" />
				<input type="text" name="title" value="标题"/>
			</div>
			<div class="field-wrap">
				<style>
					select{margin:5px auto 20px auto;height:30px;width:130px;}
            	</style>
                <label>文章分类:</label>
                <select name="category">
                    <?php
                        $select_query=mysql_query("SELECT * FROM `category`");
                        while($row=mysql_fetch_array($select_query))
                            echo "<option value=\"".$row['id']."\">".$row['categoryName']."</option>";
                    ?>
                </select><br />
			</div>
			<div class="field-wrap wysiwyg-wrap">
				<textarea class="post" name="content" rows="5"></textarea>
			</div>
			<button type="submit" class="green">发表</button>
		</div>
        </form>
	</section>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.wysiwyg.js"></script>
<script src="js/custom.js"></script>
<script src="js/cycle.js"></script>
<script src="js/jquery.checkbox.min.js"></script>
<!--<script src="js/flot.js"></script>
<script src="js/flot.resize.js"></script>
<script src="js/flot-graphs.js"></script>
<script src="js/flot-time.js"></script>
<script src="js/cycle.js"></script>-->
<script src="js/jquery.tablesorter.min.js"></script>
<?php }?>
</body>
</html>