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
<script>
function InputCheck(register)
{
	if (change.name.value == "")
	{
		alert("用户名不能为空！");
		register.user.focus();
		return(false);
	}
	if (change.pwd.value != change.repwd.value)
	{
		alert("两次密码输入不一致！");
		register.pwd.focus();
		return(false);
	}
	if (change.pwd.value != "" && change.pwd.value.length < 6)
	{
		alert("密码不得少于6个字符!")
		register.pwd.focus();
		return(false);
	}
}
</script>
</head>
<body>
<?php
include("../php/conn.php");
include("php/pager.class.php");
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
		<li>
			<a href="blog-timeline.php"><span class="icon">&#59160;</span> 文章 </a>
			<ul class="submenu">
				<li><a href="blog-new.php">新建文章</a></li>
				<li><a href="blog-table.php">所有文章</a></li>
				<li><a href="comments-timeline.php">展示评论</a></li>
			</ul>
		</li>
		<li class="section">
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
			<span class="icon">&#128100;</span>
			<hgroup>
				<h1>个人中心</h1>
				<h2>管理你的身份信息</h2>
			</hgroup>
		</header>
        <div style="width:auto;height:auto;margin:30px auto 20px 0px;">
			<style>
                label{margin-buttom:18px;font-size:1.5em;}
                .p_center{min-width:450px;width:600px;height:80px;}
                .personal{margin:20px auto auto 100px;float:left;line-height:52px;min-width:90px;width:auto;height:auto;}
					.personal input{width:300px;}
            </style>
        <?php
		$select_query=mysql_query("select * from `user` where name='".$_SESSION['name']."'");
		$row=mysql_fetch_array($select_query);
        ?>
            <form action="php/user_change.php" name="change" method="post" onsubmit="return InputCheck(this)">
            	<input type="hidden" name="id" value="<?php echo $row['id']?>">
            <div class="p_center">
                <div class="personal">
                    <label>用户名：</label>
                </div>
                <div class="personal">
                    <input type="text" name="name" value="<?php echo $row['name']?>"/>
                </div>
            </div>
            <div class="p_center">
                <div class="personal">
                    <label>昵&nbsp;&nbsp;称：</label>
                </div>
                <div class="personal">
                    <input type="text" name="nick" value="<?php echo $row['nick']?>"/>
                </div>
            </div>
            <div class="p_center">
                <div class="personal">
                    <label>新密码：</label>
                </div>
                <div class="personal">
                    <input type="password" name="pwd" />
                </div>
            </div>
            <div class="p_center">
                <div class="personal">
                    <label>再次确认：</label>
                </div>
                <div class="personal">
                    <input type="password" name="repwd" />
                </div>
            </div>
            <div class="p_center">
                <div class="personal">
                    <button>保存</button>
                </div>
            </div>
            </form>
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