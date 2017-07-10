<?php require_once(dirname(__FILE__).'/include/config.inc.php');
$cid = empty($cid) ? 21 : intval($cid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo GetHeader(1,0,0,'人才招聘'); ?>
<link href="templates/default/style/webstyle.css" rel="stylesheet" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/joinUs.css" />
<script type="text/javascript" src="templates/default/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/default/js/top.js"></script>
</head>
<body>
<!-- header-->
<?php require_once('header.php'); ?>
<!-- /header-->
<!-- start 页面banner -->
     <div class="aorise-banner">
     	<?php
    	$row=$dosql->GetOne("SELECT * from `#@__infoclass` where id=21");
    	?>
    	<img src="<?php echo $row['picurl']; ?>" alt="<?php echo $row['title'] ?>" />
     </div>
     <!-- end 页面banner -->
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
	</div>
	<!-- end banner&面包屑导航 -->
		<div class="container">
			<div class="row j-top">
				<div class="col-lg-12 col-md-12 col-xs-12">
					<p>前言</p>
					<span>
						<?php
				    		$row=$dosql->GetOne("SELECT * from `#@__infoclass` where id=21");
				    		echo $row['description'];
				    	?>
				    </span>
				    <form name="search" id="search" method="get" action="join.php">
						<span>请输入职位：<input type="text" name="keyword" id="keyword" title="关键词..." value="" class="key" />
						<button type="submit" id="search_btn" class="sub"><span>搜索</span></button></span>
					</form>
				</div>
			</div>
				<?php
					$row=$dopage->GetPage("SELECT * FROM `#@__job` WHERE checkinfo=true ORDER BY orderid ASC",10);
					while($row = $dosql->GetArray())
					{
						if($cfg_isreurl!='Y') $gourl = 'joinshow.php?id='.$row['id'];
						else $gourl = 'joinshow-'.$row['id'].'.html';

				?>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12 post">
					<p><a href="<?php echo $gourl; ?>"><?php echo $row['title'] ?></a></p>
					<span>职位描述：</span>
					<span><?php echo $row['workdesc'] ?></span>
					<div class="times">
						<mark class="f-time">发布时间：</mark>
						<time><i><?php echo GetDateMk($row['posttime']); ?></i></time>
						有效时间：<mark class="v-time"><?php echo $row['usefullife'] ?></mark>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		<div class="page">
			<p><?php echo $dopage->GetList(); ?></p>
		</div>
	</div>

<!-- footer-->
<?php require_once('footer.php'); ?>
<!-- /footer-->
</body>
</html>