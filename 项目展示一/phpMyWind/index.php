<?php require_once(dirname(__FILE__).'/include/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo GetHeader(); ?>
<link href="templates/default/style/webstyle.css" rel="stylesheet" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/index.css" />
<link rel="stylesheet" href="css/common.css" />
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="templates/default/js/jquery.min.js"></script>
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
<div id="myCarousel" class="carousel slide">
	<!-- 轮播（Carousel）指标 -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>   
	<!-- 轮播（Carousel）项目 -->
	<div class="carousel-inner">
		<div class="item active">
			<img src="images/banner1.jpg" alt="First slide">
		</div>
		<div class="item">
			<img src="images/banner2.jpg" alt="Second slide">
		</div>
		<div class="item">
			<img src="images/banner3.jpg" alt="Third slide">
		</div>
	</div>
	<!-- 轮播（Carousel）导航 -->
	<a class="carousel-control left" href="#myCarousel" 
	   data-slide="prev"><img src="images/left.png" alt="" /></a>
	<a class="carousel-control right" href="#myCarousel" 
	   data-slide="next"><img src="images/right.png" alt="" /></a>
</div> 
<!-- /banner-->

<div class="container">
	<!-- 解决方案 -->
	   <div class="row ">
	      <div class="col-md-4 aorise-title col-md-offset-4">
			<?php
				$row=$dosql->GetOne("SELECT * from `#@__infoclass` where id=4");
				echo $row['classname'];
			?>
	      </div>      
	   </div>
	   <div class="row solutions">
	   
	   	<?php
	   		
				$row = $dosql->Execute("SELECT * FROM `#@__infolist` WHERE classid=4  ORDER BY orderid ASC LIMIT 0,3");
				while($row = $dosql->GetArray())
				{
					//获取链接地址
					if($row['linkurl']=='' and $cfg_isreurl!='Y')
						$gourl = 'newsshow.php?cid='.$row['classid'].'&id='.$row['id'];
					else if($cfg_isreurl=='Y')
						$gourl = 'newsshow-'.$row['classid'].'-'.$row['id'].'-1.html';
					else
						$gourl = $row['linkurl'];

				?>
	   		<div class="col-md-4"><a href="<?php echo $gourl; ?>"><img src="<?php echo $row['picurl']; ?>" /><p><?php echo ReStrLen($row['title']); ?></p></a></div>
	   		<?php
				}
				?>
	   
	   </div>
	   <!-- 关于我们 -->
	    <div class="row ">
	      <div class="col-md-4 aorise-title col-md-offset-4">
			<?php
				$row=$dosql->GetOne("SELECT * from `#@__infoclass` where id=2 ");
				echo $row['classname'];
			?>
	      </div>      
	   </div>
	   <div class="row about">
	   		
	   	<?php
	   			$cid = empty($cid) ? 2 : intval($cid);
				$tid = empty($tid) ? 0 : intval($tid);
				
				$row=$dosql->Execute("SELECT * FROM `#@__infolist` where classid=2");
				while($row = $dosql->GetArray())
				{
					
				
				?>

	   		<div class="col-md-3"><a href="<?php echo $row['linkurl']; ?>"><img src="<?php echo $row['picurl'];?>"/><p><?php echo $row['title']; ?></p></a></div>
	   		<?php
				}
				?>
	   
	   </div>
		<!-- 新闻资讯 -->
	   <div class="row">
		    <div class="col-md-4 aorise-title col-md-offset-4">
			<?php
				$row=$dosql->GetOne("SELECT * from `#@__infoclass` where id=11");
				echo $row['classname'];
			?>
		    </div>      
		</div>
		<div class="row section">
			<div class="col-md-5">
				<div class="row">
				 <?php
				 	$row = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE classid=13 AND flag LIKE '%a%' ");
				 ?>
					<a href="<?php echo $row['linkurl'] ?>"><img src="<?php echo $row['picurl']; ?>" alt="$row['title']"/></a>
				</div>
				<div class="row">
					<p>
						<?php
							$row = $dosql->GetOne("SELECT * FROM `#@__infolist` WHERE classid=11 AND flag LIKE '%h%' ");
							echo ReStrLen($row['description'],100);
						 ?>
					</p>
				</div>

			</div>
			<div class="col-md-7">
			<ul>
				<?php
				$row = $dosql->Execute("SELECT * from `#@__infolist` where classid=11 and  flag !='h,c' limit 0,6");
				while($row = $dosql->GetArray())
				{
					//获取链接地址
					if($row['linkurl']=='' and $cfg_isreurl!='Y')
						$gourl = 'newsshow.php?cid='.$row['classid'].'&id='.$row['id'];
					else if($cfg_isreurl=='Y')
						$gourl = 'newsshow-'.$row['classid'].'-'.$row['id'].'-1.html';
					else
						$gourl = $row['linkurl'];
				?>
					<li><span></span><a href="<?php echo $gourl; ?>"><?php echo $row['title'] ?><time><?php echo GetDateMk($row['posttime'])?></time></a></li>
				<?php
					}
				?>
				</ul>
			</div>
		</div>
</div>


<?php require_once('footer.php'); ?>
</body>
</html>