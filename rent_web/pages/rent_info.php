<?php
	error_reporting(E_ALL & ~E_NOTICE);
	$house_rent_id=$_GET['house_rent_id'];
	//echo "house_rent_id:".$house_rent_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>出租详情</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link href="../css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/rent_info_main.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/jquery.more.js"></script>
		<script type="text/javascript">
		$(function(){
			var house_rent_id=$(" input[ name='house_rent_id' ] ").val();
			//alert(house_rent_id);
			$('#more').more({'address': '../php/rentWant.php?house_rent_id='+house_rent_id})
			//alert('111');
		});
		</script>
</head>
<body>
<header>
    <!--搜索链接跳转-->
    <div class="nav-btn nav-return">
        <a href="../index.html">
            <i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>
            <div class="return">返回</div>
        </a>
    </div>
</header>

<div class=" body">
  <!--租房信息-->
  <!--<a href="../pages/rent_info.html" class="content-box">-->
  <?php echo "<input type='hidden' value='$house_rent_id' name='house_rent_id'/>"; ?>
	<a class="content-box">
    <?php
    //$sql=mysql_query("SELECT username FROM zhubo WHERE ID='$search_word'");
		//$count=mysql_num_rows($sql);
		//if($count==0){
			//echo "<script>alert('没有该ID对应的主播');location.href='$href';</script>";
			//exit;
		//}else{
		//include_once("../php/connect.php");
		//echo "house_rent_id:".$house_rent_id;
		$mysqli = new mysqli('localhost', 'root', '123456', 'demo');
		//$rows = mysql_num_rows(mysql_query("SELECT * FROM house_rent where id='$house_rent_id'")); 
  	$sql = "SELECT * FROM house_rent where id='$house_rent_id'";
  	$rst = $mysqli->query($sql);
		while ($row = $rst->fetch_array(MYSQLI_ASSOC)){
			$cover_img=$row["cover_img"];
			$pic_number=$row["pic_number"];
			$pic_number=$pic_number."图";
			$title=$row["title"];
			$district=$row["district"];
			$room_type=$row["room_type"];
			$area=$row["area"];
			$rent_type=$row["rent_type"];
			$view=$row["view"];
			$want=$row["want"];
			$price=$row["price"];
			$content=$row["content"];
			$user_id=$row["user_id"];
			//房间图片 float
			echo "<div class='pic-wrapper float-left pic-footer'>";
			echo "<img class='room-pic' src='$cover_img' alt='' style='width:100%;height:100%;'>";
			//echo "<img class='room-pic' src='../images/1.jpg' alt=''>";
			echo "<span class='pic-number'>$pic_number</span>";
			echo "</div>";
			
			//房源标题 float
			echo "<div class='content-wrapper float-left'>";
			echo "<h4>$title</h4>";
			//房间属性简介 block 垂直排列
			echo "<div class='abstract'>";
			echo "<ul class='room-info'>";
			echo "<li id='district'>$district</li>";
			echo "<li id='house-type' class='text-center'>$room_type</li>";
			echo "<li id='rent-type' class='text-right'>$rent_type</li>";
			echo "</ul>";
			echo "</div>";
			echo "<div class='state'>";
			echo "<ul class='state-info'>";
			
			//房源状态描述
			echo "<li>";
			echo "<i class='fa fa-eye' aria-hidden='true'></i>";
			echo "<span id='watcher'>$view</span>";
			echo "</li>";
			echo "<li class='text-center'>";
			echo "<i class='fa fa-thumbs-o-up' aria-hidden='true'></i>";
			echo "<span id='want'>$want</span>";
			echo "</li>";
			echo "<li id='price' class='text-right'>$price</li>";
			echo "</ul>";
			echo "</div>";
			echo "</div>";
			echo "</a>";//<a class="content-box">
			//echo "<hr>";
			//$rows2 = mysql_num_rows(mysql_query("SELECT * FROM user where id='$user_id'")); 
	  	$sql2 = "SELECT * FROM user where id='$user_id'";
	  	$rst2 = $mysqli->query($sql2); 
			while ($row2 = $rst2->fetch_array(MYSQLI_ASSOC)){
				$headimg=$row2["headimg"];
				$wechat=$row2["wechat"];
				$status=$row2["status"];
				$sm_id=$row2["sm_id"];
				$university=$row2["university"];
				$industry=$row2["industry"];
				$star_sum=0;
				if($status != ""){
					$star_sum++;
				}
				if($sm_id != ""){
					$star_sum++;
				}
				if($university != ""){
					$star_sum++;
				}
				if($industry != ""){
					$star_sum++;
				}
				
				if($status==""){
					$status="未填写";
				}
				if($sm_id==""){
					$sm_id="未填写";
				}
				if($university==""){
					$university="未填写";
				}
				if($industry==""){
					$industry="未填写";
				}
			}
//    	echo "<div class='owner-info'>";
//			echo "<div class='pic-wrapper'>";
//			echo "<img src='$headimg' alt='房东'>";
//			//echo "<div class='verify'><i class='fa fa-user-o'></i>已实名</div>";
//			echo "<a href='#'>";
//			echo "<small>点击了解房东</small>";
//			echo "</a>";
//			echo "</div>";
//			echo "<div class='room-desc'>";
//			echo "<p>$content</p>";
//			echo "</div>";
//			echo "</div>";
//			echo "<hr>";
			//双tab
			echo "<div id='tab-bar' class='tab-bar'>";
			echo "<a href='#' data-content='tab-content-1' class='tab-btn active'>房源信息</a>";//此注释不可删除！！ 两个a标签不可调整，不可换行！
			echo "<a href='#' data-content='tab-content-2' class='tab-btn'>房东信息</a>";
			echo "</div>";
			echo "<a style='display: inline-block;' id='tab-content-1' class='content-box'>";
			//房源标题 float
			echo "<div class='room-desc float-left'>";
			echo "<p>$content</p>";
			echo "</div>";
			
			echo "</a>";
			echo "<div style='display: none;' id='tab-content-2' class='owner-info'>";
			echo "<div class='pic-wrapper'>";
			//echo "<img src='$headimg' alt='房东' style='width:70%;height:70%;'>";
			echo "<img src='../images/kp.jpg' alt='房东' style='width:70%;height:70%;'>";
			echo "<div class='verify'>";
			echo "<div class='star-box'>";
			echo "<div class='star_sum'>";
			if($star_sum==0){
				echo "<div class='star'><i class='fa fa-star-o'></i></div><div class='star'><i class='fa fa-star-o'></i></div><div class='star'><i class='fa fa-star-o'></i></div><div class='star'><i class='fa fa-star-o'></i></div>";
			}
			if($star_sum==1){
				echo "<div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star-o'></i></div><div class='star'><i class='fa fa-star-o'></i></div><div class='star'><i class='fa fa-star-o'></i></div>";
			}
			if($star_sum==2){
				echo "<div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star-o'></i></div><div class='star'><i class='fa fa-star-o'></i></div>";
			}
			if($star_sum==3){
				echo "<div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star-o'></i></div>";
			}
			if($star_sum==4){
				echo "<div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star'></i></div><div class='star'><i class='fa fa-star'></i></div>";
			}
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "<div class='info-box float-left'>";
			echo "<ul>";
			echo "<li>微信号：<span>$wechat</span></li>";
			if($sm_id=="未填写"){
				echo "<li>水木ID：<span>$sm_id</span></li>";
			}else{
				echo "<li>水木ID：<a href='http://m.newsmth.net/user/query/$sm_id' style='color:blue;text-decoration:underline;'><span>$sm_id</span></a></li>";
			}
			
			echo "<li>毕业学校：<span>$university</span></li>";
			echo "<li>所在行业：<span>$industry</span></li>";
			echo "<li>是否单身：<span>$status</span></li>";
			echo "</ul>";
			echo "</div>";
			echo "</div>"; 
		}
    ?>
		
    
    
    <?php
    $rs=$mysqli->query("SELECT * FROM `rent_want` WHERE house_rent_id = '$house_rent_id'");
		if ($rs){//$rs为true才去取
			$numrows=mysqli_num_rows($rs);
		}
		//mysqli_free_result($rs);
		//当前观看页面的user_id
		$wechat_openid='jikdfjkdfk';
    ?>
    <hr>
    <br>
    <div class="roomer-want"><!--自己不能想租自己的房子 自己也不能关注自己的求租-->
        <div>想租该房子的房客<? echo $numrows; ?></div>
        <a href="../php/AddRentWant.php?wechat_openid=<? echo $wechat_openid ?>&house_rent_id=<? echo $house_rent_id ?>&owner_id=<? echo $user_id ?>">我也想租！<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
    </div>
    
    <div id="more">
        <div class="single_item"><!--onclick="alert(this.innerHTML);"-->
	        <div class="roomer-info">
	            <div class="pic-wrapper ">
	                <img src="../pic_people/owner1.jpg" alt="XXX" style="width:70%;height:70%;">
	                <!--<div class="verify"><i class="fa fa-user-o"></i></div>-->
	                <div class="verify">
	                <div class="star-box">
											<span class="star_sum"></span>
		              </div>
		              </div>
	            </div>
	            
	            <div class="star-box smID">
		              <div>
		                  <small style="color:#999;">微信号：</small>
		                  <small class="smID"><span class="wechat"></span></small>
		              </div>
		              <div>
		                  <small style="color:#999;">手机号：</small>
		                  <small class="smID"><span class="mobile"></span></small>
		              </div>
		              <div>
		                  <small style="color:#999;">毕业学校：</small>
		                  <small class="smID"><span class="university"></span></small>
		              </div>
		              <div>
		                  <small style="color:#999;">所在行业：</small>
		                  <small class="smID"><span class="industry"></span></small>
		              </div>
		              <div>
		                  <small style="color:#999;">是否单身：</small>
		                  <small class="smID"><span class="status"></span></small>
		              </div>
		              
              </div>
	        </div>
	        <hr>
	      </div>
	      <a href="javascript:;" class="get_more" style="color:#007bc4/*#424242*/; text-decoration:none;outline: none;">::more::</a>
	  </div> 
  </div>


</div>
<script src="../js/showTab.js"></script>
</body>
</html>