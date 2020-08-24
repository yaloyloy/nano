		//get content
<?php

			//$post_data=$this->select_data("*","tbl_product","status=1","od","0,16");
			$post_data=$this->select_data("*","tbl_product","$con","od","0,16");
			if($post_data != '0'){
				foreach($post_data as $row){
			?>
				<div class="col-xl-3 col-md-3 col-6 box-4">
					<div class="row product-content btn15">
						<div class="ovrly"></div>
                            <div class="buttons">
								<div id="view" class="fas fa-eye"></div>
								<div id="addCart" class="fas fa-cart-arrow-down"></div>
                            </div>
						<div class="img-box">
								<img src="admin/<?php echo $row[6]; ?>">
						</div>
						<div class="item-box-desc">
							<div class="item-title">
								<a href="?menuid=<?php echo $row[1] ;?>&pro=<?php echo $row[8];?>"><?php echo $row[3]; ?></a>
											<!--test .'-'.$row[0].'-'.$row[1] -->
							</div>
							<div class="item-price">$<?php echo $row[12]; ?></div>
						</div>
					</div>
				</div>
					<?php

				}
			} 
