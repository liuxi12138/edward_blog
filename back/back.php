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
<?php
if(isset($_SESSION['admin']))
	header("Location:dashboard.php");
?>
<script>
function InputCheck(register)
{
	if (register.user.value == "")
	{
		alert("用户名不能为空！");
		register.user.focus();
		return(false);
	}
	if (register.pwd.value == "")
	{
		alert("请输入密码!")
		register.pwd.focus();
		return(false);
	}
}
</script>
	<!--[if IE]><link rel="stylesheet" href="css/ie.css" media="all" /><![endif]-->
</head>
<body class="login">
	<section>
		<h1><strong>Retina</strong> Dashboard</h1>
		<form method="post" action="php/land.php" name="register" onsubmit="return InputCheck(this)" >
			<input name="user" type="text" />
			<input name="pwd" type="password" />
			<button class="blue" name="submit">登陆</button>
		</form>
        <p><a href="#">注册</a></p>
	</section>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
// Page load delay by Curtis Henson - http://curtishenson.com/articles/quick-tip-delay-page-loading-with-jquery/
$(function(){
	$('.login button').click(function(e){ 
		// Get the url of the link 
		var toLoad = $(this).attr('href');  
 
		// Do some stuff 
		$(this).addClass("loading"); 
 
			// Stop doing stuff  
			// Wait 700ms before loading the url 
			setTimeout(function(){window.location = toLoad}, 10000);	  
 
		// Don't let the link do its natural thing 
		e.preventDefault
	});
	
	$('input').each(function() {

       var default_value = this.value;

       $(this).focus(function(){
               if(this.value == default_value) {
                       this.value = '';
               }
       });

       $(this).blur(function(){
               if(this.value == '') {
                       this.value = default_value;
               }
       });

});
});
</script>
</body>
</html>