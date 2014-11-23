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
            <aside>
				<?php
				$select_query="SELECT * FROM `category`";
				$page = new pager($select_query,20);
				$result=mysql_query($page->sqlquery());
				echo $page->set_page_info();
				?>
            </aside>
		</header>
		<div class="content">
<?php
if(isset($_POST['delete']))
{
	mysql_query("delete from `category` where id='".$_POST['id']."'");
	mysql_query("delete from `article` where categoryId='".$_POST['id']."'");
	$com_del=mysql_fetch_array(mysql_query("select * from `article` where categoryId='".$_POST['id']."'"));
	mysql_query("delete from `comment` where articleId='".$com_del['id']."'");
	echo"<script>alert(\"删除成功\");window.setTimeout(\"window.location=\'categorys-table.php\'\",0);</script>";
}
if(isset($_POST['deleteall']))
{
	$ID_Dele= implode(",",$_POST['ID_Dele']);
	mysql_query("delete from `category` where id in ($ID_Dele)");
	mysql_query("delete from `article` where categoryId in ($ID_Dele)");
	$com_del=mysql_fetch_array(mysql_query("select * from `article` where categoryId in ($ID_Dele)"));
	mysql_query("delete from `comment` where articleId in (".$com_del['id'].")");
	echo"<script>alert(\"删除成功\");window.setTimeout(\"window.location=\'categorys-table.php\'\",0);</script>";
}
?>
            <form method="post" action="categorys-table.php" >
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>分类名称（点击修改）</th>
						<th>创建时间</th>
						<th>所含文章</th>
						<th>Comments（无用）</th>
						<th>Author（无用）</th>
						<th style="width:100px;">删除</th>
					</tr>
				</thead>
                <tbody>
                <?php
                    while($row=mysql_fetch_array($result))
                    {
                ?>
                    <tr>
                        <td>
                            <a href="categorys-update.php?id=<?php echo $row['id']?>">
                                <input type="checkbox" name="ID_Dele[]" value="<?php echo $row['id']?>" /><?php echo $row['categoryName']?>
                            </a>
                        </td>
                        <td><?php echo mb_substr($row['setTime'],0,10,'utf-8');?></td>
                        <td>
                            <?php
                                $select=mysql_query("select count(*) from `article` where `categoryId`='".$row['id']."'");
                                $art_sum=mysql_fetch_array($select);
                                echo $art_sum[0];
                            ?>
                        </td>
                        <td>0</td>
                        <td>John Doe</td>
                        <td>
                        	<input type="hidden" name="id" value="<?php echo $row['id']?>">
                            <button name="delete" style="height:30px;line-height:10px">删除</button>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            <p><br /></p>
            <button name="deleteall">批量删除</button>
            </form>
            <p><br /></p>
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
<script src="js/jquery.tablesorter.min.js"></script>
<?php }?>
</body>
</html>