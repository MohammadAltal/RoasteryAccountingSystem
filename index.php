<?php
	session_start();
	include "init.php";
	include $templates."header.php";
	include $templates."navbar.php";
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		$Username = $_POST['user'];
		$password = $_POST['pass'];
		if($Username=="root" && $password=="root"){
			$_SESSION['user']= $Username; 
			header('Location: index.php');
		}
		elseif($Username=="user2" && $password=="user2"){
			$_SESSION['user2']= $Username; 
			header('Location: index.php');
		}
	
	
}
	
?>

<!-- Start body page -->
		<div class="container-fluid body-page">
			<div class="body-page-inside text-center">
				<p>أفخر أنواع الموالح والقلوبات والمكسرات
					<br>
					<span>دمشق - ركن الدين - مقابل أفران ابن العميد</span>
				</p>
				
			</div>
		</div>
<!-- End body page -->


<!-- Start Product Area -->
		<div class="product-area">
			<div class="container">
					<hr class="custom-hr">	<h1 class="text-center">منتجاتنا</h1><hr  class="custom-hr">

					<!-- Start Items Box -->
								<div class="items-box">
									<div class="row">

										<?php 
										$items =  getAllFrom("item");
										foreach($items as $item)
										 {PrintItem($item['Name'],$item['Price'],$item['image']);}
										?>
			
									</div> <!-- End Div row -->
								</div> <!-- End Div items-box -->
					<!-- End Items Box -->
			</div> <!-- End Div container -->
		</div> <!-- End Div product-area -->

<!-- End Product Area -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
			
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title text-center">تسجيل الدخول</h4>
					</div>
					<div class="modal-body">
						<form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
							<input class="form-control input-lg" type="text" name="user" placeholder="اسم المستخدم" autocomplete="off"> 
							<input class="form-control input-lg" type="password" name="pass" placeholder="كلمة المرور" autocomplete="new-password">
							<input class="btn btn-block btn-success btn-lg" type="submit" value="تسجيل الدخول">	
						</form>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">خروج</button>
					</div>
				</div>
				
			</div>
		</div>
		<!-- End Modal -->



<?php
	include $templates."footer.php";
?>

