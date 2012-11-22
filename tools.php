<?php
define('XOTAODIR','./');
ini_set('display_errors','On');
error_reporting('E_ALL');
function daddslashes($string,$force=1){if(is_array($string)){foreach($string as $key => $val) {unset($string[$key]);$string[addslashes($key)]=daddslashes($val, $force);}}else{$string=addslashes($string);}return $string;}	
foreach(array('_COOKIE', '_POST', '_GET') as $_request){foreach($$_request as $_key=>$_value){$_key{0}!= '_'&&$$_key=daddslashes($_value);}}
include XOTAODIR.'xoTao.php';
?>
<html><head><style>
*{margin:0;padding:0;}
.wrap{width:100%;}
#header{height:30px;background:#E5E5E5;line-height:30px;}
#lnav{width:20%;float:left;}
.content{width:80%;float:left;}
.backcode{width:100%;height:300px;border:1px solid #000;}
</style></head>
<body><div class="wrap" id="header"><a href="http://xotao.yingou.net">项目首页</a></div>
<div class="wrap"><nav id="lnav">
<a href="tools.php">首页</a>
<a href="tools.php?page=proxy">代理测试</a>
<a href="tools.php?page=api">api测试</a>
</nav>
<div class="content">
<?php
switch (@$_GET['page']){
	case 'api':
$apidir=dir(XOTAODIR."XXOO");
while (($f=$apidir->read()) !== false){
if(!in_array($f,array('..','.','ganon.php','simple_html_dom.php')))$apis[]=substr($f,0,strrpos($f, '.'));
}
$apidir->close();
	?>
		<form method="post">
			<select name="apiname">
				<?php foreach($apis as $a){?><option value="<?php echo $a; ?>" <?php if($a==$apiname){ echo 'selected="selected"';}?>><?php echo $a; ?></option><?php } ?></select>
	<textarea name="evalcode"><? echo (($evalcode)?$evalcode:'');?></textarea>
	<input type="submit" value="测试">
	</form>
	<div class="ts">$xo->函数名(参数);</div>
	<?php
	if($apiname>''){
		include XOTAODIR."XXOO/".$apiname.'.php';
		$xo=new $apiname;
		eval($evalcode);
		$xo->exec();
		echo "<textarea class=\"backcode\">";
		var_dump($xo);
		echo "</textarea>";
		}
	
	break;
	case 'proxy':
	
	?>
	<form method="post">
	<input name="proxyurl">
	<input type="submit" value="测试">
	</form>
	<?php
	break;
	default:
	?>
	测试工具
	<?php
	break;
	}
	
?>
</div>
</div>
</body>
</html>
