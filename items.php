<?php 

session_start();
$active="items";

if(isset($_SESSION['user'])){
    include "init.php";
    include $templates."header.php";
    include $templates."navbar-manager.php";

    $action = '';
    $Messages = array();


	if(isset($_GET['action'])){
		$action = $_GET['action']; 
	}
	else {
		$action = 'manage';
  }
  
    $link=array(array("link"=>"dashboard.php","name"=>"لوحة التحكم"),
    array("link"=>"items.php","name"=>"المنتجات"));

    if($action == 'manage'){
       
        // Start Procedural To Delete Item
        $itemid=''; 
        if(isset($_GET['itemid']) && is_numeric($_GET['itemid'])){
         $itemid = $_GET['itemid']; 
         $stmt = $con->prepare("SELECT * FROM item WHERE id = ? LIMIT 1");
         $stmt->execute(array($itemid));
         $count = $stmt->rowCount();
         
          if($count > 0){
            $stmt = $con->prepare("DELETE FROM item WHERE id = :ID");
            $stmt->bindParam(":ID" ,$itemid );
            $stmt->execute();
            
            $Messages[]  = "<div class='alert alert-success container msg'>تم حذف المادة بنجاح</div>";
            
          } else{        
            $Messages[]  = "<div class='alert alert-danger container msg'>المادة ليست موجودة</div>";
            
          }}
          // End Procedural To Delete Item

?>



<div class="container container-box">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      
    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
      <div class="panel-heading">
        <h4 class="panel-title">إضافة منتج <i class="fa fa-plus"></i></h4>
      </div>
    </a>

    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
	      	<!-- Start Name -->
	  			<div class="form-group">			
          <label class="col-sm-3 col-sm-push-7 control-label text-center">اسم المادة</label>
	  				<div class="col-sm-5 ">            
	  					<input type="text" name="name" class="form-control" autocomplete="off" required="required">
            </div>   
	  			</div>  		
	      	<!-- End Name -->


          <!-- Start Low Limit -->
          <div class="form-group">			
          <label class="col-sm-3 col-sm-push-7 control-label text-center">الحد الأدنى من الكمية</label>
            <div class="col-sm-5 ">            
              <input type="text" name="limit" class="form-control" autocomplete="off" required="required">
            </div>   
          </div>  		
          <!-- End Low Limit -->

          <!-- Start Ammount -->
                <div class="form-group">			
          <label class="col-sm-3 col-sm-push-7 control-label text-center"> الكمية </label>
            <div class="col-sm-5 ">            
              <input type="text" name="ammount" class="form-control" autocomplete="off" required="required">
            </div>
          </div>  		
          <!-- End Ammount -->

          <!-- Start type -->
          <div class="form-group">			
            <label class="col-sm-3 col-sm-push-7 control-label text-center"> نوع المادة </label>
              <div class="col-sm-5 ">            
                      <select name="raw" class="form-control">
                          <option value="-1">...</option>
                          <option value="0">مادة أولية</option>
                          <option value="1">مادة غير أولية (تحتاج إلى تحميص)</option>
                      </select>
              </div>
            </div>  		
            <!-- End type -->

            <!-- Start Price -->
            <div class="form-group">			
            <label class="col-sm-3 col-sm-push-7 control-label ">السعر</label>
              <div class="col-sm-5 ">            
                <input type="text" name="price" class="form-control" autocomplete="off">
              </div>       
            </div>  		
          <!-- End Price -->
          
          <!-- Start Photo -->
          <div class="form-group">			
            <label class="col-sm-3 col-sm-push-7 control-label ">الصورة</label>
              <div class="col-sm-5 ">            
                <input type="file" name="image" class="form-control">
          </div>       
            </div>  		
          <!-- End Photo -->

          <!-- Start Submit -->
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                  <input type="submit" value="إضافة منتج"  class="btn btn-success btn-block">
                </div>
              </div>
          <!-- End Submit -->
        </form>
        
        </div> <!-- End Div panel-body -->
      </div> <!-- End Div panel-collapse collapse -->
    </div> <!-- End Div panel panel-default -->

    <?php

          //Process Data From Add Item
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
             
            // get the variable from form 
            $name = $_POST['name'];
            $limit = $_POST['limit'];
            $price = $_POST['price'];
            $ammount = $_POST['ammount'];
            $raw = $_POST['raw'];
            $img = '';

            // Validate The Form
            
            $formErrors = array();
            if(empty($name)){
              $formErrors[] = "الاسم لا يجب أن يكون فارغ";
            }
            if(empty($limit)){
              $formErrors[] = "الحد الادنى من الكمية يجب أن تكون ممتلئة";
            }
            if(empty($price)){
              $formErrors[] = "السعر لا يجب أن يكون فارغ";
            }
            if(!is_numeric($price)){
              $formErrors[] = "السعر يجب أن يكون رقم";
            }
            if(!is_numeric($limit)){
              $formErrors[] = "الحد الادنى من الكمية يجب أن تكون رقم";
            }
            if(!empty($imageName) && !in_array($Extension3,$imageExtention)){
              $formErrors[] = "الصورة غير مسموحة";
            }



            if(empty($formErrors)){

              // Check User In Database
      
              $check = checkItem("Name","item",$name);
              if($check == 1){
      
              echo "<div class='alert alert-danger'>المادة موجودة بالفعل</div>";
      
              }
              else{

                if(!empty($_FILES['image']['name'])){
                  // upload file
                  $imageName = $_FILES['image']['name'];
                  $imageSize = $_FILES['image']['size'];
                  $imageTmp = $_FILES['image']['tmp_name'];
                  $imageType = $_FILES['image']['type'];

                  
                 
                  // List OF Allowed File Uploaded 
                  $imageExtention = array("jpeg" , "png" , "jpg");

                  // Get image Extension 
                  $Extension1 = explode('.', $imageName);
                  $Extension2 = end($Extension1);
                  $Extension3 = strtolower($Extension2);
                  
                  $img = rand(0,1000000). "_".rand(0,1000000).".".$Extension3;
                  move_uploaded_file($imageTmp,"data\upload\item\\".$img);
                  } else{
                    $img = '';
                  }



                // Insert into database
      
                $stmt = $con->prepare("INSERT INTO 
                  item(Name,Low_Limit,Price,Ammount,Raw,image)
                  VALUES(:name , :limit , :price , :ammount, :raw , :img)");
                $stmt->execute(array(
                  'name' => $name,
                  'limit' => $limit,
                  'price' => $price,
                  'ammount'=>$ammount,
                  'raw'=>$raw,
                  'img'=> $img

                  )); 
                  if($stmt) {
                    $Messages[]  = "<div class='alert alert-success container msg'>تم إضافة المادة بنجاح</div>";
                  }
                } }
          }

    ?>
    <div class="panel panel-default">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
      <div class="panel-heading">
        <h4 class="panel-title">
            عرض جميع المنتجات <i class="fa fa-eye"></i>
        </h4>
      </div>
      </a>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">
        <div class="table-resposive">
        <?php 
                  $Allitems =  getAllFrom("item");
                  if(!empty($Allitems)) {
          ?>
				<table class="main-table table table-bordered text-center">
				  <tr>
				  	<td>ID</td>
				  	<td>اسم المادة</td>
                      <td>الكمية</td>
                      <td>السعر</td>
				  	<td>تعديل أو حذف</td>
				  </tr>

                  <?php
                  $style='';
                  
				  foreach ($Allitems as $row) {
                    if($row['Ammount']<$row['Low_Limit']){
                        $style="	background-color:   #990000;
                        color: #FFF;";
                    }
				  		echo "<tr style='$style'>";
				  			echo '<td>'.$row['id'].'</td>';
				  			echo '<td>'.$row['Name'].'</td>';
                              echo '<td>'.$row['Ammount'].'</td>';
                              echo '<td>'.$row['Price'].'</td>';
				  			echo "<td>
								<a href='items.php?action=edit&itemid=".$row['id']."' class='btn btn-success'><i class='fa fa-edit'></i> تعديل</a>
                <a href='items.php?action=manage&itemid=".$row['id']."' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف</a>";
				  				echo	"</td>";
                              echo '</tr>';
                              $style='';
                              
				  	
          } } // end foreach
          else{
            echo "<h4 class='text-center'>لا يوجد مواد لعرضها </h4>";
          }
         

				  
				  ?>
				 
			
				</table>	
        </div> 
   
    </div> <!-- End Div panel-body -->
      </div> <!-- End Div panel-collapse collapse -->
    </div> <!-- End Div panel panel-default -->
   

    <div class="panel panel-default">
    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
      <div class="panel-heading">
        <h4 class="panel-title">
          عرض المنتجات اللازم تأمينها <i class="fa fa-exclamation-triangle"></i>
        </h4>
      </div>
      </a>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
          <?php 
                  $items =  getAllFrom("item","where Ammount<Low_Limit");
                  if(!empty($items)){
          ?>
        <div class="table-resposive">
				<table class="main-table table table-bordered text-center">
				  <tr>
				  	<td>ID</td>
				  	<td>اسم المادة</td>
                      <td>الكمية</td>
                      <td>السعر</td>
				  </tr>

				  <?php

				  foreach ($items as $row) {
                   
				  		echo '<tr>';
				  			echo '<td>'.$row['id'].'</td>';
				  			echo '<td>'.$row['Name'].'</td>';
                echo '<td>'.$row['Ammount'].'</td>';
                echo '<td>'.$row['Price'].'</td>';
              echo '</tr>';
				  	
          }}
          else{
            echo "<h4 class='text-center'>لا يوجد مواد لازمة حالياً</h4>";
          }
				  
				  ?>
				</table>	
		</div>
    </div> <!-- End Div panel-body -->
    </div> <!-- End Div panel-collapse collapse -->
  </div> <!-- End Div panel panel-default -->

  </div> 
</div>
                

   <?php      


            // Print Messages 
            if(!empty($formErrors)){
            foreach ($formErrors as $error) {
              echo "<div class='alert alert-danger container msg '>".$error."</div>";
              }}
              if(!empty($Messages)){
                foreach ($Messages as $Message) {
                  echo $Message;
                }}
   
    } /// end if($action == 'manage')


    elseif ($action=='edit') {

      array_push($link,array('link'=>'#','name'=>'تعديل منتج'));
      if(isset($_GET['itemid']) && is_numeric($_GET['itemid'])){
        $itemid = $_GET['itemid']; 
      } else {
        $itemid =0;
      } 
    
                //Process Update 
                if($_SERVER['REQUEST_METHOD'] == 'POST'){



                  // get the variable from form 
                  $id      = $_POST['itemid'];
                  $name    = $_POST['name'];
                  $limit   = $_POST['limit'];
                  $price   = $_POST['price'];
                  $ammount = $_POST['ammount'];
                  $image2  = $_POST['image2'];
                  $img='';

                  if(!empty($_FILES['image']['name'])){
                  // upload file
                  $imageName = $_FILES['image']['name'];
                  $imageSize = $_FILES['image']['size'];
                  $imageTmp = $_FILES['image']['tmp_name'];
                  $imageType = $_FILES['image']['type'];

                  
                 
                  // List OF Allowed File Uploaded 
                  $imageExtention = array("jpeg" , "png" , "jpg");

                  // Get image Extension 
                  $Extension1 = explode('.', $imageName);
                  $Extension2 = end($Extension1);
                  $Extension3 = strtolower($Extension2);

                  
                  $img = rand(0,1000000). "_".rand(0,1000000).".".$Extension3;
                  move_uploaded_file($imageTmp,"data\upload\item\\".$img);
                  } else{
                    $img = str_replace(' ','',$image2); 
                  }

             
      
                  // Validate The Form 
                  $formErrors = array();
                  if(empty($name)){
                    $formErrors[] = "الاسم لا يجب أن يكون فارغ";
                  }
                  if(empty($limit)){
                    $formErrors[] = "الحد الادنى من الكمية يجب أن تكون ممتلئة";
                  }
                  if(empty($price)){
                    $formErrors[] = "السعر لا يجب أن يكون فارغ";
                  }
                  if(!is_numeric($price)){
                    $formErrors[] = "السعر يجب أن يكون رقم";
                  }
                  if(!is_numeric($limit)){
                    $formErrors[] = "الحد الادنى من الكمية يجب أن تكون رقم";
                  }
                  if(!empty($imageName) && !in_array($Extension3,$imageExtention)){
                    $formErrors[] = "الصورة غير مسموحة";
                  }      
      
      
      
                  if(empty($formErrors)){
                                  
                          // update the database
                          $stmt = $con->prepare("UPDATE item SET
                                      Name =?, Price =? , Ammount =? , Low_Limit =? , image =?
                                      WHERE id = ?");
                          $stmt->execute(array($name,$price,$ammount,$limit,$img,$id));

                        if($stmt) {
                          $Messages[]  = "<div class='alert alert-success container msg'>تم تعديل المادة بنجاح</div>";

                        }
                      } }
                

      // Get Item From Table By ID
      $item = getOneRecord("*","item","id",$itemid);
      if($item==NULL){
        echo "<div class='alert alert-danger container msg update'>لا يوجد مادة تحمل هذا الرقم</div>";
      }
     /**/
      else{ ?>
      <div class="container update container-box">
            <form class="form-horizontal" method="POST" action=" ?action=edit&itemid=<?php echo $item['id'];?>" enctype="multipart/form-data">
            <input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
	  	<!-- Start Name -->
	  			<div class="form-group">			
          <label class="col-sm-3 col-sm-push-6 control-label text-center">اسم المادة</label>
	  				<div class="col-sm-4 ">            
	  					<input type="text" 
                     name="name" 
                     class="form-control"
                     value= "<?php echo $item['Name'] ?>"
                     autocomplete="off" 
                     required="required">
            </div>   
	  			</div>  		
	  	<!-- End Name -->

	  	<!-- Start Low Limit -->
      <div class="form-group">			
      <label class="col-sm-3 col-sm-push-6 control-label text-center">الحد الأدنى من الكمية</label>
        <div class="col-sm-4 ">            
          <input type="text"
                 name="limit"
                 class="form-control"
                 value= "<?php echo $item['Low_Limit'] ?>"
                 autocomplete="off"
                 required="required">
        </div>   
      </div>  		
      <!-- End Low Limit -->

      <!-- Start Ammount -->
      <div class="form-group center-block">			
        <label class="col-sm-3 col-sm-push-6 control-label text-center"> الكمية </label>
          <div class="col-sm-4 ">            
            <input type="text"
                  name="ammount"
                  class="form-control" 
                  value= "<?php echo $item['Ammount'] ?>"
                  autocomplete="off" 
                  required="required">
          </div>
      </div>  		
      <!-- End Ammount -->

	  	<!-- Start Price -->
      <div class="form-group">			
      <label class="col-sm-3 col-sm-push-6 control-label ">السعر</label>
        <div class="col-sm-4 ">            
          <input type="text"
                 name="price" 
                 class="form-control"
                 value= "<?php echo $item['Price'] ?>" 
                 autocomplete="off"
                 required="required">
        </div>       
      </div>  	
      
     <!-- End Price -->

    <!-- Start Photo -->
    <div class="form-group">			
      <label class="col-sm-3 col-sm-push-6 control-label ">الصورة</label>
        <div class="col-sm-4 ">            
          <input type   ="file"
                 name   ="image" 
                 class  ="form-control">
    </div>       
      </div>  	
      
      <input type="text" name="image2" class="form-control hidden" 
              value=" <?php echo $item['image']; ?>">

    <!-- End Photo -->

	  	<!-- Start Submit -->
	  		
	  			<div class="form-group">
	  				<div class="col-sm-offset-3 col-sm-6">
	  					<input type="submit" value="تعديل منتج"  class="btn btn-success btn-block">
	  				</div>
	  			</div>
	  		
	  	<!-- End Submit -->
	  		</form>
        </div> <!-- End Div Container -->

     <?php } // end else 
                 // Print Messages 
                 if(!empty($formErrors)){
                  foreach ($formErrors as $error) {
                    echo "<div class='alert alert-danger container msg '>".$error."</div>";
                    }}
                    if(!empty($Messages)){
                      foreach ($Messages as $Message) {
                        echo $Message;
                      }}
    }
    else{

         header('Location: items.php');
    }
    AutoBreadcrumb($link); 
    include $templates."footer.php";
} else {
    header('Location: index.php');
	exit(); 
} ?>