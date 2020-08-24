<?php
	include('admin/action/action.php');
	$db=new Action;
	$view = $_POST['view'];

?>
<div class="frm-view">
	<form class="upl">
		<div id="btn-close" class="btn-close"><i class="fas fa-times"></i></div>
			<!-- Add Arrows -->
			<div class="swiper-button-next btn-navigate btn-next"></div>
			<div class="swiper-button-prev btn-navigate btn-back"></div>

		<div class="imgbox">
			<?php
			$post_data=$db->get_cur_data("*","tbl_product","id=".$view."");
			?>
				<div class="img-box1 imgBox">
				<img src="admin/<?php echo $post_data[6]; ?>" alt="Product">
				</div>
			<?php
			?>
			<!--	Image Box	-->
			<div class="swiper-container2 img-box2">
				<div class="swiper-wrapper">
					<?php
					$post_data=$db->select_data("*","tbl_product_img","pro_id=".$view."","id DESC","0,50");
				if($post_data != 0){
					foreach($post_data as $row){
					?>
					<div class="swiper-slide box" target="imgBox">
						<img src="admin/<?php echo $row[2]; ?>" alt="items">
					</div>
					<?php
							}
						}
				?>
				</div>
			</div>
		</div>
		<?php
		$post_data=$db->get_cur_data("*","tbl_product","id=".$view."");
		?>
			<div class="pro-desc">
				<div class="title"><?php echo $post_data[3]; ?></div>
				<div class="sub-title">Powerful Bluetooth party speaker with full panel light effects</div>
				<span class="price">$<?php echo $post_data[12]; ?></span> <span class="old-price">$<?php echo $post_data[16]; ?></span>
			</div>
			<?php
			?>
	</form>
</div>


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
