<?php 

session_start();
$active="employee";

if(isset($_SESSION['user'])){
    include "init.php";
    include $templates."header.php";
    include $templates."navbar-manager.php";

    if(isset($_GET['action'])){
		$action = $_GET['action']; 
	}
	else {
		$action = 'manage';
    }
    // BreadCrumb
    $link=array(array("link"=>"dashboard.php","name"=>"لوحة التحكم"),
    array("link"=>"employee.php","name"=>"العاملين"));

    if($action == 'manage'){
        $emps = getAllFrom("employee e INNER JOIN person p ON e.id_person = p.id");
        echo '<div class="container container-box">';
         if(empty(!$emps)){
            echo '<div class="row ">'; 
            foreach($emps as $emp){          
            echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 pull-right">';
                echo '<div class="emp">';
                        echo "<img src='layout/img/boy-4.png' class='img-responsive img-circle center-block'>";
                    echo '<ul class="list-unstyled">';
                    echo "<a href='?action=profile&id=";
                    echo $emp['id'];
                    echo "'>";
                    echo '<li class="text-center">';
                    echo $emp['Name'];
                    echo '</li>';
                    echo "</a>";

                            echo '<li>';
                            echo $emp['Address']." :<span>العنوان</span>";
                            echo '</li>';

                            echo '<li>';
                            echo $emp['Phone']." :<span>الهاتف</span>";
                            echo '</li>';

                            echo '<li>';
                            echo $emp['salary']." :<span>الراتب الاسبوعي</span>";
                            echo '</li>';

                            echo '<li>';
                            echo $emp['S_date']." :<span>تاريخ بدء العمل</span>";
                            echo '</li>';

                            echo '<li>';
                            echo $emp['Balance']." :<span>الذمة</span>";
                            echo '</li>';


     

                            if(isset($_SESSION['user'])){
                                echo '<li class="text-center">';
                                echo "<a href='?action=delete&empid=".$emp['id_person']."' class='btn btn-danger'>Delete <i class='fa fa-close'></i></a>";
                                echo "<a href='?action=edit&empid=".$emp['id_person']."' class='btn btn-info'>Edit <i class='fa fa-edit'></i></a>";
                                echo '</li>';
                            }
                        echo'</ul>';
                    echo '</div>';
                echo '</div>';
            } // end for
            echo '</div> <!-- End Div row -->';
            echo '<div class="add-emp pull-right">';
                echo '<a href="?action=advance_payment" class="btn btn-warning btn-lg">';  
                echo 'إضافة سلفة';
                echo "</a>";

                echo '<a href="?action=addcash" class="btn btn-success btn-lg" style="margin-left:10px;">';  
                echo 'إضافة دفعة نقدية';
                echo "</a>";

                echo '<a href="?action=add" class="btn btn-primary btn-lg" style="margin-left:10px;">';  
                echo 'إضافة عامل';
                echo "</a>";
            echo "</div>";
        } // end if 
        else {
            echo '<div class="text-center no-emp">';
                echo "<h1>لا يوجد عاملين لعرضهم</h1>";
                echo '<hr class="custom-hr">';
                echo '<a href="?action=add" class="btn btn-primary">';  
                echo 'إضافة عامل';
                echo "</a>";
            echo '</div>';
        }
        echo '</div> <!-- End Div container -->';
    
    } // end if($action == 'manage')
    elseif($action == 'add'){ 
              // To AutoBreadcrumb
              array_push($link,array('link'=>'#','name'=>'إضافة عامل')); ?>
    <div class="information block">
     	<div class="container container-box">
     	<div class="panel panel-default">
     		<div class="panel-heading">إضافة عامل جديد</div>
     		   <div class="panel-body">
                 <div class="row">
                 <div class=" col-md-4">
                        <div class="thumbnail emp emp-add live-preview">
                            
                            <img src="layout/img/boy-4.png" class="img-responsive img-circle" />
                            <ul class="list-unstyled">
                            <li class="text-center">
                               <span class="name-emp">الاسم</span>
                            </li>

                            <li>
                             <span class="address"></span> :<span>العنوان</span>
                            </li>

                            <li>
                             <span class="phone"></span> :<span>الهاتف</span>
                            </li>

                            <li>
                            <span class="salary"></span> :<span>الراتب الاسبوعي</span>
                            </li>


                        </ul>
                        </div>
                   </div>
                 
                   <div class="col-md-8">
                     <form class="form-horizontal" method="POST" action="?action=insert">
      <!-- Start Name -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9 control-label">الاسم</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="name" class="form-control live-name" 
               required="required">
            </div>
          </div>
      <!-- End Name -->

      <!-- Start Address -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9  control-label">العنوان</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="address" class="form-control live-address"   required="required">
            </div>
          </div>
      <!-- End Address -->

      <!-- Start Phone -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9  control-label">الهاتف</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="phone" class="form-control live-phone"  required="required">
            </div>
          </div>
      <!-- End Phone -->

      <!-- Start Salary -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9  control-label">الراتب الاسبوعي</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="salary" class="form-control live-salary"  required="required">
            </div>
          </div>
      <!-- End Salary -->

      <!-- Start S_date -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9 control-label">تاريخ بدء العمل</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="date" name="s_date" class="form-control"  required="required">
            </div>
          </div>
      <!-- End S_date -->


      <!-- Start Submit -->
        
          <div class="form-group form-group-lg">
            <div class="col-sm-9">
              <input type="submit" value="إضافة عامل"  class="btn btn-success btn-lg btn-block">
            </div>
          </div>
        
      <!-- End Submit -->
        </form>
    </div>
                </div>
  
    <?php } // end if($action == 'add')
    elseif($action == 'insert'){
         //Process Data From Add Item
         if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // get the variable from form 
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $salary = $_POST['salary'];
            $s_date = $_POST['s_date'];

            //    echo $name.'  '.$phone.'  '.$address.'  '.$salary.'  '.$s_date;
            // Validate The Form
            
            $formErrors = array();

            if(empty($formErrors)){

                $lastID= getLastRecord("id","person","id");
                $id = $lastID['id']+1;

                echo '       '.$id;

                // Insert into database
      
                $stmt = $con->prepare("INSERT INTO 
                  person(id,Name,Address,Phone)
                  VALUES(:ID , :name , :address , :phone)");
                $stmt->execute(array(
                  'ID' => $id ,
                  'name' => $name,
                  'address' => $address,
                  'phone' => $phone
                  )); 
                
                $stmt2 = $con->prepare("INSERT INTO 
                  employee(S_date , salary , id_person)
                  VALUES(:sdate  , :SSalary , :id_p)");
                $stmt2->execute(array(
                  'sdate' => $s_date ,
                  'SSalary'=> $salary,
                  'id_p'  => $id
                  )); 

                  if($stmt && $stmt2) {
                   header('Location: employee.php');
                  }
                 }
          }

    } // end elseif($action == 'insert')
    elseif($action == 'delete'){
        // Start Procedural To Delete Item

        $empid=$_GET['empid'] && is_numeric($_GET['empid']) ?intval($_GET['empid']) : header('Location:employee.php');

		
		 
		$stmt1 = $con->prepare("SELECT * FROM employee WHERE id_person = ? LIMIT 1");
     	$stmt1->execute(array($empid));
        $count1 = $stmt1->rowCount();
         
        $stmt2 = $con->prepare("SELECT * FROM person WHERE id = ? LIMIT 1");
     	$stmt2->execute(array($empid));
     	$count2 = $stmt2->rowCount();
     	
     	if($count1 > 0 && $count2 > 0){

     		$stmt1 = $con->prepare("DELETE FROM employee WHERE id_person = :id");
     		$stmt1->bindParam(":id" ,$empid );
            $stmt1->execute();
             
            $stmt2 = $con->prepare("DELETE FROM person WHERE id = :id");
     		$stmt2->bindParam(":id" ,$empid );
     		$stmt2->execute();

            header('Location: employee.php');
     	}
    } // end ($action == 'delete')

    elseif($action == 'edit'){

        if(isset($_GET['empid']) && is_numeric($_GET['empid'])){
          $empid = $_GET['empid']; 
        } else {
            header('Location: employee.php');
        } 

        // To AutoBreadcrumb
        array_push($link,array('link'=>'#','name'=>'تعديل بيانات'));

        // get the info from Database 
        $emp = getOneRecord("*","employee e INNER JOIN person p ON e.id_person = p.id","e.id_person",$empid);
        ?> 

<div class="information block">
     	<div class="container container-box">
     	<div class="panel panel-default">
     		<div class="panel-heading"> تعديل بيانات | <?php echo $emp['Name']; ?> </div>
     		   <div class="panel-body">
                 <div class="row">
                 <div class=" col-md-4">
                        <div class="thumbnail emp emp-add live-preview">
                            
                            <img src="layout/img/boy-4.png" class="img-responsive img-circle" />
                            <ul class="list-unstyled">
                            <li class="text-center">
                               <span class="name-emp"> <?php echo $emp['Name']; ?></span>
                            </li>

                            <li>
                             <span class="address"> <?php echo $emp['Address']; ?></span> :<span>العنوان</span>
                            </li>

                            <li>
                             <span class="phone"> <?php echo $emp['Phone']; ?></span> :<span>الهاتف</span>
                            </li>

                            <li>
                            <span class="salary"> <?php echo $emp['salary']; ?></span> :<span>الراتب الاسبوعي</span>
                            </li>


                        </ul>
                        </div>
                   </div>
                 
    <div class="col-md-8">
        <form class="form-horizontal" method="POST" action="?action=update">
        <input type="hidden" name="empid" value="<?php echo $empid; ?>">
      <!-- Start Name -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9 control-label">الاسم</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="name" class="form-control live-name" 
               required="required" 
               value=" <?php echo $emp['Name']; ?>">
            </div>
          </div>
      <!-- End Name -->

      <!-- Start Address -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9  control-label">العنوان</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="address" class="form-control live-address"   required="required"
              value=" <?php echo $emp['Address']; ?>">
            </div>
          </div>
      <!-- End Address -->

      <!-- Start Phone -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9  control-label">الهاتف</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="phone" class="form-control live-phone"
              value=" <?php echo $emp['Phone']; ?>">
            </div>
          </div>
      <!-- End Phone -->

      <!-- Start Salary -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9  control-label">الراتب الاسبوعي</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="salary" class="form-control live-salary"  required="required"
              value=" <?php echo $emp['salary']; ?>">
            </div>
          </div>
      <!-- End Salary -->

      <!-- Start S_date -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9 control-label">تاريخ بدء العمل</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="date" name="s_date" class="form-control"
              value="<?php echo $emp['S_date']; ?>">

              <input type="text" name="s_date2" class="form-control hidden" 
              value=" <?php echo $emp['S_date']; ?>">
            </div>
          </div>
      <!-- End S_date -->


      <!-- Start Submit -->
        
          <div class="form-group form-group-lg">
            <div class="col-sm-9">
              <input type="submit" value="تعديل"  class="btn btn-success btn-lg btn-block">
            </div>
          </div>
        
      <!-- End Submit -->
     
        </form>
    </div>
                </div>

   <?php } // end  elseif($action == 'edit') advance_payment

   elseif ($action == 'advance_payment') { 
        // To AutoBreadcrumb
        array_push($link,array('link'=>'#','name'=>'إضافة سلفة'));?>

     <div class="container container-box">
       <form class="form-horizontal" method="POST" action="?action=insert_advance&type=take">
                <!-- Start Value -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">المبلغ</label>
                        <div class="col-sm-5 ">            
                            <input type="number"
                                name="value"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End Value -->
                <!-- Start vip -->
                <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">اسم العامل</label>
                        <div class="col-sm-5 ">            
                            <select name="emp" class="form-control">
                                <option value="0">...</option>
                                <?php
                                    $users = query("select e.* , p.Name From employee e INNER JOIN person p on p.id = e.id_person");
                                    foreach ($users as $user ) {
                                        echo "<option value='".$user['id']."'>".$user['Name']."</option>";	
                                    }
                                ?>
                            </select>
                        </div>
                    </div>  		
                <!-- End vip -->

                <!-- Start Date -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">التاريخ</label>
                        <div class="col-sm-5 ">            
                            <input type="date"
                                name="date"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End Date -->
                <!-- Start Submit -->            
                     <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-7">
                                <input type="submit"
                                        value="إضافة سلفة" 
                                        class="btn btn-success btn-block">
                            </div>
                    </div> 
                <!-- End Submit -->
              </form>
              </div>
       
   <?php } // end elseif ($action == 'advance_payment')

   elseif($action == 'addcash'){ 
        // To AutoBreadcrumb
        array_push($link,array('link'=>'#','name'=>'إضافة دفعة نقدية'));?>
       <div class="container container-box">
       <form class="form-horizontal" method="POST" action="?action=insert_advance&type=give">
                <!-- Start Value -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">المبلغ</label>
                        <div class="col-sm-5 ">            
                            <input type="number"
                                name="value"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End Value -->
                <!-- Start vip -->
                <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">اسم العامل</label>
                        <div class="col-sm-5 ">            
                            <select name="emp" class="form-control">
                                <option value="0">...</option>
                                <?php
                                    $users = query("select e.* , p.Name From employee e INNER JOIN person p on p.id = e.id_person");
                                    foreach ($users as $user ) {
                                        echo "<option value='".$user['id']."'>".$user['Name']."</option>";	
                                    }
                                ?>
                            </select>
                        </div>
                    </div>  		
                <!-- End vip -->

                <!-- Start Date -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">التاريخ</label>
                        <div class="col-sm-5 ">            
                            <input type="date"
                                name="date"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End Date -->
                <!-- Start Submit -->            
                     <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-7">
                                <input type="submit"
                                        value="إضافة دفعة نقدية" 
                                        class="btn btn-success btn-block">
                            </div>
                    </div> 
                <!-- End Submit -->
              </form>
              </div>

   <?php } // end elseif($action == 'addcash')

   elseif($action == 'insert_advance'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_GET['type'])){
            $type = $_GET['type'];
        } 
        if($type == 'take'){
            $value  = $_POST['value'];
            $emp    = $_POST['emp'];
            $date   = $_POST['date'];
          //  echo $value.'  '.$emp.'  '.$date;

        // Validate The Form
        $formErrors = array();
        if(empty($formErrors)){
                // Insert into database
                $stmt = $con->prepare("INSERT INTO 
                advance_payment(Value,Date,Type,emp_id)
                VALUES(:val , :date , 0, :emp)");
                $stmt->execute(array(
                'val' => $value,
                'date' => $date,
                'emp' => $emp
            ));

            // Update Balance Employee
            $old_balance = getOneRecord("Balance", "employee" , "id" ,$emp );
    
            $new_balance = $old_balance['Balance'] + $value; 
            
            $stmt1 = $con->prepare("UPDATE employee SET Balance =? WHERE id = ?");
            $stmt1->execute(array($new_balance,$emp));
            if($stmt && $stmt1){
                header("Location: employee.php");   
            }
        } // end if(empty($formErrors))

        } // end  if($type == 'take')
        elseif($type == 'give'){
            $value  = $_POST['value'];
            $emp    = $_POST['emp'];
            $date   = $_POST['date'];
         //   echo $value.'  '.$emp.'  '.$date;

        // Validate The Form
        $formErrors = array();
        if(empty($formErrors)){
                // Insert into database
                $stmt = $con->prepare("INSERT INTO 
                advance_payment(Value,Date,Type,emp_id)
                VALUES(:val , :date , 1, :emp)");
                $stmt->execute(array(
                'val' => $value,
                'date' => $date,
                'emp' => $emp
            ));

            // Update Balance Employee
            $old_balance = getOneRecord("Balance", "employee" , "id" ,$emp );
    
            $new_balance = $old_balance['Balance'] - $value; 
            
            $stmt1 = $con->prepare("UPDATE employee SET Balance =? WHERE id = ?");
            $stmt1->execute(array($new_balance,$emp));
            if($stmt && $stmt1){
                header("Location: employee.php");   
            }
        } // end if(empty($formErrors))
        } // end elseif($type == 'give')

      } // end  if($_SERVER['REQUEST_METHOD'] == 'POST')
    } // end elseif($action == 'insert_advance')

   elseif($action == 'update'){
            //Process Update 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // get the variable from form 
            $id = $_POST['empid'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $salary = $_POST['salary'];
            $s_date = $_POST['s_date'];
            $s_date2 = $_POST['s_date2'];
            
            // Trick Date
            if(empty($s_date)){
                $s_date = $s_date2;
            }

            // Validate The Form 
            $formErrors = array(); 

            if(empty($formErrors)){
                    // update the database
                    $stmt1 = $con->prepare("UPDATE employee SET
                                S_date =?, salary =?
                                WHERE id_person = ?");
                    $stmt1->execute(array($s_date,$salary,$id));

                    $stmt2 = $con->prepare("UPDATE person SET
                                Name =?, Address =? , Phone=?
                                WHERE id = ?");
                    $stmt2->execute(array($name,$address,$phone ,$id));

                    if($stmt1 && $stmt2) {
                       header('Location: employee.php');
                    }
                } }

   } // end elseif($action == 'update')
   elseif ($action == 'profile') {
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id = $_GET['id']; 
      } else {
        $id =0;
      }


      // get info vip
      $stmt1 = $con->prepare("SELECT p.* , e.Balance FROM employee e inner join person p on p.id = e.id_person and  p.id =? LIMIT 1");
      $stmt1->execute(array($id));
      $info = $stmt1->fetch();
      
        // To AutoBreadcrumb
        array_push($link,array('link'=>'#','name'=>$info['Name']));
        // get bills vip
        $stmt2 = $con->prepare("SELECT ad.* FROM advance_payment ad inner join employee e inner join person p on ad.emp_id= e.id and e.id_person = p.id and ad.type=0 and p.id =? order by ad.id DESC");
        $stmt2->execute(array($id));
        $advance_payment = $stmt2->fetchAll();

        // get cash vip
        $stmt3 = $con->prepare("SELECT ad.* FROM advance_payment ad inner join employee e inner join person p on ad.emp_id= e.id and e.id_person = p.id and ad.type=1 and p.id =? order by ad.id DESC");
        $stmt3->execute(array($id));
        $cash = $stmt3->fetchAll();

        EmpInfo($info , $advance_payment , $cash);

   } // end elseif ($action == 'profile')

     AutoBreadcrumb($link);  
    include $templates."footer.php";

} else {
    header('Location: index.php');
	exit(); 
}