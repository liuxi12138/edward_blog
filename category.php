<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>iron_man</title>
<meta name="keywords" content="个人博客模板,博客模板,响应式" />
<meta name="description" content="如影随形主题的个人博客模板，神秘、俏皮。" />
<link href="css/base.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="js/modernizr.js"></script>
<![endif]-->
<?php
include("php/conn.php");
include("php/pager.class.php");
if(isset($_GET['id']))
{
	$select=mysql_fetch_array(mysql_query("select count(*) from article where categoryId =".$_GET['id'].""));
	if($select[0]==0)
		echo "<script>alert('该分类下没有文章');history.back(-1);</script>";
	else
	{
?>
</head>
<body>
<div class="ibody">
  <header>
    <h1>如影随形</h1>
    <h2>影子是一个会撒谎的精灵，它在虚空中流浪和等待被发现之间;在存在与不存在之间....</h2>
    <div class="logo"><a href="back/back.php"></a></div>
    <nav id="topnav"><a href="index.php">首页</a><a href="http://www.iliuye.com/Wap/Index/article/id/82202">关于我</a><a href="newlist.html">慢生活</a><a href="share.html">模板分享</a><a href="new.html">模板主题</a></nav>
  </header>
  <article>
    <div class="banner">
      <ul class="texts">
        <p>The best life is use of willing attitude, a happy-go-lucky life. </p>
        <p>最好的生活是用心甘情愿的态度，过随遇而安的生活。</p>
      </ul>
    </div>
    <div class="bloglist">
      <h2>
        <p><span>推荐</span>文章</p>
      </h2>
<?php
	$sql="select * from `article` where `categoryId`='".$_GET['id']."' order by `article`.`id` desc";
	//$sql="select * from `category`,`article` where `category`.`id`=`article`.`categoryId` order by `article`.`setTime` asc";
	$page = new pager($sql,5);
	$result=mysql_query($page->sqlquery());
	while($row = mysql_fetch_array($result,MYSQL_ASSOC))
	{
?>
    <div class="blogs">
        <h3>
            <a target="_blank" href="article.php?id=<?php echo $row['id']?>"><?php echo mb_substr($row['articleName'],0,24,'utf-8')?></a>
        </h3>
        <figure><img src="images/01.jpg" ></figure>
    <ul>
    	<div style="width:100%;height:67px;">
            <p>
                <?php $str= preg_replace("/<(.*?)>/","",$row['articleContent']); echo mb_substr($str,0,137,'utf-8')."..."; ?>
            </p>
        </div>
        <a href="article.php?id=<?php echo $row['id']?>" target="_blank" class="readmore">阅读全文&gt;&gt;</a>
    </ul>
    <p class="autor">
        <span>作者：
			<?php
                $row_1=mysql_fetch_array(mysql_query("select * from user where `id`='".$row['userId']."'"));
                echo $row_1['nick'];
            ?>
        </span>
			<?php $category=mysql_fetch_array(mysql_query("select * from category where id=".$row['categoryId'].""));?>
        <span>分类：【
            <a target="_blank" href="category.php?id=<?php echo $row['categoryId']?>"><?php echo $category['categoryName']?></a>
        】</span>
        <?php $sum=mysql_fetch_array(mysql_query("select count(*) from `comment` where `articleId`='".$row['id']."'"));?>
        <span>评论（<a target="_blank" href="#"><?php echo $sum[0];?></a>）</span>
    </p>
    <div class="dateview"><?php echo mb_substr($row['setTime'],0,10,'utf-8');?></div>
    </div>
<?php
	}
	echo $page->set_page_info();
?>
    </div>
  </article>
  <aside>
    <div class="avatar"><a href="about.html"><span>关于萧逸</span></a></div>
    <div class="topspaceinfo">
      <h1>执子之手，与子偕老</h1>
      <p>于千万人之中，我遇见了我所遇见的人....</p>
    </div>
    <div class="about_c">
      <p>网名：iron_man| 萧逸</p>
      <p>职业：Web前端设计师、网页设计 </p>
      <p>籍贯：山东省&mdash;济宁市</p>
      <p>电话：18753363901</p>
      <p>邮箱：lx_einstein@sina.com</p>
    </div>
    <div class="bdsharebuttonbox"><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_more" data-cmd="more"></a></div>
    <div class="tj_news">
      <h2>
        <p class="tj_t1">最新文章</p>
      </h2>
      <ul>
		<?php
			$s_query=mysql_query("select * from (select * from `article` order by `changeTime` asc)as `table` limit 8");
			while($new=mysql_fetch_array($s_query)){
        ?>
        <li><a href="article.php?id=<?php echo $new['id']?>"><?php echo mb_substr($new['articleName'],0,24,'utf-8');?></a></li>
        <?php }?>
      </ul>
      <h2>
        <p class="tj_t2">文章分类</p>
      </h2>
      <ul>
		<?php
			$s_query_2=mysql_query("select * from `category` order by `setTime` asc");
			while($new_2=mysql_fetch_array($s_query_2)){
        ?>
        <li><a href="category.php?id=<?php echo $new_2['id']?>"><?php echo mb_substr($new_2['categoryName'],0,24,'utf-8');?></a></li>
        <?php }?>
      </ul>
    </div>
    <div class="links">
      <h2>
        <p>友情链接</p>
      </h2>
      <ul>
        <li><a href="/">杨青个人博客</a></li>
        <li><a href="/">3DST技术社区</a></li>
      </ul>
    </div>
    <div class="copyright">
      <ul>
        <p> Design by <a href="/">DanceSmile</a></p>
        <p>蜀ICP备11002373号-1</p>
        </p>
      </ul>
    </div>
  </aside>
  <script src="js/silder.js"></script>
  <div class="clear"></div>
  <!-- 清除浮动 --> 
</div>
</body>
<?php
	}
}else
	header("Location:index.php");
?>
</html>
