<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

//初始化参数检测正确性
$cid = empty($cid) ? 11 : intval($cid);
$id  = empty($id)  ? 0 : intval($id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo GetHeader(1,$cid,$id); ?>
<link href="templates/default/style/webstyle.css" rel="stylesheet" />
<link href="templates/default/style/lightbox.css" rel="stylesheet" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/solution-details.css" />
<!--[if IE 6]><link href="templates/default/style/lightbox.ie6.css" rel="stylesheet" type="text/css"/><![endif]-->
<script src="templates/default/js/jquery.min.js"></script>
<script src="templates/default/js/loadimage.js"></script>
<script src="templates/default/js/slidespro.js"></script>
<script src="templates/default/js/lightbox.js"></script>
<script src="templates/default/js/comment.js"></script>
<script src="templates/default/js/top.js"></script>
<script type="text/javascript">
$(function(){
	jQuery('.lightbox').lightbox();
    $(".showimg img").LoadImage({width:750,height:600});
	$(".picarr .picture img").LoadImage({width:530,height:350});
	$(".picarr .preview img").LoadImage({width:58,height:45});
	$(".small").click(function(){$("#textarea").css('font-size','12px');});
	$(".big").click(function(){$("#textarea").css('font-size','14px');});
});
</script>
</head>
<body>
<!-- start 页面banner -->
     <div class="aorise-banner">
     	<img src="images/detailsNav.jpg" alt="" />
     </div>
<!-- end 页面banner -->
	<div class="container">
    <!-- start 面包屑导航 -->
			<div class="row position">
				<div class="col-lg-6 col-md-6 col-xs-6">
					<p><?php echo GetCatName($cid); ?><a href="javascript:history.go(-1);" class="goback">&gt;&gt; 返回</a></p>
				</div>
				<div class="col-lg-6 col-md-6 col-xs-6">
						<ol class="breadcrumb now">
							您当前所在位置：
						    <li><?php echo GetPosStr($cid,$id); ?></li>
						</ol>
				</div>
			</div>
	</div>
	<!-- end banner&面包屑导航 -->

	<div class="container">
			<?php

			//检测文档正确性
			$r = $dosql->GetOne("SELECT * FROM `#@__infolist` WHERE id=$id");
			if(@$r)
			{
			//增加一次点击量
			$dosql->ExecNoneQuery("UPDATE `#@__infolist` SET hits=hits+1 WHERE id=$id");
			$row = $dosql->GetOne("SELECT * FROM `#@__infolist` WHERE id=$id");
			?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 headline"><p><?php echo $row['title']; ?></p></div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 s-time">
			更新时间：<time><?php echo GetDateTime($row['posttime']); ?></time>点击次数：<span></small><?php echo $row['hits']; ?>次</span>
			</div>
		</div>
		<?php
			}
			?>
		<!-- 标题区域结束 -->

			<!-- 摘要区域开始 -->
			<div class="row ">
			<?php
			//获取描述
			if(!empty($row['description'])) echo '<div class="desc foreword">'.$row['description'].'</div>';
			?>	
			</div>
			<!-- 摘要区域结束 -->
		
		
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 body">
				<?php
				if($row['content'] != '')
					echo GetContPage($row['content']);
				else
					echo '网站资料更新中...';
				?>
				<p class="author">(编辑：<?php echo $row['author'] ?>)</p>
			</div>
		</div>
		<div class="row">
			<!-- 相关文章开始 -->
			<div class="preNext">
				<div class="line"><strong></strong></div>
				<ul class="text">
				<?php
	
				//获取上一篇信息
				$r = $dosql->GetOne("SELECT * FROM `#@__infolist` WHERE classid=".$row['classid']." AND orderid<".$row['orderid']." AND delstate='' AND checkinfo=true ORDER BY orderid DESC");
				if($r < 1)
				{
					echo '<li>上一篇：已经没有了</li>';
				}
				else
				{
					if($cfg_isreurl != 'Y')
						$gourl = 'newsshow.php?cid='.$r['classid'].'&id='.$r['id'];
					else
						$gourl = 'newsshow-'.$r['classid'].'-'.$r['id'].'-1.html';

					echo '<li>上一篇：<a href="'.$gourl.'">'.$r['title'].'</a></li>';
				}
				
				//获取下一篇信息
				$r = $dosql->GetOne("SELECT * FROM `#@__infolist` WHERE classid=".$row['classid']." AND orderid>".$row['orderid']." AND delstate='' AND checkinfo=true ORDER BY orderid ASC");
				if($r < 1)
				{
					echo '<li>下一篇：已经没有了</li>';
				}
				else
				{
					if($cfg_isreurl != 'Y')
						$gourl = 'newsshow.php?cid='.$r['classid'].'&id='.$r['id'];
					else
						$gourl = 'newsshow-'.$r['classid'].'-'.$r['id'].'-1.html';

					echo '<li>下一篇：<a href="'.$gourl.'">'.$r['title'].'</a></li>';
				}
				?>
				</ul>
				<ul class="actBox">
					<li id="act-pus"><a href="javascript:;" onclick="<?php $c_uname = isset($_COOKIE['username']) ? AuthCode($_COOKIE['username']) : '';if($c_uname != ''){echo 'AddUserFavorite()';}else{echo 'AddFavorite();';} ?>">收藏</a></li>
					<li id="act-pnt"><a href="javascript:;" onclick="window.print();">打印</a></li>
				</ul>
                <input type="hidden" name="aid" id="aid" value="<?php echo $id; ?>" />
				<input type="hidden" name="molds" id="molds" value="2" />
			</div>
			<!-- 相关文章结束 -->
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 evaluate">
			<p><i>
					<?php
					$r = $dosql->GetOne("SELECT COUNT(id) as n FROM `#@__usercomment` WHERE molds=2 AND aid=$id AND isshow=1 ORDER BY id DESC");
					echo $r['n'];
					?>
					</i>条评论</p>
			<div class="e-evaluate">
				<textarea name="speak" id="speak">说点什么吧...</textarea>
				<span>不想登录？直接点击发布即可作为游客登录。</span>
				<input type="submit" class="fb" name="fb" value="发布" />
			</div>
			</div>
		</div>
	</div>


<!-- footer-->
<?php require_once('footer.php'); ?>
<!-- /footer-->
</body>
</html>