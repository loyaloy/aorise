<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

//初始化参数检测正确性
$cid = empty($cid) ? 5 : intval($cid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo GetHeader(1,$cid); ?>
<link href="templates/default/style/webstyle.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/case.css" />
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="templates/default/js/jquery.min.js"></script>
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
    	$row=$dosql->GetOne("SELECT * from `#@__infoclass` where id=5");
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
						    <li><?php echo GetPosStr($cid); ?></li>
						</ol>
					</div>
				</div>
			<!-- end banner&面包屑导航 -->
			<div class="content">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-xs-12 title">
						案例展示
					</div>
				</div>
					<div class="row">
					<?php
						$dopage->GetPage("SELECT * FROM `#@__infoimg` WHERE (classid=$cid OR parentstr LIKE '%,$cid,%') AND delstate='' AND checkinfo=true ORDER BY orderid ASC",8);
						while($row = $dosql->GetArray())
						{
							if($row['linkurl']=='' and $cfg_isreurl!='Y') $gourl = 'caseshow.php?cid='.$row['classid'].'&id='.$row['id'];
							else if($cfg_isreurl=='Y') $gourl = 'newsshow-'.$row['classid'].'-'.$row['id'].'-1.html';
							else $gourl = $row['linkurl'];

							$row2 = $dosql->GetOne("SELECT `classname` FROM `#@__infoclass` WHERE `id`=".$row['classid']);
							if($cfg_isreurl!='Y') $gourl2 = 'case.php?cid='.$row['classid'];
							else $gourl2 = 'news-'.$row['classid'].'-1.html';
						?>
						<div class="col-lg-4 col-md-4 col-xs-4 case">
							<a href="<?php echo $gourl ?>"><img src="<?php echo $row['picurl'] ?>" alt="<?php echo $row['title'] ?>" /><p><?php echo $row['title'] ?></p></a>
						</div>
						<?php
						}
					?>
					</div>
		</div>
	</div>
<!-- footer-->
<?php require_once('footer.php'); ?>
<!-- /footer-->
</body>
</html>