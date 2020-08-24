<div class="logo">
	<a href="#"><img src="img/logo.png" alt="logo"></a>
</div>
<div class="col-lg-10 col-xl-10 col-12 ">
	<div class="row">
		<div class="col-lg-8">

		</div>
		<div class="col-lg-3 search-box">
			<div class="row corp">
				<div class="ya-search">
					<input type="text" name="search" id="search" class="ya-search" placeholder="Search">
					<button hidden type="submit" class="btn btn-search fa fa-search"></button>
					<div id="back-result"></div>
				</div>
<?php
	// // Login
	// session_start();
	// if(!isset($_SESSION['email'])){
	// 	// header('Location: index.php');
	// }
	// $email = $_SESSION['email'];
	// $utype = $_SESSION['user_type'];
	//echo $utype;
?>
				<div class="log-in">
					<a href="#" id="btn-login">Log In</a>
					<a href="logout.php" id="btn-logout">Log out</a>
				</div>
				<!-- <div class="utype" name="txt-utype"><?php echo $utype; ?></div> -->
				

			</div>


		</div>
		<div hidden class="login-name">
			yes i can doit
		</div>
	</div>


</div>

	<button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse menu" id="navcol-1">
		<ul class="nav navbar-nav">
			<?php
				$post_data=$db->select_data("name,id","tbl_category","status=1 && location=1","od DESC ","0,10");
				if($post_data != '0'){
					foreach($post_data as $row){
						$menu_color="#000";
						if($row[1] == $menuid){
							$menu_color="#eee; background-color: #fa4616;";
							$bg_color="#fa4616";

						}
						?>
							<li role="presentation" class="nav-item">
								<a href="<?php echo $row[1]; ?>" class="nav-link active" id="home" style="color:<?php echo $menu_color; ?>">
									<?php echo $row[0]; ?>
								</a>
							</li>
						<?php
					}
				}
			?>
		</ul>
</div>


<!-- <form lass="col-xl-2 col-4 search-box sample one">
  <input type="text" class="ya-btn" name="search" placeholder="Search..">
	<button type="submit" class="fa fa-search"></button>
</form> -->
