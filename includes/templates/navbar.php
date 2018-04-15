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
			<a class="navbar-brand" href="#" >محمصة الدبش</a>
		  </div>
	  
		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
			<?php  if(!isset($_SESSION['user']) && !isset($_SESSION['user2']) ) { ?>
				  <li>
						<a  data-toggle="modal" data-target="#myModal"> <i class="fa fa-sign-in ">
					</i> تسجيل الدخول</a>
				  </li>
			<?php } else { ?>
					<li>
						<a  href="logout.php"> <i class="fa fa-sign-out">
						</i> تسجل الخروج</a>
				  </li>
					<li style="border-right:1px solid #000; border-left:1px solid #000;">
						<a><?php if(isset($_SESSION['user'])){ echo "المدير";} else { echo "المشرف";} ?></a>
				  </li>
					<li>
						<a href="<?php if(isset($_SESSION['user'])){ echo "dashboard.php";} else { echo "dashboard2.php";} ?>">لوحة التحكم</a>
				  </li>
				
					
			</ul>
			
			</div><!-- /.navbar-collapse -->
			



					<?php } //end else ?>


			
		</div><!-- /.container-fluid -->
	  </nav>
<!-- End Navbar -->