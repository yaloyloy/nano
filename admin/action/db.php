<?php
	// session_start();
	class Database{
		public $cn;
		public $last_id;
		private function connect(){
			// $this->cn=new MySQLi("localhost","megateam_nano","16629060","megateam_nano");
			$this->cn=new MySQLi("localhost","root","","nanosound");
			$this->cn->set_charset("utf8");
		}

		protected function save_data($tbl,$val){
			$this->connect();
			$sql="INSERT INTO ".$tbl." VALUES(".$val.")";
			$this->cn->query($sql);
			$this->last_id = $this->cn->insert_id;
		}

		protected function delData($tbl,$con){
			$this->connect();
			$sql="DELETE FROM ".$tbl." WHERE ".$con."";
			$this->cn->query($sql);
		}

		protected function edit_data($tbl,$fld,$con){
			$this->connect();
			$sql="UPDATE ".$tbl." SET ".$fld." WHERE ".$con."";
			$this->cn->query($sql);
		}

		protected function dplData($fld,$tbl,$con){
			$this->connect();
			$sql="SELECT ".$fld." FROM ".$tbl." WHERE ".$con."";
			$result=$this->cn->query($sql);
			$num=$result->num_rows;
			if($num>0){
				return true;
			}else{
				return false;
			}
		}

		protected function countData($tbl,$con){
			$this->connect();
			$sql="SELECT COUNT(*) AS total FROM ".$tbl." WHERE ".$con."";
			$result=$this->cn->query($sql);
			if($result->num_rows>0){
				$row=$result->fetch_array();
				return $row[0];
			}
			return 0;
		}

		protected function selectData($fld,$tbl,$con,$od,$limit){
			$this->connect();
			$data=array();
			$sql="SELECT ".$fld." FROM ".$tbl." WHERE ".$con." ORDER BY ".$od." LIMIT ".$limit."";
			$result= $this->cn->query($sql);
			$num=$result->num_rows;
			if($num>0){
				while($row=$result->fetch_array()){
					$data[]=$row;
				}
				return $data;
			}else{
				return '0';
			}
		}

		protected function select_cur_data($fld,$tbl,$con){
			$this->connect();
			$sql="SELECT ".$fld." FROM ".$tbl." WHERE ".$con."";
			$result= $this->cn->query($sql);
			if($result->num_rows>0){
				$row=$result->fetch_array();
				return $row;
			}
			return '0';
		}

		protected function getAutoId($fld,$tbl,$con,$od){
			$this->connect();
			$sql="SELECT ".$fld." FROM ".$tbl." WHERE ".$con." ORDER BY ".$od."";
			$result=$this->cn->query($sql);
			if($result->num_rows>0){
				$row=$result->fetch_array();
				return $row[0];
			}else{
				return 0;
			}
		}

		//realescap string
		function real_string($str){
			$this->connect();
			return $this->cn->real_escape_string($str);
		}

		public function php_slug($string){
			$slug=trim($string);
			$slug=preg_replace("#(\p{P}|\p{C}|\p{S}|\p{Z})+#u", "-", $string);
			//lowercase
			$slug=strtolower($slug);
			return $slug;

		}
		//format data post
		public function get_post_date($time,$date){
			$previousTimeStamp = strtotime($time." ".$date);
			$lastTimeStamp = strtotime(date("Y-m-d h:i:sa"));
			$menos=$lastTimeStamp-$previousTimeStamp;
			$mins=$menos/60;
			if($mins<1){
			$showing= "ទើបបញ្ចូល";
			}
			else{
			$minsfinal=floor($mins);
			$secondsfinal=$menos-($minsfinal*60);
			$hours=$minsfinal/60;
			if($hours<1){
			$showing= $minsfinal . " នាទីមុន";
			}
			else{
			$hoursfinal=floor($hours);
			$minssuperfinal=$minsfinal-($hoursfinal*60);
			$days=$hoursfinal/24;
			if($days<1){
			$showing= $hoursfinal . " ម៉ោងមុន";
			}
			else if($days<2)
			{
			$showing=" ម្សិលមិញ ម៉ោង ".$time;
			}
			else{
			$d=date("d",strtotime($date));
			$m=date("m",strtotime($date));
			$y=date("Y",strtotime($date));
			if($m==1)
			{
				$m='មករា';
			}
			else if($m==2)
			{
				$m='កុម្ភៈ';
			}
			else if($m==3)
			{
				$m='មីនា';
			}
			else if($m==4)
			{
				$m='មេសា';
			}
			else if($m==5)
			{
			$m='ឧសភា';
			}
			else if($m==6)
			{
			$m='មិថុនា';
			}
			else if($m==7)
			{
			$m='កក្តដា';
			}
			else if($m==8)
			{
			$m='សីហា';
			}
			else if($m==9)
			{
			$m='កញ្ញា';
			}
			else if($m==10)
			{
			$m='តុលា';
			}
			else if($m==11)
			{
			$m='វិច្ឆិកា';
			}
			else if($m==12)
			{
			$m='ធ្នូ';
			}

			$showing=$d."-".$m."-".$y ." - ម៉ោង ". $time;
			}}}
			echo $showing;
		}

		//Category
		public function get_category($fld,$tbl,$con,$od,$limit){
			//$post_data=$db->select_data("*","tbl_category","status=1 && location=1","od","0,100");
			$post_data=$this->select_data($fld,$tbl,$con,$od,$limit);
			if($post_data != '0'){
				foreach($post_data as $row){
					?>
						<div class="col-xl-6 col-lg-6 col-md-3 col-12 main-box">
							<div class="cate-box">
								<a href="<?php echo $row[0]; ?>">
									<img src="admin/<?php echo $row[2]; ?>" alt="">
								</a>
								<div class="cate-title-box"><?php echo $row[1]; ?></div>
							</div>
						</div>
					<?php
				}
			}
		}

		//get content
		public function get_content_pro($fld,$tbl,$con,$od,$limit){

			$post_data=$this->select_data($fld,$tbl,$con,$od,$limit);
			if($post_data != '0'){
				foreach($post_data as $row){
			?>
				<div class="col-xl-3 col-md-3 col-6 box-4">
					<div class="product-content btn15">
						<div class="ovrly"></div>
              <div class="buttons">
								<div id="view" class="fas fa-eye" data-view="<?php echo $row[0]; ?>"></div>
								<div id="addCart" class="fas fa-cart-arrow-down"></div>
              </div>
						<div class="img-box">
								<img src="admin/<?php echo $row[6]; ?>">
						</div>
						<div class="item-box-desc">
							<div class="item-title">
								<a href="<?php echo $row[1]; ?>/<?php echo $row[8]; ?>"><?php echo $row[3]; ?></a>
							</div>
			
							<div class="item-price">$
							<?php
								if(!isset($_SESSION['email'])){
									// header('Location: index.php');
								}
								$email = $_SESSION['email'];
								$utype = $_SESSION['user_type']; 
								//$price=$_POST[$utype];
								
								if($utype == ''){
									echo $row[12];	
								}else if($utype == 'admin'){
									echo $row[13];
								}else if($utype == 'client'){
									echo $row[14];
								}else if($utype == 'client'){
									echo $row[15];
								}

								?>
							</div>

							<div class="item-old-price">$<?php echo $row[16]; ?></div>
						</div>
					</div>
				</div>
					<?php

				}
			}
		}

	}
?>
