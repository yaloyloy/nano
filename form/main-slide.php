
<div class="swiper-container">
	<div class="swiper-wrapper">
		 <?php
		 	$post_data=$db->select_data("*","tbl_slide","status=1 && location=1","od DESC","0,10");
				if($post_data != '0'){
					foreach($post_data as $row){
		 ?>

		<div class="swiper-slide">
			<img src="admin/<?php echo $row[4]; ?>" alt="Slide">
		</div>
			<?php
					}
				}
		?>
		</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination"></div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
</div>
<script>
	//Initialize Swiper
	var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      centeredSlides: true,
		  autoplay: {
			delay: 3500,
			disableOnInteraction: false,
		  },
		  pagination: {
			el: '.swiper-pagination',
			clickable: true,
		  },
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },
    });
	// End //

	$(document).ready(function(){
		var ind = 0;
		var slide = $('.slider');
		var slideNum = slide.length; //5
		slide.hide();
		slide.eq(ind).show();
		$('.btn-next').click(function(){
			slide.eq(ind).hide();
			ind++;
			if(ind==slideNum){
				ind=0;
			}
			slide.eq(ind).show();
		});
		$('.btn-back').click(function(){
			slide.eq(ind).hide();
			if(ind==0){
				ind=slideNum;
			}
			ind--;
			slide.eq(ind).show();
		})
		//auto slide
		runSlide();
		var runAuto;
		function runSlide() {
		  runAuto = setInterval(nextFunc, 3000); //1000 ms = 1 second
		}
		function nextFunc() {
		  slide.eq(ind).hide();
			ind++;
			if(ind==slideNum){
				ind=0;
			}
			slide.eq(ind).show();
		}
	});
</script>
