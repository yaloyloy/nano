<?php
	include('../admin/action/action.php');
	$db=new Action;

?>	
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	
<style>
	.carousel {
    margin-top: 20px;
}
.item .thumb {
	width: 25%;
	cursor: pointer;
	float: left;
}
.item .thumb img {
	width: 100%;
	margin: 2px;
}
.item img {
	width: 100%;	
}

</style>
</head>
      <div class="container frm-view">
  <div class="row">
    <div class="col-sm-6 ">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    <img src="http://placehold.it/350x250/e8117f/fff&amp;text=Product+Main">
                </div>
                <div class="item">
                    <img src="http://placehold.it/350x250/00ffff/000&amp;text=Product+Image+2">
                </div>
               
            </div>
        </div> 
    <div class="clearfix">
        <div id="thumbcarousel" class="carousel slide" data-interval="false">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-target="#carousel" data-slide-to="0" class="thumb"><img src="http://placehold.it/100/e8117f/fff&amp;text=Product+Main"></div>
                    <div data-target="#carousel" data-slide-to="1" class="thumb"><img src="http://placehold.it/100/00ffff/000&amp;text=Product+Image+2"></div>
                    <div data-target="#carousel" data-slide-to="2" class="thumb"><img src="http://placehold.it/100/ff00ff/fff&amp;text=Product+Image+3"></div>
                    <div data-target="#carousel" data-slide-to="3" class="thumb"><img src="http://placehold.it/100/ffff00/000&amp;text=Product+Image+4"></div>
                </div><!-- /item -->
                <div class="item">
                    <div data-target="#carousel" data-slide-to="4" class="thumb"><img src="http://placehold.it/100/612b65/fff&amp;text=Product+Image+5"></div>
                    <div data-target="#carousel" data-slide-to="5" class="thumb"><img src="http://placehold.it/100/00ffcc/000&amp;text=Product+Image+6"></div>
                    <div data-target="#carousel" data-slide-to="6" class="thumb"><img src="http://placehold.it/100/db371b/fff&amp;text=Product+Image+7"></div>
                    <div data-target="#carousel" data-slide-to="7" class="thumb"><img src="http://placehold.it/100/feb8aa/000&amp;text=Product+Image+8"></div>
                </div><!-- /item -->
            </div><!-- /carousel-inner -->
            <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div> <!-- /thumbcarousel -->
    </div><!-- /clearfix -->
    </div> <!-- /col-sm-6 -->
    <div class="col-sm-6 pro-desc">
		<div class="title">JBL Sound bar 5.1 </div>
		<div class="sub-title">Powerful Bluetooth party speaker with full panel light effects</div>
		<span class="price">$299</span> <span class="old-price">$520</span>
		
        

    </div> <!-- /col-sm-6 -->
  </div> <!-- /row -->
</div> <!-- /container -->
