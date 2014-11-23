<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>博客文章</title>
<meta name="keywords" content="个人博客模板,博客模板,响应式" />
<meta name="description" content="如影随形主题的个人博客模板，神秘、俏皮。" />
<link href="css/base.css" rel="stylesheet">
<link href="css/about.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">
<link href="css/media.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<!--[if lt IE 9]>
<script src="js/modernizr.js"></script>
<![endif]-->
</head>
<?php
ini_set("date.timezone","Asia/Chongqing");
include("php/conn.php");
if (isset($_GET['id']))
{
?>
<body>
<div class="ibody">
  <header>
    <h1>如影随形</h1>
    <h2>影子是一个会撒谎的精灵，它在虚空中流浪和等待被发现之间;在存在与不存在之间....</h2>
    <div class="logo"><a href="back/back.php"></a></div>
    <nav id="topnav"><a href="index.php">首页</a><a href="http://www.iliuye.com/Wap/Index/article/id/82202">关于我</a><a href="newlist.html">慢生活</a><a href="share.html">模板分享</a><a href="new.html">模板主题</a></nav>
  </header>
  <article>
    <?php
	$select=mysql_fetch_array(mysql_query("select * from `article` where `id`='".$_GET['id']."'"));
    ?>
    <h3 class="about_h">您现在的位置是：<a href="/">首页</a>><a href="1/"><?php echo $select['articleName']?></a></h3>
    <div class="about">
      <h2><?php echo $select['articleName']?></h2>
      
		<?php echo $select['articleContent']?>
      
    </div>
  <!--评论部分，后添加-->
  <div class="pinglun">
	<?php
    $sum_1=mysql_fetch_array(mysql_query("select count(*) from (select distinct `userId` from `comment` where `articleId`='".$_GET['id']."')as `table`"));
    $sum_2=mysql_fetch_array(mysql_query("select count(*) from `comment` where `articleId`='".$_GET['id']."'"));
    ?>
  	<div class="dajia">
    	<p>大家都在说（<?=$sum_1[0];?>人参与，<?=$sum_2[0];?>条评论)</p><hr>
    </div>
<?php
if(isset($_SESSION['nick']))
{
	$uid=mysql_fetch_array(mysql_query("select * from `user` where `name`='".$_SESSION['name']."'"));
?>
    <div class="comment">
    	<div class="comment_image">
        	<img src="images/50.jpg" />
            <div class="nick"><p><?php echo $_SESSION['nick'];?></p></div>
        </div>
        <div class="comment_liuyan">
        <form action="php/comment.php" method="post" neme="liuyan" onsubmit="return InputCheck(this)">
            <input type="hidden" name="uid" value="<?php echo $uid['id'];?>"/>
            <input type="hidden" name="aid" value="<?php echo $_GET['id'];?>" />
            <textarea name="comment"></textarea>
            <input type="submit" name="publish" value="发布" style="border-radius:5px;width:40px;height:25px;background:#0CF" />
        </form>
        </div>
    </div><hr />
    <style>
	textarea{width:90%;height:70px;resize: none;}
    </style>
	<script>
    function InputCheck(liuyan)
	{
        if (liuyan.comment.value=="")
		{
            alert ("评论不能为空");
            liuyan.comment.focus();
            return(false)
        }
    }
    </script>
<?php }?>




<?php
	$comment=mysql_query("select * from `comment` where `articleId`='".$_GET['id']."'");
	while($_comment=mysql_fetch_array($comment))
	{
		$user=mysql_fetch_array(mysql_query("select * from `user` where `id`='".$_comment['userId']."'"));
?>
    <div class="comment">
    	<div class="comment_image">
        	<img src="images/50.jpg" />
            <div class="nick"><p><?php echo $user['nick'];?></p></div>
        </div>
        <div class="comment_fayan">
        	<div class="comment_fayan_text"><?php echo $_comment['comment']?></div>
        	<div class="comment_fayan_time">
				<?php if(isset($_SESSION['name'])&&$_SESSION['name']==$user['name']){?>
                    <a href="php/comment.php?update=<?php echo $_comment['id']?>">修改</a>
                    <a href="php/comment.php?delete=<?php echo $_comment['id']?>">删除</a>
                <?php }?>
				<?php echo $_comment['time']?>
            </div>
        </div>
    </div>
<?php }?>
  </div>
  <style>
  .pinglun{width:100%;height:auto;line-height:27px;float:left;}
	  .dajia{width:100%;height:auto;}
	  .dajia p{font-size:18px;font-family:cursive;margin:20px 20px 0px 2.739726%;color:#f16b17;}
	  hr{width:90%;margin-left:20px;}
	  .comment{width:100%;height:auto;overflow:hidden;}
	  	.comment_image{width:50px;height:77px;margin:20px auto 0px 20px;float:left;}
		.comment_image .nick{height:27px;width:50px;line-height:27px;text-align:center;}
		.comment_liuyan{width:90%;height:auto;min-height:82px;float:left;margin:20px 6.986301% 20px 3.424685%;}
		.comment_fayan{width:90%;height:auto;min-height:82px;background:#FfFFEC;float:left;margin:20px 6.986301% 20px 3.424685%;}
			.comment_fayan_text{width:100%;height:auto;min-height:55px;text-indent:2em;}
			.comment_fayan_time{width:100%;height:27px;line-height:27px;text-align:right;margin:0px;background:#FfFFEC;}
  </style>
  <!-------------------->
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
}else
	header("Location:index.php");
?>
</html>
