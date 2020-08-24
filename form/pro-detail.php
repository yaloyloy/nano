<?php
	$proid=$_GET['pro'];
			?>
			<div class="col-xl-12 col-md-12 col-12">
				<div class="row">
					<div class="col-xl-6 col-md-6 col-12 product-box">
						<!-- Add Arrows -->
						<!-- <div class="swiper-button-next btn-n-b"></div>
						<div class="swiper-button-prev btn-n-b"></div> -->
						<?php
					$post_data=$db->get_cur_data("*","tbl_product","title_link='".$proid."'");
					$pro_id = $post_data[0];
					?>
						<div class="img-box-big imgBox3">
							<img src="admin/<?php echo $post_data[6]; ?>" alt="Product">
						</div>
						<input hidden type="text" id="txt-pro-id" name="txt-pro-id" value="<?php echo $post_data[0]; ?>">
							<?php
						?>
						<div class="swiper-container3 small-box">
							<div class="swiper-wrapper">
							<!--insert table img-->
								<?php
								$post_data=$db->select_data("*","tbl_product_img","pro_id='".$pro_id."'","id DESC","0,8");
								// $post_data=$db->get_cur_data("*","tbl_product_img","pro_id='".$newid."'");
								if($post_data != 0){
								foreach($post_data as $row){
								?>
								<div class="swiper-slide box3" target="imgBox3">
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
					$post_data=$db->get_cur_data("*","tbl_product","title_link='".$proid."'");
					?>
					<div class="col-xl-6 col-md-6 col-12 detail-box">
						<div class="item-title-box">
							<h2>JBL</h2>
							<h1><?php echo $post_data[3]; ?></h1>
							<div class="sub-title">Detial Powerful Bluetooth party speaker with full panel light effects</div>
						</div>
						<div class="price-box">
							<span class="price">$<?php echo $post_data[12]; ?></span> <span class="old-price">$<?php echo $post_data[16]; ?></span>
						</div>
						<div class="color-box">

						</div>
						<!--Share to Social-->
						<div class="share">

						</div>
						<!--end Share to Social-->
					</div>
				</div>
			</div>
			<div class="col-xl-12 col-md-12 col-12 product-detail">
				<div class="container line-01">
						Specs & Support
				</div>

				<!--strip_tags()-->
				<?php echo $post_data[4]; ?>


			</div>
		<?php
?>
<script>
	//


	//item box
	var swiper = new Swiper('.swiper-container3', {
      slidesPerView: 6,
      spaceBetween: 3,
      slidesPerGroup: 6,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination3',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

	//click on item
	$('.box3 img').click(function(e){
		e.preventDefault();
		$('.imgBox3 img').attr('src', $(this).attr('src'));
	})

</script>
