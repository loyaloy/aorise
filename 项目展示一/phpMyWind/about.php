<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

//初始化参数检测正确性
$cid = empty($cid) ? 2 : intval($cid);
$tid = empty($tid) ? 0 : intval($tid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo GetHeader(1,$cid); ?>
<link href="templates/default/style/webstyle.css" rel="stylesheet" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/aboutUs.css" />
<link rel="stylesheet" href="css/common.css" />
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="templates/default/js/slideplay.js"></script>
<script src="templates/default/js/srcollimg.js"></script>
<script src="templates/default/js/loadimage.js"></script>
<script src="templates/default/js/top.js"></script>
</head>
<body>
<!-- header-->
<?php require_once('header.php'); ?>
<!-- /header-->
<!-- banner-->
<div class="aorise-banner">
    <?php
    	$row=$dosql->GetOne("SELECT * from `#@__infoclass` where id=2");
    ?>
    <img src="<?php echo $row['picurl']; ?>" alt="<?php echo $row['title'] ?>" />
</div>
<!-- /banner-->
		<div class="container">
    <!-- start 面包屑导航 -->
				<div class="row position">
					<div class="col-lg-6 col-md-6 col-xs-6">
						<p><?php echo GetCatName($cid); ?></p>
					</div>
					<div class="col-lg-6 col-md-6 col-xs-6">
						<ol class="breadcrumb now">
							您当前所在位置：
						    <li><?php echo GetPosStr($tid); ?></li>
						</ol>
					</div>
				</div>
		</div>
			<!-- end banner&面包屑导航 -->

		<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 title">关于我们</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-xs-3 g-left">
					<div class="a-top">
						<p>关于我们/About Us</p>
					</div>
					<div class="a-bottom">
					<ul>
						<?php
						$dosql->Execute("SELECT * FROM `#@__info`,`#@__infoclass` WHERE `#@__info`.classid=`#@__infoclass`.orderid and `#@__infoclass`.parentid=2 ");
						while($row = $dosql->GetArray())
						{
							if($cfg_isreurl=='Y')
								$gourl = 'about-'.$cid.'-'.$row['id'].'-1.html';
							else
								$gourl = 'about.php?cid='.$cid.'&tid='.$row['id'];
							echo '<li><a href="'.$gourl.'">'.$row['classname'].'</a></li>';

						}
						?>

					</ul>
					</div>
				</div>
			<div class="col-lg-9 col-md-9 col-xs-9 g-right">
				<?php
					if(empty($tid)) {
						$row=$dosql->GetOne("SELECT * FROM `#@__info` WHERE classid=14");
					}else{
						$row=$dosql->GetOne("SELECT * FROM `#@__info` WHERE classid=$tid");
					}
				?>
				<?php echo $row['content'] ?>
			</div>
		</div>
	</div>



<!-- footer-->
<?php require_once('footer.php'); ?>
<!-- /footer-->
</body>
</html>