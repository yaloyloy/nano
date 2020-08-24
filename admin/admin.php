<?php
	session_start();
	include('action/action.php');
  $db = new Action;
	if(!isset($_SESSION['email'])){
		header('Location: index.php');
	}
	$email = $_SESSION['email'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$dplData=$db->dpl_data("*","tbl_user","email='".$email."' && ip='".$ip."'");
	if($dplData==false){
		header('Location: index.php');
	}
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="../style/fontawesome-free-5.8.1-web/css/all.min.css">
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/tinymce/js/tinymce/tinymce.min.js"></script>
</head>

<body>
<div class="box1">
	<div class="left">
		<div class="btn-menu">
		</div>
	</div>

	<div class="right">
		<span>Page Titile</span>
		<ul>
			<li id="btn-add">ADD</li>
			<li>
				<select id="txt-fil-page" name="txt-fil-page">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
			</li>
			<li id="btn-back"><</li>
			<li><span id="cur-page">1</span>/ <span id="total-page"></span> of <span id="total-record"></span></li>
			<li id="btn-next">></li>
		</ul>
	</div>

</div>
<div class="left-menu">
	<div class="user-profile">
		<a href="#"><i class="far fa-user"></i></a>


	</div>
	<div class="user-name">
			<h3>Rithya LG</h3>
			<p>Admin</p>
		</div>
	<ul>
<!--		<li data-frm="0">Menu</li>-->
		<li data-frm="1">
			<i class="far fa-images"></i>
			<span>Slide</span>
		</li>
		<li data-frm="2">
			<i class="far fa-list-alt"></i>
			<span>Category</span>
		</li>
		<li data-frm="3">
			<i class="fas fa-globe"></i>
			<span>Brand</span>
		</li>
		<li data-frm="4">
			<i class="fas fa-dice-d6"></i>
			<span>Product</span>
		</li>
		<li data-frm="5">
			<i class="fas fa-user"></i>
			<span>User</span>
		</li>
		<li data-frm="6">
			<i class="fas fa-user-tag"></i>
			<span>User Price</span>
		</li>
	</ul>
</div>
<div class="content">
	<table id="tbl-data"></table>
</div>
</body>
<script>
	$(document).ready(function(){
		//hide show menu
		var ind;
		var body=$('body');
		var tbl=$('#tbl-data');
		var img_name=$('#txt-photo');
		var pop="<div class='popup'></div>";
		var t=0;
		var e=$('#txt-fil-page').val();
		var s=0;
		var frm;
		var imgBox=$('.img-box');
		var totalRecord=$('#total-record');
		var totalPage=$('#total-page');
		var curPage=$('#cur-page');
		var frm_name = ["frm-menu.php","frm-slide.php","frm-category.php","frm-brand.php","frm-product.php","frm-user.php","frm-user-price.php"];
		var btnAction="<input type='button' value='Edit' class='btn-edit'>";
		var btnDel="<input type='button' id='btn-del' value='Delete' class='btn-del'>";
		$('.btn-menu').click(function(){
			if(t==0){
				$('.left-menu').hide();
				t=1;
				$('.content').css({'width':'100%'});
			}else{
				$('.left-menu').show();
				t=0;
				$('.content').css({'width':'85%'});
			}
		});
		//add form
		$('#btn-add').click(function(){
			body.append(pop);
			$(".popup").load("form/"+frm_name[frm]+"", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success")
				  	get_auto_id();
					calleditor()
				if(statusTxt == "error")
				  alert("Error: " + xhr.status + ": " + xhr.statusText);
			  });
		});

		//close form
		body.on('click','#btn-close',function(){
			$('.popup').remove();
		});
		//left menu click
		$('.left-menu').on('click','ul li',function(){
			s=0;
			var eThis=$(this);
			frm=eThis.data('frm');
			$('.right').show();
			//$('.right').find('span').text(eThis.text());
			$('.left-menu').find('ul li').css({'background-color':'#222222'});
			eThis.css({'background-color':'#FA4616'});
			if(frm==0){
				get_menu_list();
			}else if(frm==1){
				get_slide_list();
			}else if(frm==2){
				get_category_list();
			}else if(frm==3){
				get_brand_list();
			}else if(frm==4){
				get_product_list();
			}else if(frm==5){
				get_user_list();
			}else if(frm==6){
				get_userprice_list();
			}
			count_data();

		});
		// filter page
		$('#txt-fil-page').change(function(){
			e = $(this).val();
			s = 0;
			if(frm==0){
				get_menu_list();
			}else if(frm==1){
				get_slide_list();
			}else if(frm==2){
				get_category_list();
			}else if(frm==3){
				get_brand_list();
			}else if(frm==4){
				get_product_list();
			}else if(frm==5){
				get_user_list();
			}else if(frm==6){
				get_userprice_list();
			}

			curPage.text(1);
			totalPage.text(Math.ceil(parseInt(totalRecord.text())/e));
		});
		//nexr record / next btn
		$('#btn-next').click(function(){
			if(parseInt(curPage.text())==(parseInt(totalPage.text()))){
				return;
			}
			s += parseFloat(e);
			if(frm==0){
				get_menu_list();
			}else if(frm==1){
				get_slide_list();
			}else if(frm==2){
				get_category_list();
			}else if(frm==3){
				get_brand_list();
			}else if(frm==4){
				get_product_list();
			}else if(frm==5){
				get_user_list();
			}else if(frm==6){
				get_userprice_list();
			}
			curPage.text(parseInt(curPage.text())+1);
		});
		//back record / btn back
		$('#btn-back').click(function(){
			if(s==0){
				return;
			}
			s -= parseFloat(e);
			if(frm==0){
				get_menu_list();
			}else if(frm==1){
				get_slide_list();
			}else if(frm==2){
				get_category_list();
			}else if(frm==3){
				get_brand_list();
			}else if(frm==4){
				get_product_list();
			}else if(frm==5){
				get_user_list();
			}else if(frm==6){
				get_userprice_list();
			}

			curPage.text(parseInt(curPage.text())-1);
		});
		//save data
		body.on('click','.btn-save',function(){
			var eThis=$(this);
			if(frm==0){
				save_menu(eThis);
			}else if(frm==1){
				save_slide(eThis);
			}else if(frm==2){
				save_category(eThis);
			}else if(frm==3){
				save_brand(eThis);
			}else if(frm==4){
				save_product(eThis);
			}else if(frm==5){
				save_user(eThis);
			}else if(frm==6){
				save_user_price(eThis);
			}

		});
		//upload img
		body.on('change','.txt-file',function(){
			var eThis=$(this);
			var Parent=eThis.parent();
			var photo=$('#txt-photo');
			var imgBox=$('#img-box');
			var frm=$(this).closest('form.upl');
			var form_data=new FormData(frm[0]);
			$.ajax({
				url:'action/upl-img.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				success:function(data){
					if(data.send==false){
						alert(data.msg);
					}else{
						Parent.css({'background-image':'url('+data.img_name+')'});
						Parent.find('#txt-photo').val(data.img_name);
					}

				}

			});
		});
		//upload multi img
		body.on('change','.txt-file2',function(){
			var eThis=$(this);
			var Parent=eThis.parent();

			var txtFile=eThis.prop("files")[0];
			var frm=$(this).closest('form.upl');
			var form_data=new FormData(frm[0]);
			form_data.append('txt-file',txtFile);
			$.ajax({
				url:'action/upl-img.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				success:function(data){
					if(data.send==false){
						alert(data.msg);
					}else{
						Parent.css({'background-image':'url('+data.img_name+')'});
						Parent.find('#txt-photo').val(data.img_name);
					}

				}

			});
		});
		//edit data
		body.on('click','.btn-edit',function(){
			var eThis=$(this);
			if(frm==0){
				get_edit_menu(eThis);
			}else if(frm==1){
				get_edit_side(eThis);
			}else if(frm==2){
				get_edit_category(eThis);
			}else if(frm==3){
				get_edit_brand(eThis);
			}else if(frm==4){
				get_edit_product(eThis);
			}else if(frm==5){
				get_edit_user(eThis);
			}else if(frm==6){
				get_edit_userprice(eThis);
			}

		});
		//Btn Del
		body.on('click','.btn-del',function(){
			//var eThis=$(this);
			delete_data(id);
		});


		//save Menu
		function save_menu(eThis){
			var id=$('#txt-id');
			var name=$('#txt-name');
			var lUrl=$('#txt-url');
			var od=$('#txt-od');
			var location=$('#txt-location');
			var status=$('#txt-status');
			var photo=$('#txt-photo');
			var imgBox=$('.img-box');
			if(name.val()==''){
				alert('Please Input Name.');
				name.focus();
				return;
			}else if(od.val()==''){
				alert('Please Input OD.');
				od.focus();
				return;
			}

			var frm=eThis.closest('form.upl');
			var form_data=new FormData(frm[0]);
			$.ajax({
				url:'action/save-menu.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				beforeSend:function(){

				},
				success:function(data){
					if(data.dpl==true){
						alert('Duplicate Name.');
						return;
					}
					if(data.edit==true){
						tbl.find('tr:eq('+ind+') td:eq(1)').text(name.val());
						tbl.find('tr:eq('+ind+') td:eq(2)').text(lUrl.val());
						tbl.find('tr:eq('+ind+') td:eq(3) img').attr('src',photo.val());
						tbl.find('tr:eq('+ind+') td:eq(4)').text(location.val());
						tbl.find('tr:eq('+ind+') td:eq(5)').text(od.val());
						tbl.find('tr:eq('+ind+') td:eq(6)').text(status.val());
						$('.popup').remove();
						return;
					}
					var img="<img src="+photo.val()+" width='50' height='50'>";
					var tr="<tr> <td>"+data.id+"</td> <td>"+name.val()+"</td> <td>"+lUrl.val()+"</td> <td>"+img+"</td> <td>"+location.val()+"</td> <td>"+od.val()+"</td> <td>1</td> <td>"+btnAction+"</td> </tr>";
					tbl.find('tr:eq(0)').after(tr);


					id.val(data.id+1);
					od.val(data.id+1);
					count_data();
					name.val('');
					name.focus();
					photo.val('');
					imgBox.css({'background-image':'url(img/defualt_bg.png)'});
					$('#txt-file').val('');
				},
				error:function(){

				},
			});
		};
		//save Slide
		function save_slide(eThis){
			var id=$('#txt-id');
			var name=$('#txt-name');
			var slideDesc=$('#txt-desc');
			var location=$('#txt-location');
			var od=$('#txt-od');
			var status=$('#txt-status');
			var photo=$('#txt-photo');
			var imgBox=$('.img-box');
			if(name.val()==''){
				alert('Please input Name.');
				name.focus();
				return;
			}
			var frm=eThis.closest('form.upl');
			var form_data=new FormData(frm[0]);
			$.ajax({
				url:'action/save-slide.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				beforeSend:function(){

				},
				success:function(data){

					if(data.dpl==true){
						alert('Duplicate Name.');
						return;
					}
					if(data.edit==true){

						tbl.find('tr:eq('+ind+') td:eq(1)').text(name.val());
						tbl.find('tr:eq('+ind+') td:eq(2)').text(slideDesc.val());
						tbl.find('tr:eq('+ind+') td:eq(3) img').attr('src',photo.val());
						tbl.find('tr:eq('+ind+') td:eq(4)').text(location.val());
						tbl.find('tr:eq('+ind+') td:eq(5)').text(od.val());
						tbl.find('tr:eq('+ind+') td:eq(6)').text(status.val());
						$('.popup').remove();
						return;
					}
					var img="<img src="+photo.val()+" width='50' height='50'>";
					var tr="<tr> <td>"+data.id+"</td> <td>"+name.val()+"</td> <td>"+slideDesc.val()+"</td> <td>"+img+"</td> <td>"+location.val()+"</td> <td>"+od.val()+"</td> <td>1</td> <td>"+btnAction+"</td> </tr>";
					tbl.find('tr:eq(0)').after(tr);


					id.val(data.id+1);
					od.val(data.id+1);
					count_data();
					name.val('');
					name.focus();
					slideDesc.val('');
					photo.val('');
					imgBox.css({'background-image':'url(img/defualt_bg.png)'});
					$('#txt-file').val('');
				},

			});

		};
		//save Gategory
		function save_category(eThis){
			var id=$('#txt-id');
			var name=$('#txt-name');
			var location=$('#txt-location');
			var od=$('#txt-od');
			var status=$('#txt-status');
			var photo=$('#txt-photo');
			var imgBox=$('.img-box');

			var frm=eThis.closest('form.upl');
			var form_data=new FormData(frm[0]);
			$.ajax({
				url:'action/save-category.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				beforeSend:function(){

				},
				success:function(data){
					if(data.edit==true){
						tbl.find('tr:eq('+ind+') td:eq(1)').text(name.val());
						tbl.find('tr:eq('+ind+') td:eq(2) img').attr('src',photo.val());
						tbl.find('tr:eq('+ind+') td:eq(3)').text(location.val());
						tbl.find('tr:eq('+ind+') td:eq(4)').text(od.val());
						tbl.find('tr:eq('+ind+') td:eq(5)').text(status.val());
						$('.popup').remove();
						return;
					}
					var img="<img src="+photo.val()+" width='50' height='50'>";
					var tr="<tr> <td>"+data.id+"</td> <td>"+name.val()+"</td> <td>"+img+"</td> <td>"+location.val()+"</td> <td>"+od.val()+"</td> <td>1</td> <td>"+btnAction+"</td> </tr>";
					tbl.find('tr:eq(0)').after(tr);


					id.val(data.id+1);
					od.val(data.id+1);
					count_data();
					name.val('');
					name.focus();
					photo.val('');
					imgBox.css({'background-image':'url(img/defualt_bg.png)'});
					$('#txt-file').val('');
				},
				error:function(){

				},
			});
		};
		//save Brand
		function save_brand(eThis){
			var id=$('#txt-id');
			var name=$('#txt-name');
			var brand=$('#txt-brand');
			var location=$('#txt-location');
			var od=$('#txt-od');
			var status=$('#txt-status');
			var photo=$('#txt-photo');
			var imgBox=$('.img-box');
			if(name.val()==''){
				alert('Please input Name.');
				name.focus();
				return;
			}

			var frm=eThis.closest('form.upl');
			var form_data=new FormData(frm[0]);
			$.ajax({
				url:'action/save-brand.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				beforeSend:function(){

				},
				success:function(data){
					if(data.dpl==true){
						alert('Duplicate Name.');
						return;
					}

					if(data.edit==true){
						tbl.find('tr:eq('+ind+') td:eq(1)').text(brand.val());
						tbl.find('tr:eq('+ind+') td:eq(2)').text(name.val());
						tbl.find('tr:eq('+ind+') td:eq(3) img').attr('src',photo.val());
						tbl.find('tr:eq('+ind+') td:eq(4)').text(location.val());
						tbl.find('tr:eq('+ind+') td:eq(5)').text(od.val());
						tbl.find('tr:eq('+ind+') td:eq(6)').text(status.val());
						$('.popup').remove();
						return;
					}
					var img="<img src="+photo.val()+" width='50' height='50'>";
					var tr="<tr> <td>"+data.id+"</td> <td>"+brand.val()+"</td> <td>"+name.val()+"</td> <td>"+img+"</td> <td>"+location.val()+"</td> <td>"+od.val()+"</td> <td>1</td> <td>"+btnAction+"</td> </tr>";
					tbl.find('tr:eq(0)').after(tr);


					id.val(data.id+1);
					od.val(data.id+1);
					count_data();
					name.val('');
					name.focus();
					photo.val('');
					imgBox.css({'background-image':'url(img/defualt_bg.png)'});
					$('#txt-file').val('');
				},

			});
		};
		//save Product
		function save_product(eThis){

			tinymce.triggerSave();
			var id=$('#txt-id');
			var catId=$('#txt-cat-id');
			var brandId=$('#txt-brand-id');

			var name=$('#txt-name');
			var proDesc=$('#txt-desc');
			var priGeu=$('#txt-pri-gue');
			var priDea=$('#txt-pri-dea');
			var priMem=$('#txt-pri-mem');
			var priVip=$('#txt-pri-vip');
			var oldPri=$('#txt-old-pri');

			//get date and time
			var d = new Date();
			var datePost = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate() + "<br>" + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
			//
			var user=$('#txt-user');
			var titleLink=$('#txt-title-link');
			var view=$('#txt-view');
			var od=$('#txt-od');
			var status=$('#txt-status');
			var photo=$('#txt-photo');
			var imgBox=$('.img-box');
			if(name.val()==''){
				alert('Please input Name.');
				name.focus();
				return;
			}

			var frm=eThis.closest('form.upl');
			var form_data=new FormData(frm[0]);
			$.ajax({
				url:'action/save-product.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				beforeSend:function(){

				},
				success:function(data){
					if(data.dpl==true){
						alert('Duplicate Name.');
						return;
					}

					if(data.edit==true){ //when save to db show this to client

						tbl.find('tr:eq('+ind+') td:eq(1)').text(catId.find("option:selected").text());
						tbl.find('tr:eq('+ind+') td:eq(2)').text(brandId.find("option:selected").text());
						tbl.find('tr:eq('+ind+') td:eq(3)').text(name.val());
						tbl.find('tr:eq('+ind+') td:eq(4)').text(priGeu.val());
						tbl.find('tr:eq('+ind+') td:eq(5)').text(priDea.val());
						tbl.find('tr:eq('+ind+') td:eq(6)').text(priMem.val());
						tbl.find('tr:eq('+ind+') td:eq(7)').text(priVip.val());
						tbl.find('tr:eq('+ind+') td:eq(8)').text(oldPri.val());
						tbl.find('tr:eq('+ind+') td:eq(9)').val(datePost);
						tbl.find('tr:eq('+ind+') td:eq(10) img').attr('src',photo.val());
						tbl.find('tr:eq('+ind+') td:eq(11)').text(user.val());
						tbl.find('tr:eq('+ind+') td:eq(12)').text(view.val());
						tbl.find('tr:eq('+ind+') td:eq(13)').text(od.val());
						tbl.find('tr:eq('+ind+') td:eq(14)').text(status.val());
						$('.popup').remove();
						return;
					}
					var img="<img src="+photo.val()+" width='50' height='50'>";
					var tr="<tr> <td>"+data.id+"</td> <td>"+catId.find("option:selected").text()+"</td> <td>"+brandId.find("option:selected").text()+"</td> <td>"+name.val()+"</td> <td>"+priGeu.val()+"</td> <td>"+priDea.val()+"</td> <td>"+priMem.val()+"</td> <td>"+priVip.val()+"</td> <td>"+oldPri.val()+"</td> <td>"+datePost+"</td> <td>"+img+"</td> <td>"+user.val()+"</td> <td>"+view.val()+"</td> <td>"+od.val()+"</td> <td>1</td> <td>"+btnAction+"</td> <td>"+btnDel+"</td> </tr>";
					tbl.find('tr:eq(0)').after(tr);


					id.val(data.id+1);
					od.val(data.id+1);
					count_data();
					name.val('');
					name.focus();
					proDesc.val('');
					photo.val('');
					proDesc.val('');
					priGeu.val('');
					priDea.val('');
					priMem.val('');
					priVip.val('');
					imgBox.css({'background-image':'url(img/defualt_bg.png)'});
					$('#txt-file').val('');
				},

			});
		};
		//save User
		function save_user(eThis){
			var id=$('#txt-id');
			var email=$('#txt-email');
			var pass=$('#txt-pass');
			var type=$('#txt-type');
			var ip=$('#txt-ip');
			var status=$('#txt-status');
			var photo=$('#txt-photo');
			var imgBox=$('.img-box');
			if(email.val()==''){
				alert('Please input Email.');
				email.focus();
				return;
			}else if(pass.val()==''){
				alert('Please input Password');
				pass.focus();
				return;
			}
			var frm=eThis.closest('form.upl');
			var form_data=new FormData(frm[0]);
			$.ajax({
				url:'action/save-user.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				beforeSend:function(){

				},
				success:function(data){
					if(data.dpl==true){
						alert('Duplicate Name.');
						return;
					}
					if(data.edit==true){
						tbl.find('tr:eq('+ind+') td:eq(1)').text(email.val());
						tbl.find('tr:eq('+ind+') td:eq(2)').text(type.val());
						tbl.find('tr:eq('+ind+') td:eq(3) img').attr('src',photo.val());
						tbl.find('tr:eq('+ind+') td:eq(4)').text(ip.val());
						tbl.find('tr:eq('+ind+') td:eq(5)').text(status.val());

						$('.popup').remove();
						return;
					}
					var img="<img src="+photo.val()+" width='50' height='50'>";
					var tr="<tr> <td>"+data.id+"</td> <td>"+email.val()+"</td> <td>"+type.val()+"</td> <td>"+img+"</td> <td>"+ip.val()+"</td> <td>1</td> <td>"+btnAction+"</td> </tr>";
					tbl.find('tr:eq(0)').after(tr);

					id.val(data.id+1);
					count_data();
					email.val('');
					email.focus();
					pass.val('');
					photo.val('');
					imgBox.css({'background-image':'url(img/defualt_bg.png)'});
					$('#txt-file').val('');
				}

			});

		}
		//save User price
		function save_user_price(eThis){
			var id=$('#txt-id');
			var name=$('#txt-name');
			var email=$('#txt-email');
			var pass=$('#txt-pass');
			var type=$('#txt-type');
			var ip=$('#txt-ip');
			var status=$('#txt-status');
			var photo=$('#txt-photo');
			var imgBox=$('.img-box');
			if(email.val()==''){
				alert('Please input Email.');
				email.focus();
				return;
			}else if(pass.val()==''){
				alert('Please input Password');
				pass.focus();
				return;
			}
			var frm=eThis.closest('form.upl');
			var form_data=new FormData(frm[0]);
			$.ajax({
				url:'action/save-user-price.php',
				type:'POST',
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				dataType:'JSON',
				beforeSend:function(){

				},
				success:function(data){
					if(data.dpl==true){
						alert('Duplicate Name.');
						return;
					}
					if(data.edit==true){
						tbl.find('tr:eq('+ind+') td:eq(1)').text(name.val());
						tbl.find('tr:eq('+ind+') td:eq(2)').text(email.val());
						tbl.find('tr:eq('+ind+') td:eq(3)').text(type.val());
						tbl.find('tr:eq('+ind+') td:eq(4) img').attr('src',photo.val());
						tbl.find('tr:eq('+ind+') td:eq(5)').text(ip.val());
						tbl.find('tr:eq('+ind+') td:eq(6)').text(status.val());

						$('.popup').remove();
						return;
					}
					var img="<img src="+photo.val()+" width='50' height='50'>";
					var tr="<tr> <td>"+data.id+"</td> <td>"+name.val()+"</td> <td>"+email.val()+"</td> <td>"+type.val()+"</td> <td>"+img+"</td> <td>"+ip.val()+"</td> <td>1</td> <td>"+btnAction+"</td> </tr>";
					tbl.find('tr:eq(0)').after(tr);

					id.val(data.id+1);
					count_data();
					name.val('');
					email.val('');
					email.focus();
					pass.val('');
					photo.val('');
					imgBox.css({'background-image':'url(img/defualt_bg.png)'});
					$('#txt-file').val('');
				}

			});

		}
		//get edit menu
		function get_edit_menu(eThis){
			body.append(pop);
			$(".popup").load("form/"+frm_name[frm]+"", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success")
					var tr=eThis.parents('tr');
					ind=tr.index();
					var id2=tr.find('td:eq(0)').text();
					var name2=tr.find('td:eq(1)').text();
					var lUrl2=tr.find('td:eq(2)').text();
					var img2=tr.find('td:eq(3) img').attr('src');
					var location2=tr.find('td:eq(4)').text();
					var od2=tr.find('td:eq(5)').text();
					var status2=tr.find('td:eq(6)').text();
					$('#txt-edit-id').val(id2);
					$('#txt-id').val(id2);
					$('#txt-name').val(name2);
					$('#txt-url').val(lUrl2);
					$('#txt-location').val(location2);
					$('#txt-od').val(od2);
					$('#txt-status').val(status2);
					$('#txt-photo').val(img2);
					$('.img-box').css({'background-image':'url('+img2+')'});
				if(statusTxt == "error")
				  alert("Error: " + xhr.status + ": " + xhr.statusText);
			  });
		}
		//get edit slide
		function get_edit_side(eThis){
			body.append(pop);
			$(".popup").load("form/"+frm_name[frm]+"", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success")
					var tr=eThis.parents('tr');
					ind=tr.index();
					var id=tr.find('td:eq(0)').text();
					$.ajax({
					url:'action/get-slide-edit.php',
					type:'POST',
					data:{id:id},
					cache:false,
					dataType:'JSON',
					success:function(data){
							$('#txt-edit-id').val(id);
							$('#txt-id').val(id);
							$('#txt-name').val(data.name);
							$('#txt-desc').val(data.slide_desc);
							$('#txt-location').val(data.location);
							$('#txt-od').val(data.od);
							$('#txt-status').val(data.status);
							$('#txt-photo').val(data.img);
							$('.img-box').css({'background-image':'url('+data.img+')'});
						}
					});
				if(statusTxt == "error")
					alert("Error: " + xhr.status + ": " + xhr.statusText);
			});
		}
		//get edit user
		function get_edit_user(eThis){
			body.append(pop);
			$(".popup").load("form/"+frm_name[frm]+"", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success")
					var tr=eThis.parents('tr');
					ind=tr.index();
					var id=tr.find('td:eq(0)').text();
					$.ajax({
					url:'action/get-user-edit.php',
					type:'POST',
					data:{id:id},
					cache:false,
					dataType:'JSON',
					success:function(data){
							$('#txt-edit-id').val(id);
							$('#txt-id').val(id);
							$('#txt-email').val(data.email);
							$('#txt-type').val(data.type);
							$('#txt-ip').val(data.ip);
							$('#txt-status').val(data.status);
							$('#txt-photo').val(data.img);
							$('.img-box').css({'background-image':'url('+data.img+')'});
						}
					});
				if(statusTxt == "error")
					alert("Error: " + xhr.status + ": " + xhr.statusText);
			});
		}
		//get edit userprice
		function get_edit_userprice(eThis){
			body.append(pop);
			$(".popup").load("form/"+frm_name[frm]+"", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success")
					var tr=eThis.parents('tr');
					ind=tr.index();
					var id=tr.find('td:eq(0)').text();
					$.ajax({
					url:'action/get-userprice-edit.php',
					type:'POST',
					data:{id:id},
					cache:false,
					dataType:'JSON',
					success:function(data){
							$('#txt-edit-id').val(id);
							$('#txt-id').val(id);
							$('#txt-name').val(data.name);
							$('#txt-email').val(data.email);
							$('#txt-type').val(data.type);
							$('#txt-ip').val(data.ip);
							$('#txt-status').val(data.status);
							$('#txt-photo').val(data.img);
							$('.img-box').css({'background-image':'url('+data.img+')'});
						}
					});
				if(statusTxt == "error")
					alert("Error: " + xhr.status + ": " + xhr.statusText);
			});
		}
		//get edit category
		function get_edit_category(eThis){
			body.append(pop);
			$(".popup").load("form/"+frm_name[frm]+"", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success")
					var tr=eThis.parents('tr');
					ind=tr.index();
					var id=tr.find('td:eq(0)').text();
					$.ajax({
					url:'action/get-category-edit.php',
					type:'POST',
					data:{id:id},
					cache:false,
					dataType:'JSON',
					success:function(data){
							$('#txt-edit-id').val(id);
							$('#txt-id').val(id);
							$('#txt-name').val(data.name);
							$('#txt-location').val(data.location);
							$('#txt-od').val(data.od);
							$('#txt-status').val(data.status);
							$('#txt-photo').val(data.img);
							$('.img-box').css({'background-image':'url('+data.img+')'});

						}
					});




				if(statusTxt == "error")
					alert("Error: " + xhr.status + ": " + xhr.statusText);
			});
		}
		//get edit brand
		function get_edit_brand(eThis){
			body.append(pop);
			$(".popup").load("form/"+frm_name[frm]+"", function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success")
					var tr=eThis.parents('tr');
					ind=tr.index();
					var id=tr.find('td:eq(0)').text();
					$.ajax({
					url:'action/get-brand-edit.php',
					type:'POST',
					data:{id:id},
					cache:false,
					dataType:'JSON',
					success:function(data){
							$('#txt-edit-id').val(id);
							$('#txt-id').val(id);
							$('#txt-brand').val(data.cat_id);
							$('#txt-name').val(data.name);
							$('#txt-location').val(data.location);
							$('#txt-od').val(data.od);
							$('#txt-status').val(data.status);
							$('#txt-photo').val(data.img);
							$('.img-box').css({'background-image':'url('+data.img+')'});
						}
					});
				if(statusTxt == "error")
					alert("Error: " + xhr.status + ": " + xhr.statusText);
			});
		}
		//get edit product
		function get_edit_product(eThis){
			body.append(pop);
			$(".popup").load("form/"+frm_name[frm]+"", function(responseTxt, statusTxt, xhr){

				var tr=eThis.parents('tr');
					ind=tr.index();
				var id=tr.find('td:eq(0)').text();
				if(statusTxt == "success")
					$.ajax({
						url:'action/get-product-edit.php',
						type:'POST',
						data:{id:id},
						cache:false,
						dataType:'JSON',
						success:function(data){
							$('#txt-edit-id').val(id);
							$('#txt-id').val(id);
							$('#txt-cat-id').val(data.cat_id);
							$('#txt-brand-id').val(data.brand_id);
							$('#txt-name').val(data.name);
							$('#txt-pri-gue').val(data.price_guest);
							$('#txt-pri-dea').val(data.price_dealer);
							$('#txt-pri-mem').val(data.price_member);
							$('#txt-pri-vip').val(data.price_vip);
							$('#txt-old-pri').val(data.old_price);
							$('#txt-desc').val(data.pro_desc);
							$('#txt-date-post').val(data.date_post);
							$('#txt-od').val(data.od);
							$('#txt-status').val(data.status);
							$('#txt-photo').val(data.img);
							$('#img-box').css({'background-image':'url('+data.img+')'});
//							$('.img-box').css({'background-image':'url('+data.img+')'});
							calleditor();
						}
					});
					//get product image
					//var imageBox = '<div class="img-box img-box2"> </div>'
					$.ajax({
						url:'action/get-item-img.php',
						type:'POST',
						data:{id:id},
						cache:false,
						dataType:'JSON',
						success:function(data){
							var ind=data.length;
							var img_box=$('.img-box2');
							for(x=0;x<ind;x++){
								//alert(data[x].img);
								img_box.eq(x).css("background-image", "url('"+data[x].img+"')");
								img_box.eq(x).find('#txt-photo').val(data[x].img);
							}

						}
					});
				if(statusTxt == "error")
					alert("Error: " + xhr.status + ": " + xhr.statusText);
			});

		};



		//get auto ID
		function get_auto_id(){
			$.ajax({
				url:'action/get-auto-id.php',
				type:'POST',
				data:{frm:frm},
				cache:false,
				dataType:'JSON',
				success:function(data){
					$('#txt-id').val(parseInt(data.id)+1);
					$('#txt-od').val(parseInt(data.id)+1);

				}
			});
		}
		//count data
		function count_data(){
			$.ajax({
				url:'action/count-data.php',
				type:'POST',
				data:{frm:frm},
				cache:false,
				dataType:'JSON',
				success:function(data){
					totalRecord.text(data.total);
					totalPage.text(Math.ceil(data.total/e));
				}
			});
		}
		//get Menu list
		function get_menu_list(){
			var th='<tr> <th width="70">ID</th> <th>Title</th> <th width="200">Link</th> <th width="70">Image</th> <th width="70">Location</th> <th width="70">OD</th> <th width="70">Status</th> <th width="70">Action</th> </tr>';
			tbl.find('tr').remove();
			tbl.append(th);
			$.ajax({
				url:'action/get-menu-list.php',
				type:'POST',
				data:{e:e,s:s},
				cache:false,
				//dataType:'JSON',
				success:function(data){
//					for(i=0;i<data.length;i++){
//						var imgBox="<img src='"+data[i].img+"' width='50' height='50'>";
//						var td ="<tr> <td>"+data[i].id+"</td> <td>"+data[i].title+"</td> <td>"+data[i].url+"</td> <td>"+imgBox+"</td> <td>"+data[i].location+"</td> <td>"+data[i].od+"</td> <td>"+data[i].status+"</td> <td>"+btnAction+"</td> </tr>";
//						tbl.append(td);
						tbl.html(th + data);
//					}
				}
			});

		}
		//get Slide list
		function get_slide_list(){
			var th='<tr> <th width="70">ID</th> <th>Name</th> <th>Slide-Desc</th> <th width="70">Image</th> <th width="70">Location</th> <th width="70">OD</th> <th width="70">Status</th> <th width="70">Action</th> </tr>';
			tbl.find('tr').remove();
			tbl.append(th);
			$.ajax({
				url:'action/get-slide-list.php',
				type:'POST',
				data:{e:e,s:s},
				cache:false,
				dataType:'JSON',
				success:function(data){
					for(i=0;i<data.length;i++){
						var imgBox="<img src='"+data[i].img+"' width='90' height='50'>";
						var td ="<tr> <td>"+data[i].id+"</td> <td>"+data[i].name+"</td> <td>"+data[i].slide_desc+"</td> <td>"+imgBox+"</td> <td>"+data[i].location+"</td> <td>"+data[i].od+"</td> <td>"+data[i].status+"</td> <td>"+btnAction+"</td> </tr>";
						tbl.append(td);
					}
				}
			});
		}
		//get user list
		function get_user_list(){
			var th='<tr> <th width="70">ID</th> <th>Email</th> <th>Type</th> <th width="70">Image</th> <th width="70">IP</th> <th width="70">Status</th> <th width="70">Action</th> </tr>';
			tbl.find('tr').remove();
			tbl.append(th);
			$.ajax({
				url:'action/get-user-list.php',
				type:'POST',
				data:{e:e,s:s},
				cache:false,
				dataType:'JSON',
				success:function(data){
					for(i=0;i<data.length;i++){
						var imgBox="<img src='"+data[i].img+"' width='50' height='50'>";
						var td ="<tr> <td>"+data[i].id+"</td> <td>"+data[i].email+"</td> <td>"+data[i].type+"</td> <td>"+imgBox+"</td> <td>"+data[i].ip+"</td> <td>"+data[i].status+"</td> <td>"+btnAction+"</td> </tr>";
						tbl.append(td);
					}
				}
			});
		}
		//get user-price list
		function get_userprice_list(){
			var th='<tr> <th width="70">ID</th> <th>Name</th> <th>Email</th><th>Type</th> <th width="70">Image</th> <th width="70">IP</th> <th width="70">Status</th> <th width="70">Action</th> </tr>';
			tbl.find('tr').remove();
			tbl.append(th);
			$.ajax({
				url:'action/get-userprice-list.php',
				type:'POST',
				data:{e:e,s:s},
				cache:false,
				dataType:'JSON',
				success:function(data){
					for(i=0;i<data.length;i++){
						var imgBox="<img src='"+data[i].img+"' width='50' height='50'>";
						var td ="<tr> <td>"+data[i].id+"</td> <td>"+data[i].name+"</td> <td>"+data[i].email+"</td> <td>"+data[i].type+"</td> <td>"+imgBox+"</td> <td>"+data[i].ip+"</td> <td>"+data[i].status+"</td> <td>"+btnAction+"</td> </tr>";
						tbl.append(td);
					}
				}
			});
		}
		//get Category List
		function get_category_list(){
			var th='<tr> <th width="70">ID</th> <th>Name</th> <th width="70">Image</th> <th width="70">Location</th> <th width="70">OD</th> <th width="70">Status</th> <th width="70">Action</th> </tr>';
			tbl.find('tr').remove();
			tbl.append(th);
			$.ajax({
				url:'action/get-category-list.php',
				type:'POST',
				data:{e:e,s:s},
				cache:false,
				dataType:'JSON',
				success:function(data){
					for(i=0;i<data.length;i++){
						var imgBox="<img src='"+data[i].img+"' width='50' height='50'>";
						var td ="<tr> <td>"+data[i].id+"</td> <td>"+data[i].name+"</td>  <td>"+imgBox+"</td> <td>"+data[i].location+"</td> <td>"+data[i].od+"</td> <td>"+data[i].status+"</td> <td>"+btnAction+"</td> </tr>";
						tbl.append(td);
					}
				}
			});

		}
		//get Brand List
		function get_brand_list(){
			var th='<tr> <th width="70">ID</th> <th>Brand</th> <th>Name</th> <th width="70">Image</th> <th width="70">Location</th> <th width="70">OD</th> <th width="70">Status</th> <th width="70">Action</th> </tr>';
			tbl.find('tr').remove();
			tbl.append(th);
			$.ajax({
				url:'action/get-brand-list.php',
				type:'POST',
				data:{e:e,s:s},
				cache:false,
				dataType:'JSON',
				success:function(data){
					for(i=0;i<data.length;i++){
						var imgBox="<img src='"+data[i].img+"' width='50' height='50'>";
						var td ="<tr> <td>"+data[i].id+"</td> <td>"+data[i].cat_id+"</td> <td>"+data[i].name+"</td>  <td>"+imgBox+"</td> <td>"+data[i].location+"</td> <td>"+data[i].od+"</td> <td>"+data[i].status+"</td> <td>"+btnAction+"</td> </tr>";
						tbl.append(td);
					}
				}
			});
		}
		//get Product List
		function get_product_list(){
			var th='<tr> <th width="70">ID</th> <th>Category</th> <th>Brand</th> <th>Name</th> <th width="70">Price</th> <th width="70">Price Dealer</th> <th width="70">Price Member</th> <th width="70">Price VIP</th> <th width="70">Old Price</th> <th width="90">Date Post</th> <th width="70">Image</th> <th width="50">user</th> <th width="50">view</th> <th width="50">OD</th> <th width="50">Status</th> <th width="50">Action</th> <th width="50">Action</th> </tr>';
			tbl.find('tr').remove();
			tbl.append(th);
			$.ajax({
				url:'action/get-product-list.php',
				type:'POST',
				data:{e:e,s:s},
				cache:false,
//				dataType:'JSON',
				success:function(data){
//					for(i=0;i<data.length;i++){
//						var imgBox="<img src='"+data[i].img+"' width='50' height='50'>";
//						var td ="<tr> <td>"+data[i].id+"</td> <td>"+data[i].cat_id+"</td> <td>"+data[i].brand_id+"</td> <td>"+data[i].name+"</td> <td>"+data[i].pro_desc+"</td> <td>"+data[i].date_post+"</td> <td>"+imgBox+"<td>"+data[i].user+"</td> </td> <td>"+data[i].view+"</td> <td>"+data[i].od+"</td> <td>"+data[i].status+"</td> <td>"+btnAction+"</td> </tr>";
//						tbl.append(td);
//					}
					tbl.html(th + data);
				}
			});
		};

		//call text Editor



		//Text Editor
		function calleditor(){
			tinymce.remove();
			tinymce.init({selector:"textarea",theme: "modern",width: "760",height:"270",relative_urls: false, remove_script_host: false,
			file_browser_callback:function(field_name, url, type, win){
				var filebrowser = "js/filebrowser.php";
				filebrowser += (filebrowser.indexOf("?") < 0) ? "?type=" + type : "&type=" + type;
				tinymce.activeEditor.windowManager.open({
					title : "Insert Photo",
					width : 560,
					height : 500,
					url : filebrowser
				}, {
					window : win,
					input : field_name
				});
				return false;
			},
			plugins: [
					"advlist autolink lists link image charmap print preview hr anchor pagebreak",
					"searchreplace wordcount visualblocks visualchars code fullscreen",
					"insertdatetime media nonbreaking save table contextmenu directionality",
					"emoticons template paste textcolor colorpicker textpattern imagetools media code",
			],
			menubar:true,toolbar1: "undo redo | insert | sizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",
			toolbar2:"fontselect | fontsizeselect | forecolor media code",
			});
		}

	});
</script>
</html>
