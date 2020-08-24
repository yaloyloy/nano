<?php
	include('/admin/action/action.php');
	$db=new Action;
	?>			
<div class="frm-view">
	<form class="upl">
		<div id="btn-close" class="btn-close"><i class="fas fa-times"></i></div>
			<!-- Add Arrows -->
			<div class="swiper-button-next btn-navigate btn-next"></div>
			<div class="swiper-button-prev btn-navigate btn-back"></div>

		<div class="imgbox">

			<div class="img-box1 imgBox">
				<img src="img/JBL_Endurance-JUMP_Product-Image_Grey_Front-1605x1605px_New.png" alt="Product">
			</div>
			<!--	Image Box	-->
			<div class="swiper-container2 img-box2">
				<div class="swiper-wrapper">
					<div class="swiper-slide box" target="imgBox">
						<img src="img/JBL_Boombox_Black_Front-1605x1605.png" alt="items">
					</div>
					<div class="swiper-slide box" target="imgBox">
						<img src="img/party-box-1000__50638.1566094544.png" alt="items">
					</div>
					<div class="swiper-slide box" target="imgBox">
						<img src="img/Pulse 3.png" alt="items">
					</div>
					<div class="swiper-slide box" target="imgBox">
						<img src="img/JBL_Endurance-JUMP_Product-Image_Grey_Front-1605x1605px_New.png" alt="items">
					</div>
					<div class="swiper-slide box" target="imgBox">
						<img src="img/party-box-1000__50638.1566094544.png" alt="items">
					</div>
					<div class="swiper-slide box" target="imgBox">
						<img src="img/Pulse 3.png" alt="items">
					</div>
					<div class="swiper-slide box" target="imgBox">
						<img src="img/JBL_Endurance-JUMP_Product-Image_Grey_Front-1605x1605px_New.png" alt="items">
					</div>
				</div>
			</div>	
		</div>
			<div class="pro-desc">
				<div class="title">JBL Sound bar 5.1 </div>
				<div class="sub-title">Powerful Bluetooth party speaker with full panel light effects</div>
				<span class="price">$299</span> <span class="old-price">$520</span>
			</div>
	</form>
</div>
<?php
?>
<script>
$(document).ready(function(){
	//item box
	var swiper = new Swiper('.swiper-container2', {
      slidesPerView: 6,
      spaceBetween: 15,
      slidesPerGroup: 6,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination2',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
	
	//click on item
	$('.box img').click(function(e){
		e.preventDefault();
		$('.imgBox img').attr('src', $(this).attr('src'));
	})
});
</script>