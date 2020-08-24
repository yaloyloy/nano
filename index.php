<?php
	include('_config_inc.php');
	include('admin/action/action.php');
	$db=new Action;
	$con="status=1";
	
	// // Login
	// session_start();
	

	// if(!isset($_SESSION['email'])){
	// 	// header('Location: index.php');
	// }

	// $email = $_SESSION['email'];
	// $utype = $_SESSION['user_type'];
	// echo $utype;

	//style
	$home_color="#eee";
	$menu_color="#000";
	$menuid=0;
	//$con="status=1 && location=1";
	//end style
	if(isset($_GET['menuid'])){
		$menuid=$_GET['menuid'];
		$con="status=1 && cat_id=".$menuid."";
		$home_color="#000";
	}
	$num_pro=$db->count_data("tbl_product",$con);


?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Nano Sound Cambodia</title>
<meta name="keywords" content="jbl,speaker,nanosound,karaoke">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="stylesheet" href="style/bootstrap-4.0.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="style/swiper.min.css">
<link rel="stylesheet" href="style/fontawesome-free-5.8.1-web/css/all.min.css">
<link rel="stylesheet" href="style/style.css">
<script src="js/swiper.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</head>

<body>
<nav class="navbar navbar-light navbar-expand-md">
	<div class="container-fluid top-box">
		<div class="row fix-menu">

			<?php include('form/menu.php'); ?>
		</div>
		<!--Slide box-->

		<!--end slide box-->

	</div>
</nav>

<div class="box-slide">
	<?php include('form/main-slide.php'); ?>
</div>

<!--Manin Product-->
<div class="container feature-pro">
		<div class="row">
<!--			<h1>Featured Products</h1>-->
		<?php
			echo $db->get_category("*","tbl_category","status=1 && location=1","id","0,8");
		?>
		</div><!-- end feature product
<!-New product-->
</div>

<div class="container main-product">
	<div class="row">
		<?php
			if(isset($_GET['pro'])){
				// /Applications/Ampps/www/nanosound/form/pro-detail.php
				include('form/pro-detail.php');
			}else{
				echo $db->get_content_pro("*","tbl_product","$con","od DESC","0,16");
				?>
					<a class="btn btn-more" id="btn-more-pro">More</a>
				<?php
			}

		?>
	</div>
</div>
	<input  hidden type="text" value="<?php echo $con; ?>" name="txt-con" id="txt-con">
	<input  hidden type="text" value="<?php echo $num_pro-16; ?>" id="txt-num-pro">
	<?php
	include('form/brand.php');
	include('form/footer.php');
	?>

</body>
<script>
	$(document).ready(function(){

		var body=$('body');
		var pop="<div class='popup'></div>";

		var view;
		var s=16;
		var con=$('#txt-con').val();
		var num_pro=$('#txt-num-pro');
		if(num_pro.val()<=0){
			$('#btn-more-pro').hide();
		}

		var y='status=1';
		if(con==y){
			$('.feature-pro').show();
			$('.main-product').hide();
		}else{
			$('.feature-pro').hide();
			$('.box-slide').hide();
		}

		//hide 0
		// var oldPrice = $('.item-old-price');
		// var eThis=$(this);
		// if(oldPrice.val()==''){
		// 	$(oldPrice).hide(eThis);
		// }
		// else {
		// 	$(oldPrice).show();
		// }




//		$('#menu-bar').on('click','ul li',function(){
//			$('.feature-pro').hide();
//			$('.main-product').show();
//		});

		// form popup
		body.on('click','.fa-eye',function(){
			var eThis=$(this);
			view=eThis.data('view');
			body.append(pop);
			$.ajax({
				url:'get-view.php',
				type:'POST',
				data:{view:view},
				cache:false,
				success:function(data){
					$('.popup').html(data);
				},
			});
		});

		// form login
		$('#btn-login').click(function(){
			body.append(pop);
			$(".popup").load("form/form-login.php", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success")
							// alert(2);
				if(statusTxt == "error")
					alert("Error: " + xhr.status + ": " + xhr.statusText);
				});


		});




		// When the user clicks anywhere outside of the frmLog, close it
		// close popup
		body.on('click','#btn-close, .close-area',function(){
			popups_close();
			});
		function popups_close(){
			$('.popup').remove();
		}
//menu phones

//search button
	// function buttonUp(){
    //   var valux = $('.sb-search-input').val();
	// 	valux = $.trim(valux).length;
    //       if(valux !== 0){
    //          $('.sb-search-submit').css('z-index','99');
    //       	} else{
    //          $('.sb-search-input').val('');
    //          $('.sb-search-submit').css('z-index','-999');
    //       	}
	// 	}

	// 		var submitIcon = $('.sb-icon-search');
	// 		var submitInput = $('.sb-search-input');
	// 		var searchBox = $('.sb-search');
	// 		var isOpen = false;

	// 		$(document).mouseup(function(){
	// 			if(isOpen == true){
	// 			submitInput.val('');
	// 			$('.sb-search-submit').css('z-index','-999');
	// 			submitIcon.click();
	// 			}
	// 		});

	// 		submitIcon.mouseup(function(){
	// 			return false;
	// 		});

	// 		searchBox.mouseup(function(){
	// 			return false;
	// 		});

	// 		submitIcon.click(function(){
	// 			if(isOpen == false){
	// 				searchBox.addClass('sb-search-open');
	// 				isOpen = true;
	// 			} else {
	// 				searchBox.removeClass('sb-search-open');
	// 				isOpen = false;
	// 			}
	// 	});
	//function search

//yasearch
		$('#search').keyup(function(){
			var search = $("#search").val();
			$.ajax({
				// type:"POST",
				url:"search.php",
				data:'usearch='+search,
				success:function(data){
					$("#back-result").html(data);
				}
			});

		});
	//end search button


	//more product
	$('#btn-more-pro').click(function(){
		var eThis=$(this);

		$.ajax({
				url:'get-pro-more.php',
				type:'POST',
				data:{e:16,s:s,con:con},
				cache:false,
				dataType:'JSON',
				success:function(data){
					for(i=0;i<data.length;i++){
						var proBox=	'<div class="col-xl-3 col-md-3 col-6 box-4">'+
						'<div class="row product-content btn15">'+
						'<div class="ovrly"></div>'+
						'<div class="buttons">'+
						'<div id="view" class="fas fa-eye"></div>'+
						'<div id="addCart" class="fas fa-cart-arrow-down"></div>'+
						'</div>'+
						'<div class="img-box">'+
						'<img src="admin/'+data[i].img+'">'+
						'</div>'+
						'<div class="item-box-desc">'+
						'<div class="item-title">'+
						'<a href="?menuid='+data[i].id+'">'+data[i].name+'-'+data[i].id+'-'+data[i].cat_id+'</a>'+
						'</div>'+
						'<div class="item-price">$'+data[i].price_guest+'</div>'+
						'<div class="item-old-price">$'+data[i].old_price+'</div>'+
						'</div>'+
						'</div>'+
						'</div>';
						eThis.before(proBox);
					}
					s+=8;
					num_pro.val(num_pro.val()-16);
					if(num_pro.val()<=0){
						eThis.hide();
					}
				}
			});
	});

});
</script>
</html>
