<!-- Start Navbar -->
<nav class="navbar navbar-default">
		<div class="container">
		  <!-- Brand and toggle get grouped for better mobile display -->
		  <div class="navbar-header navbar-right">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php" >محمصة الدبش</a>
		  </div>
	  
		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">

                  <li class=" <?php setActive("service"); ?> ">
                    <a href="service.php">
                    <i class="fa fa-server">
                    </i> خدمات</a>
                  </li>
                  <li class=" <?php setActive("employee"); ?> ">
                    <a  href="employee.php">
                    <i class="fa fa-user">
                    </i> العاملين</a>
                  </li>
                  <li class=" <?php setActive("vip"); ?> ">
                    <a  href="vip.php">
                    <i class="fa fa-user-secret">
                    </i> التجار</a>
				          </li>
				         <li class=" <?php setActive("items"); ?> ">
                    <a  href="items.php">
                    <i class="fa fa-tag">
                    </i> المنتجات</a>
                  </li>
                  <li class=" <?php setActive("bill"); ?> ">
                    <a  href="bill.php">
                    <i class="fa fa-money">
                    </i> الفواتير</a>
                  </li>
                                    
		</div><!-- /.container-fluid -->
	  </nav>
<!-- End Navbar -->