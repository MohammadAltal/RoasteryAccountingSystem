<?php 

session_start();
$active="vip";

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

    $link=array(array("link"=>"dashboard.php","name"=>"لوحة التحكم"),
    array("link"=>"vip.php","name"=>"التجار"));

    if($action == 'manage'){
        $vips = getAllFrom("vip v INNER JOIN person p ON v.id_person = p.id");
        echo '<div class="container container-box ">';
         if(empty(!$vips)){
            echo '<div class="row ">'; 
            foreach($vips as $vip){          
            echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 pull-right">';
                echo '<div class="emp vip">';
                        echo "<img src='layout/img/boy-1.png' class='img-responsive center-block'>";
                    echo '<ul class="list-unstyled">';
                            echo "<a href='?action=profile&id=";
                            echo $vip['id'];
                            echo "'>";
                            echo '<li class="text-center">';
                            echo $vip['Name'];
                            echo '</li>';
                            echo "</a>";

                            echo '<li>';
                            echo $vip['Address']." :<span>العنوان</span>";
                            echo '</li>';

                            echo '<li>';
                            echo $vip['Phone']." :<span>الهاتف</span>";
                            echo '</li>';

                            echo '<li>';
                            echo $vip['Balance']." :<span>الذمة</span>";
                            echo '</li>';

                            if(isset($_SESSION['user'])){
                                echo '<li class="text-center">';
                                echo "<a href='?action=delete&vipid=".$vip['id_person']."' class='btn btn-danger'>Delete <i class='fa fa-close'></i></a>";
                                echo "<a href='?action=edit&vipid=".$vip['id_person']."' class='btn btn-info'>Edit <i class='fa fa-edit'></i></a>";
                                echo '</li>';
                            }
                        echo'</ul>';
                    echo '</div>';
                echo '</div>';
            } // end for
            echo '</div> <!-- End Div row -->';
            echo '<div class="add-emp pull-right">';
            
                echo '<a href="?action=add" class="btn btn-primary btn-lg">';  
                echo 'إضافة تاجر';
                echo "</a>";
              

                echo '<a href="?action=addcash" class="btn btn-success btn-lg" style="margin-left:10px;">';  
                echo 'إضافة دفعة نقدية';
                echo "</a>";
            echo "</div>";
        } // end if 
        else {
            echo '<div class="text-center no-emp">';
                echo "<h1>لا يوجد تجار لعرضهم</h1>";
                echo '<hr class="custom-hr">';
                echo '<a href="?action=add" class="btn btn-primary">';  
                echo 'إضافة تاجر';
                echo "</a>";
            echo '</div>';
        }
        echo '</div> <!-- End Div container -->';
    
    } // end if($action == 'manage')
    elseif($action == 'add'){ 
    array_push($link,array('link'=>'#','name'=>'إضافة تاجر'));?>
    <div class="information block container-box">
     	<div class="container">
     	<div class="panel panel-default">
     		<div class="panel-heading">إضافة تاجر جديد</div>
     		   <div class="panel-body">
                 <div class="row">
                 <div class=" col-md-4">
                        <div class="thumbnail emp emp-add vip-add live-preview">
                            
                            <img src="layout/img/boy-1.png" class="img-responsive img-circle" />
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

      <!-- Start Submit -->
        
          <div class="form-group form-group-lg">
            <div class="col-sm-9">
              <input type="submit" value="إضافة تاجر"  class="btn btn-success btn-lg btn-block">
            </div>
          </div>
        
      <!-- End Submit -->
        </form>
    </div>
                </div>
  
    <?php } // end if($action == 'add') addcash
    elseif($action == 'addcash'){ 
        array_push($link,array('link'=>'#','name'=>'إضافة دفعة نقدية'));?>
    <div class="container container-box">
       <form class="form-horizontal" method="POST" action="?action=insertcash">
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
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">اسم التاجر</label>
                        <div class="col-sm-5 ">            
                            <select name="vip" class="form-control">
                                <option value="0">...</option>
                                <?php
                                    $users = query("select v.* , p.Name From vip v INNER JOIN person p on p.id = v.id_person");
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
   elseif($action == 'insertcash'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $value = $_POST['value'];
        $vip = $_POST['vip'];
        $date = $_POST['date'];

    echo $value.'  '.$vip.'   '.$date;
        // Validate The Form
        $formErrors = array();

        if(empty($formErrors)){

            

            $stmt = $con->prepare("INSERT INTO 
            cash(Value,Date,vip_id)
            VALUES(:val , :datee , :vip)");
            
          $stmt->execute(array(
            'val' => $value ,
            'datee' => $date,
            'vip' => $vip
            )); 

            // Update Balance vip
            $old_balance = getOneRecord("Balance", "vip" , "id" ,$vip);
            $new_balance = $old_balance['Balance'] - $value; 
                
            $stmt1 = $con->prepare("UPDATE `roastery`.`vip` SET `Balance` = ? WHERE `vip`.`id` = ?");
            $stmt1->execute(array($new_balance,$vip));

            if($stmt && $stmt1) {
                header('Location: vip.php');
              }
          

        } // end if(empty($formErrors))
    } // end if($_SERVER['REQUEST_METHOD'] == 'POST')
   } // end  elseif($action == 'insertcash')
    elseif($action == 'insert'){
         //Process Data From Add Item
         if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // get the variable from form 
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            // Validate The Form
            
            $formErrors = array();

            if(empty($formErrors)){

                $lastID= getLastRecord("id","person","id");
                $id = $lastID['id']+1;

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
                  vip(id_person)
                  VALUES(:id_p)");
                $stmt2->execute(array(
                  'id_p'  => $id
                  )); 

                  if($stmt && $stmt2) {
                    header('Location: vip.php');
                  }
                 }
          }

    } // end elseif($action == 'insert')
    elseif($action == 'delete'){
        // Start Procedural To Delete Item

        $vipid=$_GET['vipid'] && is_numeric($_GET['vipid']) ?intval($_GET['vipid']) : header('Location:vip.php');

		
		 
		$stmt1 = $con->prepare("SELECT * FROM vip WHERE id_person = ? LIMIT 1");
     	$stmt1->execute(array($vipid));
        $count1 = $stmt1->rowCount();
         
        $stmt2 = $con->prepare("SELECT * FROM person WHERE id = ? LIMIT 1");
     	$stmt2->execute(array($vipid));
     	$count2 = $stmt2->rowCount();
     	
     	if($count1 > 0 && $count2 > 0){

     		$stmt1 = $con->prepare("DELETE FROM vip WHERE id_person = :id");
     		$stmt1->bindParam(":id" ,$vipid );
            $stmt1->execute();
             
            $stmt2 = $con->prepare("DELETE FROM person WHERE id = :id");
     		$stmt2->bindParam(":id" ,$vipid );
     		$stmt2->execute();

            header('Location: vip.php');
     	}
    } // end ($action == 'delete')

    elseif($action == 'edit'){

        if(isset($_GET['vipid']) && is_numeric($_GET['vipid'])){
          $vipid = $_GET['vipid']; 
        } else {
            header('Location: vip.php');
        } 
        array_push($link,array('link'=>'#','name'=>'تعديل بيانات'));
        // get the info from Database 
        $vip = getOneRecord("*","vip v INNER JOIN person p ON v.id_person = p.id","v.id_person",$vipid);
        ?> 

<div class="information block">
     	<div class="container container-box">
     	<div class="panel panel-default">
     		<div class="panel-heading"> تعديل بيانات | <?php echo $vip['Name']; ?> </div>
     		   <div class="panel-body">
                 <div class="row">
                 <div class=" col-md-4">
                        <div class="thumbnail emp emp-add live-preview">
                            
                            <img src="layout/img/boy-1.png" class="img-responsive img-circle" />
                            <ul class="list-unstyled">
                            <li class="text-center">
                               <span class="name-emp"> <?php echo $vip['Name']; ?></span>
                            </li>

                            <li>
                             <span class="address"> <?php echo $vip['Address']; ?></span> :<span>العنوان</span>
                            </li>

                            <li>
                             <span class="phone"> <?php echo $vip['Phone']; ?></span> :<span>الهاتف</span>
                            </li>
                        </ul>
                        </div>
                   </div>
                 
    <div class="col-md-8">
        <form class="form-horizontal" method="POST" action="?action=update">
        <input type="hidden" name="empid" value="<?php echo $vipid; ?>">
      <!-- Start Name -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9 control-label">الاسم</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="name" class="form-control live-name" 
               required="required" 
               value=" <?php echo $vip['Name']; ?>">
            </div>
          </div>
      <!-- End Name -->

      <!-- Start Address -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9  control-label">العنوان</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="address" class="form-control live-address"   required="required"
              value=" <?php echo $vip['Address']; ?>">
            </div>
          </div>
      <!-- End Address -->

      <!-- Start Phone -->
          <div class="form-group form-group-lg">
            <label class="col-lg-3 col-lg-push-9  control-label">الهاتف</label>
            <div class="col-lg-9 col-lg-pull-3">
              <input type="text" name="phone" class="form-control live-phone"
              value=" <?php echo $vip['Phone']; ?>">
            </div>
          </div>
      <!-- End Phone -->

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

   <?php } // end  elseif($action == 'edit')

   elseif($action == 'update'){
            //Process Update 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // get the variable from form 
            $id = $_POST['empid'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            

            // Validate The Form 
            $formErrors = array(); 

            if(empty($formErrors)){
                    // update the database

                    $stmt2 = $con->prepare("UPDATE person SET
                                Name =?, Address =? , Phone=?
                                WHERE id = ?");
                    $stmt2->execute(array($name,$address,$phone ,$id));

                    if($stmt2) {
                        header('Location: vip.php');
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
      $stmt1 = $con->prepare("SELECT p.* , v.Balance FROM vip v inner join person p on p.id = v.id_person and  p.id =? LIMIT 1");
      $stmt1->execute(array($id));
      $info = $stmt1->fetch();
     
      // To AutoBreadcrumb
      array_push($link,array('link'=>'#','name'=>$info['Name']));

        // get bills vip
        $stmt2 = $con->prepare("SELECT b.* , p.Name , p.id IDP , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id  and p.id=?  group by(b.id)");
        $stmt2->execute(array($id));
        $bills = $stmt2->fetchAll();

        // get cash vip
        $stmt3 = $con->prepare("SELECT c.* FROM cash c inner join vip v inner join person p on c.vip_id = v.id AND v.id_person = p.id AND p.id=? order by c.id DESC");
        $stmt3->execute(array($id));
        $cash = $stmt3->fetchAll();

      VipInfo($info , $bills , $cash);

   } // end elseif ($action == 'profile') 

    AutoBreadcrumb($link); 
    include $templates."footer.php";

} else {
    header('Location: index.php');
	exit(); 
}