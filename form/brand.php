<div class="container-fluid brand-logo">
	<div class="container">
		<div class="row brand-box">
			<ul>
				<?php
					$post_data=$db->select_data("*","tbl_brand","status=1","id DESC","0,100");
						if($post_data != '0'){
							foreach($post_data as $row){
					?>
				<li>
					<a href="#"><img src="admin/<?php echo $row[3]; ?>" alt="brand" class="img-logo"></a>
				</li>

					<?php
						}
					}
				?>		
			</ul>
		</div>
	</div>
</div>






<!--
<div class="container-fluid brand-logo">
		<div class="container ">
			<div class="row">
				<div class="swiper-container2 brand-box">
					<div class="swiper-wrapper">
				<?php
					$post_data=$db->select_data("*","tbl_brand","status=1","id DESC","0,100");
						if($post_data != '0'){
							foreach($post_data as $row){
		 ?>
						<div class="swiper-slide ico-brand">
							<img src="admin/<?php echo $row[3]; ?>" alt="Slide">
						</div>
						
				<?php
					}
				}
		?>		
						</div>			
			</div>
		</div>
	</div>
</div>
-->
