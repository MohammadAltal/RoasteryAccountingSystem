<?php 

session_start();
$active="bill";

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
    // BreadCrumb
    $link=array(array("link"=>"dashboard.php","name"=>"لوحة التحكم"),
    array("link"=>"bill.php","name"=>"الفواتير"));

    if($action == 'manage'){

    //get last bill in database
    $lastRecord= getLastRecord("id","bills","id");
    $billid = $lastRecord['id']+1;
   
   //get last inventory in database
   $lastRecord1= getLastRecord("id","inventory","id");
   $inventory = $lastRecord1['id']+1;

    ?>
<div class="container container-box">
 
 
 <div class="panel-group" id="accordion">
   <div class="panel panel-default">
            
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
            <div class="panel-heading">
                <h4 class="panel-title">
                   إضافة فاتورة بيع / شراء <i class="fa fa-plus"></i>
                </h4>
            </div>
        </a>

     <div id="collapse2" class="panel-collapse collapse">
       <div class="panel-body">

          <form class="form-horizontal" method="POST" action="?action=addbillbuy&billid=<?php echo $billid; ?>">
                <!-- Start Number -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">رقم الفاتورة</label>
                        <div class="col-sm-5 ">            
                            <input type="text"
                                name="number"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End Number -->
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
                
                <!-- Start type -->
                <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">نوع الفاتورة</label>
                        <div class="col-sm-5 ">            
                            <select name="type" class="form-control">
                                  <option value="">....</option>
                                  <option value="0">فاتورة شراء</option>
                                  <option value="1">فاتورة بيع</option>  
                            </select>
                        </div>
                    </div>  		
                <!-- End type -->
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
                <!-- Start count -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">عدد المواد</label>
                        <div class="col-sm-5 ">            
                            <input type="number"
                                name="count"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End count -->
                <!-- Start Submit -->            
                     <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-7">
                                <input type="submit"
                                        value="إضافة فاتورة" 
                                        class="btn btn-success btn-block">

                            </div>
                    </div> 
                <!-- End Submit -->
              </form>
             </div> <!-- End Div panel-body -->
          </div> <!-- End Div panel-collapse collapse -->
        </div> <!-- End Div panel panel-default -->
    

  
   <div class="panel panel-default">
            
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
            <div class="panel-heading">
                <h4 class="panel-title">
                  إضافة فاتورة مستودع <i class="fa fa-plus"></i>
                </h4>
            </div>
        </a>

     <div id="collapse3" class="panel-collapse collapse">
       <div class="panel-body">

          <form class="form-horizontal" method="POST" action="?action=inventory&inventoryid=<?php echo $inventory; ?>">

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
                <!-- Start count -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">عدد المواد</label>
                        <div class="col-sm-5 ">            
                            <input type="number"
                                name="count"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End count -->
                <!-- Start Submit -->            
                     <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-7">
                                <input type="submit"
                                        value="إضافة فاتورة" 
                                        class="btn btn-success btn-block">

                            </div>
                    </div> 
                <!-- End Submit -->
              </form>
             </div> <!-- End Div panel-body -->
          </div> <!-- End Div panel-collapse collapse -->
        </div> <!-- End Div panel panel-default -->
        <div class="panel panel-default">
            
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    إضافة مادة إلى فاتورة <i class="fa fa-plus"></i>
                    </h4>
                </div>
            </a>

            <div id="collapse7" class="panel-collapse collapse">
                 <div class="panel-body">
                 <form class="form-horizontal" method="POST" action="?action=addoneitem">
                    <!-- Start Ammount -->
                        <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">الكمية</label>
                        <div class="col-sm-5 ">            
                            <input type="number"
                                name="ammount"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                    <!-- End Ammount -->
                    <!-- Start Price -->
                        <div class="form-group">			
                            <label class="col-sm-3 col-sm-push-7 control-label text-center">السعر</label>
                            <div class="col-sm-5 ">            
                                <input type="number"
                                    name="price"
                                    class="form-control"
                                    autocomplete="off"
                                    required="required">
                            </div>
                        </div>  		
                    <!-- End Price -->
                    <!-- Start item -->
                        <div class="form-group">			
                            <label class="col-sm-3 col-sm-push-7 control-label text-center">اسم المادة</label>
                            <div class="col-sm-5 ">            
                                <select name="item" class="form-control">
                                    <option value="0">...</option>
                                    <?php
                                        $items = getAllFrom("item");
                                        foreach ($items as $item ) {
                                            echo "<option value='".$item['id']."'>".$item['Name']."</option>";	
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>  		
                    <!-- End item -->
                    <!-- Start Number Bill -->
                        <div class="form-group">			
                            <label class="col-sm-3 col-sm-push-7 control-label text-center">رقم الفاتورة</label>
                            <div class="col-sm-5 ">            
                                <select name="bill" class="form-control">
                                    <option value="0">...</option>
                                    <?php
                                        $items = getAllFrom("bills");
                                        foreach ($items as $item ) {
                                            echo "<option value='".$item['id']."'>".$item['Number']."</option>";	
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>  		
                    <!-- End Number Bill -->
                    <!-- Start Submit -->            
                        <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-7">
                                    <input type="submit"
                                            value="إضافة مادة" 
                                            class="btn btn-success btn-block">
                                </div>
                        </div> 
                    <!-- End Submit -->
                    </form>
                </div> <!-- End Div panel-body -->
            </div> <!-- End Div panel-collapse collapse -->
    </div> <!-- End Div panel panel-default -->

        <div class="panel panel-default">
            
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    إضافة مشتريات <i class="fa fa-plus"></i>
                    </h4>
                </div>
            </a>

            <div id="collapse10" class="panel-collapse collapse">
                 <div class="panel-body">
                 <form class="form-horizontal" method="POST" action="?action=addsales">
                    <!-- Start Name -->
                        <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">الاسم</label>
                        <div class="col-sm-5 ">            
                            <input type="text"
                                name="name"
                                class="form-control"
                                required="required">
                        </div>
                    </div>  		
                    <!-- End Name -->
                    <!-- Start Price -->
                        <div class="form-group">			
                            <label class="col-sm-3 col-sm-push-7 control-label text-center">السعر</label>
                            <div class="col-sm-5 ">            
                                <input type="number"
                                    name="price"
                                    class="form-control"
                                    required="required">
                            </div>
                        </div>  		
                    <!-- End Price -->
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
                                            value="إضافة مشترى" 
                                            class="btn btn-success btn-block">
                                </div>
                        </div> 
                    <!-- End Submit -->
                    </form>
                </div> <!-- End Div panel-body -->
            </div> <!-- End Div panel-collapse collapse -->
    </div> <!-- End Div panel panel-default -->

    <div class="panel panel-default">
            
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    عرض جميع فواتير البيع <i class="fa fa-eye"></i>
                    </h4>
                </div>
            </a>

            <div id="collapse4" class="panel-collapse collapse">
                 <div class="panel-body">
                    <div class="All-bill text-center">   
                        <a href="?action=bill&all=sales" class="btn btn-warning">جميع الفواتير</a> |
                        <a href="?action=bill&year=sales" class="btn btn-info">جميع فواتير سنة <?php echo date('Y'); ?></a> |
                        <a href="?action=bill&month=sales" class="btn btn-success">جميع فواتير شهر <?php echo date('n'); ?></a> |
                        <a href="?action=bill&day=sales" class="btn btn-primary">جميع فواتير اليوم <?php echo date('d/m/y'); ?></a>
                    </div> <!-- End Div All-bill -->
                </div> <!-- End Div panel-body -->
            </div> <!-- End Div panel-collapse collapse -->
    </div> <!-- End Div panel panel-default -->

    <div class="panel panel-default">
            
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    عرض جميع فواتير الشراء <i class="fa fa-eye"></i>
                    </h4>
                </div>
            </a>

            <div id="collapse5" class="panel-collapse collapse">
                 <div class="panel-body">
                    <div class="All-bill text-center">   
                        <a href="?action=bill&all=buy" class="btn btn-warning">جميع الفواتير</a> |
                        <a href="?action=bill&year=buy" class="btn btn-info">جميع فواتير سنة <?php echo date('Y'); ?></a> |
                        <a href="?action=bill&month=buy" class="btn btn-success">جميع فواتير شهر <?php echo date('n'); ?></a> |
                        <a href="?action=bill&day=buy" class="btn btn-primary">جميع فواتير اليوم <?php echo date('d/m/y'); ?></a>
                    </div> <!-- End Div All-bill -->
         
                </div> <!-- End Div panel-body -->
            </div> <!-- End Div panel-collapse collapse -->
    </div> <!-- End Div panel panel-default -->

    <div class="panel panel-default">
            
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    عرض جميع فواتير المستودع <i class="fa fa-eye"></i>
                    </h4>
                </div>
            </a>

            <div id="collapse6" class="panel-collapse collapse">
                 <div class="panel-body">
                 <div class="All-bill text-center">   
                        <a href="?action=bill&inventory=all" class="btn btn-warning">جميع الفواتير</a> |
                        <a href="?action=bill&inventory=year" class="btn btn-info">جميع فواتير سنة <?php echo date('Y'); ?></a> |
                        <a href="?action=bill&inventory=month" class="btn btn-success">جميع فواتير شهر <?php echo date('n'); ?></a> |
                        <a href="?action=bill&inventory=day" class="btn btn-primary">جميع فواتير اليوم <?php echo date('d/m/y'); ?></a>
                    </div> <!-- End Div All-bill -->
         
                </div> <!-- End Div panel-body -->
            </div> <!-- End Div panel-collapse collapse -->
    </div> <!-- End Div panel panel-default -->


    <div class="panel panel-default">
            
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse15">
                <div class="panel-heading">
                    <h4 class="panel-title">
                    عرض جميع المشتريات  <i class="fa fa-eye"></i>
                    </h4>
                </div>
            </a>

            <div id="collapse15" class="panel-collapse collapse">
                 <div class="panel-body">
                    <div class="All-bill text-center">   
                        <a href="?action=bill&sales=all" class="btn btn-warning">جميع المشتريات</a> |
                        <a href="?action=bill&sales=year" class="btn btn-info">جميع مشتريات سنة <?php echo date('Y'); ?></a> |
                        <a href="?action=bill&sales=month" class="btn btn-success">جميع مشتريات شهر <?php echo date('n'); ?></a> |
                        <a href="?action=bill&sales=day" class="btn btn-primary">جميع مشتريات اليوم <?php echo date('d/m/y'); ?></a>
                    </div> <!-- End Div All-bill -->
                </div> <!-- End Div panel-body -->
            </div> <!-- End Div panel-collapse collapse -->
    </div> <!-- End Div panel panel-default -->
        
     </div> <!-- End Div panel-group -->

</div> <!-- End Div container -->

    
<?php
    } // end if($action="manage)
elseif ($action=='addbillbuy') {

    if(isset($_GET['billid']) && is_numeric($_GET['billid'])){
        $billid = $_GET['billid']; 
      } else {
        $billid =0;
      } 
            // To AutoBreadcrumb
            $msg= "إضافة مواد الفاتورة ".$_POST['number'];
            array_push($link,array('link'=>'#','name'=>$msg));
           //Process Update 
           if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // get the variable from form 
            $number = $_POST['number'];
            $date = $_POST['date'];
            $vip = $_POST['vip'];
            $count = $_POST['count'];
            $type = $_POST['type'];

            // echo $billid.' '.$number.' '.$date.' '.$vip.' '.$type;
          
            // Validate The Form

            $formErrors = array();
            if(empty($formErrors)){

                  // Insert into database
                  $stmt = $con->prepare("INSERT INTO 
                       bills(id,Number , Date , Buy_Sale ,vip_id)
                    VALUES(:ID , :number , :date , :type ,  :vip)");
                  $stmt->execute(array(
                    'ID' => $billid,
                    'number' => $number,
                    'date' => $date,
                    'type' => $type,
                    'vip'=>$vip
                    )); 

            } // End if(empty($formErrors)) 
            echo "<div class='container container-box'>";
            for($i=1;$i<=$count;$i++){
            ?>
            <form class="form-horizontal" method="POST" action="?action=additem&billid=<?php echo $billid; ?>&count=<?php echo $count; ?>">
                <!-- Start Ammount -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">الكمية</label>
                        <div class="col-sm-5 ">            
                            <input type="number"
                                name="ammount<?php echo $i; ?>"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End Ammount -->
                <!-- Start Price -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">السعر</label>
                        <div class="col-sm-5 ">            
                            <input type="number"
                                name="price<?php echo $i; ?>"
                                class="form-control"
                                autocomplete="off"
                                required="required">
                        </div>
                    </div>  		
                <!-- End Price -->
                <!-- Start item -->
                    <div class="form-group">			
                        <label class="col-sm-3 col-sm-push-7 control-label text-center">اسم المادة</label>
                        <div class="col-sm-5 ">            
                            <select name="item<?php echo $i; ?>" class="form-control">
                                <option value="0">...</option>
                                <?php
                                    $items = getAllFrom("item");
                                    foreach ($items as $item ) {
                                        echo "<option value='".$item['id']."'>".$item['Name']."</option>";	
                                    }
                                ?>
                            </select>
                        </div>
                    </div>  		
                <!-- End item -->
                <hr>

<?php   
         } // end for
?>
                <!-- Start Submit -->            
                    <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-7">
                                <input type="submit"
                                        value="إضافة المواد" 
                                        class="btn btn-success btn-block">

                            </div>
                    </div> 
                <!-- End Submit -->
                <!-- Start Vip ID -->
                <input type="hidden" name="vip" value="<?php echo $vip; ?>">
                <!-- End Vip ID -->
              </form>
              </div> <!--End div container -->
<?php

         } // End  if($_SERVER['REQUEST_METHOD'] == 'POST')

     
} elseif($action == 'additem'){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $count = $_GET['count'];
        $billid = $_GET['billid'];
        

        $type = getOneRecord("Buy_Sale", "bills" , "id" ,$billid);
       

        for($i=1;$i<=$count;$i++){
            $ammount = $_POST['ammount'.$i];
            $price = $_POST['price'.$i];
            $item = $_POST['item'.$i];
            $vipid= $_POST['vip'];
            global $con;
            // Insert into database
                $stmt = $con->prepare("INSERT INTO 
                bill_item(Ammount , Price , bill_id ,item_id)
                VALUES(:ammount , :price , :bill , :item)");
                $stmt->execute(array(
                'ammount' => $ammount,
                'price' => $price,
                'bill' => $billid,
                'item'=>$item
                )); 
            // Update Ammount item
            echo $type['Buy_Sale'];
                $old_ammount = getOneRecord("Ammount", "item" , "id" ,$item );
                if($type['Buy_Sale']==0){
                $new_ammount = $old_ammount['Ammount'] + $ammount;}
                else{
                    $new_ammount = $old_ammount['Ammount'] - $ammount; 
                }
                $stmt = $con->prepare("UPDATE item SET Ammount =? WHERE id = ?");
                $stmt->execute(array($new_ammount,$item));
            // Update Balance vip
                $old_balance = getOneRecord("Balance", "vip" , "id" ,$vipid);
                if($type['Buy_Sale']==0){
                    $new_balance = $old_balance['Balance'] + $price;}
                    else{
                        $new_balance = $old_balance['Balance'] + $price; 
                    }
                $stmt = $con->prepare("UPDATE `roastery`.`vip` SET `Balance` = ? WHERE `vip`.`id` = ?");
                $stmt->execute(array($new_balance,$vipid));

        } //ُEnd for
        header('Location: bill.php');
    } // end  if($_SERVER['REQUEST_METHOD'] == 'POST')
    
 
} elseif($action == 'inventory'){
    if(isset($_GET['inventoryid']) && is_numeric($_GET['inventoryid'])){
        $inventoryid = $_GET['inventoryid']; 
      } else {
        $inventoryid =0;
      } 

      array_push($link,array('link'=>'#','name'=>'فاتورة مستودع'));
                //Process Update 
                if($_SERVER['REQUEST_METHOD'] == 'POST'){

                // get the variable from form 
                $date = $_POST['date'];
                $count = $_POST['count'];
                
                // Validate The Form
                $formErrors = array();

                if(empty($formErrors)){

                        // Insert into database
                        $stmt = $con->prepare("INSERT INTO 
                            inventory(id,Date)
                        VALUES(:ID , :date)");
                        $stmt->execute(array(
                        'ID' => $inventoryid,
                        'date' => $date,

                        )); 

                } // End if(empty($formErrors)) 
                echo "<div class='container container-box'>";
                for($i=1;$i<=$count;$i++){
                ?>
                            <form class="form-horizontal" method="POST" action="?action=additeminventory&inventoryid=<?php echo $inventoryid; ?>&count=<?php echo $count; ?>">
                    <!-- Start Ammount -->
                        <div class="form-group">			
                            <label class="col-sm-3 col-sm-push-7 control-label text-center">الكمية</label>
                            <div class="col-sm-5 ">            
                                <input type="number"
                                    name="ammount<?php echo $i; ?>"
                                    class="form-control"
                                    autocomplete="off"
                                    required="required">
                            </div>
                        </div>  		
                    <!-- End Ammount -->
                    <!-- Start item -->
                        <div class="form-group">			
                            <label class="col-sm-3 col-sm-push-7 control-label text-center">اسم المادة</label>
                            <div class="col-sm-5 ">            
                                <select name="item<?php echo $i; ?>" class="form-control">
                                    <option value="0">...</option>
                                    <?php
                                        $items = getAllFrom("item","WHERE Raw=0");
                                        foreach ($items as $item ) {
                                            echo "<option value='".$item['id']."'>".$item['Name']."</option>";	
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>  		
                    <!-- End vip -->
                    <hr>

            <?php   
                } // end for
            ?>
                    <!-- Start Submit -->            
                        <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-7">
                                    <input type="submit"
                                            value="إضافة المواد" 
                                            class="btn btn-success btn-block">

                                </div>
                        </div> 
                    <!-- End Submit -->
                    </form>
                    </div> <!--End div container -->
            <?php

                } // End  if($_SERVER['REQUEST_METHOD'] == 'POST')
      
} elseif ($action == 'additeminventory') {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $count = $_GET['count'];
        $inventoryid = $_GET['inventoryid'];
        
        for($i=1;$i<=$count;$i++){
            $ammount = $_POST['ammount'.$i];
            $item = $_POST['item'.$i];

            
            // Insert into database
                $stmt = $con->prepare("INSERT INTO 
                bill_inventory(Ammount , inventory_id ,item_id)
                VALUES(:ammount  , :bill , :item)");
                $stmt->execute(array(
                'ammount' => $ammount,
                'bill' => $inventoryid,
                'item'=>$item
                )); 
            // Update Ammount item
                $old_ammount = getOneRecord("Ammount", "item" , "id" ,$item );
                
                $new_ammount = $old_ammount['Ammount'] - $ammount; 
                
                $stmt = $con->prepare("UPDATE item SET Ammount =? WHERE id = ?");
			    $stmt->execute(array($new_ammount,$item));

        } //ُEnd for

        header('Location: bill.php');
    } // end  if($_SERVER['REQUEST_METHOD'] == 'POST')
    
} // end elseif ($action == 'additeminventory') 
        elseif($action == 'addoneitem'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $ammount = $_POST['ammount'];
                $price   = $_POST['price'];
                $item    = $_POST['item'];
                $bill    = $_POST['bill'];

                $type = getOneRecord("Buy_Sale", "bills" , "id" ,$bill);
                $vipid = getOneRecord("vip_id", "bills" , "id" ,$bill);
                // Validate The Form
                $formErrors = array();

                if(empty($formErrors)){

                        // Insert into database
                        $stmt = $con->prepare("INSERT INTO 
                            bill_item(Ammount,Price,bill_id,item_id)
                        VALUES(:ammount , :price , :bill , :item)");
                        $stmt->execute(array(
                        'ammount' => $ammount,
                        'price' => $price,
                        'bill' => $bill,
                        'item' => $item
                        ));

                        // Update Ammount item
                        $old_ammount = getOneRecord("Ammount", "item" , "id" ,$item );
                        if($type['Buy_Sale']==0){
                        $new_ammount = $old_ammount['Ammount'] + $ammount;}
                        else{
                            $new_ammount = $old_ammount['Ammount'] - $ammount; 
                        }
                        $stmt = $con->prepare("UPDATE item SET Ammount =? WHERE id = ?");
                        $stmt->execute(array($new_ammount,$item));
                        
                        // Update Balance vip
                        $old_balance = getOneRecord("Balance", "vip" , "id" ,$vipid['vip_id']);
                        if($type['Buy_Sale']==0){
                            $new_balance = $old_balance['Balance'] - $price;}
                            else{
                                $new_balance = $old_balance['Balance'] + $price; 
                            }
                        $stmt = $con->prepare("UPDATE `roastery`.`vip` SET `Balance` = ? WHERE `vip`.`id` = ?");
                        $stmt->execute(array($new_balance,$vipid['vip_id']));

                    if($stmt){
                        $url = $_SERVER['HTTP_REFERER'];
                        header("Location: $url");   
                    }

                } // End if(empty($formErrors)) 
            } // end  if($_SERVER['REQUEST_METHOD'] == 'POST')
        } // end  elseif($action == 'addoneitem')
        elseif($action == 'addsales'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $name    = $_POST['name'];
                $price   = $_POST['price'];
                $date    = $_POST['date'];

                // echo $name.'  '.$price.'  '.$date;

                // Validate The Form
                $formErrors = array();
                if(empty($formErrors)){
                        // Insert into database
                        $stmt = $con->prepare("INSERT INTO 
                        sales(Name,Date,Price)
                        VALUES(:name , :date , :price)");
                        $stmt->execute(array(
                       'name' => $name,
                       'date' => $date,
                       'price' => $price
                    ));
                    if($stmt){
                        $url = $_SERVER['HTTP_REFERER'];
                        header("Location: $url");   
                    }

               } // end if(empty($formErrors))
            } // end if($_SERVER['REQUEST_METHOD'] == 'POST')
        } // end  elseif($action == 'addsales')

        elseif($action == 'bill'){

            if(isset($_GET['year'])){
                $year = $_GET['year'];
                    if($year == 'sales') {
                        $contents = query("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id and year(b.Date)=year(date(now())) and b.Buy_Sale=1 group by(b.id)");
                        $msg = "فواتير بيع ".date('Y');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($year == 'buy') {
                        $contents = query("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id and year(b.Date)=year(date(now())) and b.Buy_Sale=0 group by(b.id)");
                        $msg = "فواتير شراء ".date('Y');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                BillsTable($contents);
              }
            elseif(isset($_GET['month'])){
                $month = $_GET['month'];
                    if($month == 'sales') {
                        $contents = query("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id and month(b.Date)=month(now()) and year(b.Date)=year(now()) and b.Buy_Sale=1 group by(b.id)");
                        $msg = "فواتير بيع شهر ".date('n');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($month == 'buy') {
                        $msg = "فواتير شراء شهر ".date('n');
                        array_push($link,array('link'=>'#','name'=>$msg));
                        $contents = query("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id and month(b.Date)=month(now()) and year(b.Date)=year(now()) and b.Buy_Sale=0 group by(b.id)");
                    }
                BillsTable($contents);
            }
            elseif(isset($_GET['day'])){
                $day = $_GET['day'];
                    if($day == 'sales') {
                        $contents = query("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id  and b.Date= date(now()) and b.Buy_Sale=1 group by(b.id)");
                        $msg = "فواتير بيع اليوم ". date('d/m/y');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($day == 'buy') {
                        $contents = query("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id  and b.Date= date(now()) and b.Buy_Sale=0 group by(b.id)");
                        $msg = "فواتير شراء اليوم ". date('d/m/y');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                BillsTable($contents);       
            }
            elseif(isset($_GET['all'])) {
                $all = $_GET['all'];
                    if($all == 'sales') {
                        $contents = query("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id and b.Buy_Sale=1 group by(b.id)");
                        $msg = "جميع فواتير البيع";
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($all == 'buy') {
                        $contents = query("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id and b.Buy_Sale=0 group by(b.id)");
                        $msg = "جمع فواتير الشراء ";
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                BillsTable($contents);      
            }
            elseif(isset($_GET['inventory'])){
                $result = $_GET['inventory'];
                    if($result == 'all'){
                        $contents = query("SELECT * FROM inventory order by id DESC");
                        $msg = "جميع فوتير المستودع";
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($result == 'year'){
                        $contents = query("SELECT * FROM inventory where year(Date)=year(date(now()))  order by id DESC");
                        $msg = "فواتير سنة ".date('Y');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($result == 'month'){
                        $contents = query("SELECT * FROM inventory where month(Date)=month(date(now())) AND year(Date)=year(date(now()))  order by id DESC");
                        $msg = "فواتير شهر ".date('n');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($result == 'day'){
                        $contents = query("SELECT * FROM inventory where Date=date(now()) order by id DESC");
                        $msg = "فواتير اليوم ". date('d/m/y');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    BillsInventoryTable($contents);
            }
            elseif(isset($_GET['sales'])){
                $result = $_GET['sales'];
                    if($result == 'all'){
                        $contents = query("SELECT * FROM sales order by id DESC");
                        $msg = "جميع المشتريات";
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($result == 'year'){
                        $contents = query("SELECT * FROM sales where year(Date)=year(date(now()))  order by id DESC");
                        $msg = "مشتريات سنة ". date('Y');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($result == 'month'){
                        $contents = query("SELECT * FROM sales where month(Date)=month(date(now())) AND year(Date)=year(date(now()))  order by id DESC");
                        $msg = "مشتريات شهر ". date('n');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    elseif($result == 'day'){
                        $contents = query("SELECT * FROM sales where Date=date(now()) order by id DESC");
                        $msg = "مشتريات اليوم ". date('d/m/y');
                        array_push($link,array('link'=>'#','name'=>$msg));
                    }
                    Sales($contents);
            }
            elseif(isset($_GET['id'])){
                    $ID = $_GET['id'];
                    global $con;
                     $stmt = $con->prepare("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id and b.id = ? group by(b.id)");
                     $stmt->execute(array($ID));
                     $info = $stmt->fetch();
                    
                     $stmt1 = $con->prepare("select bi.* , i.Name FROM bill_item bi inner join item i on i.id = bi.item_id and bi.bill_id=?");
                     $stmt1->execute(array($ID));
                     $items = $stmt1->fetchAll();

                     BillRecord($info,$items);

                     $msg = "فاتورة رقم ". $info['Number'];
                     array_push($link,array('link'=>'#','name'=>$msg));
            }

        } // end elseif($action == 'bill')
        elseif($action == 'delete'){
            if(isset($_GET['billinventory'])){
                $billinventory =  $_GET['billinventory'];
                $stmt = $con->prepare("SELECT * FROM inventory WHERE id = ? LIMIT 1");
                $stmt->execute(array($billinventory));
                $count = $stmt->rowCount();
                if($count>0){
                    $stmt = $con->prepare("DELETE FROM inventory WHERE id = :ID");
                    $stmt->bindParam(":ID" ,$billinventory );
                    $stmt->execute();
                    $url = $_SERVER['HTTP_REFERER'];
                    header("Location: $url");      
                }
                else{
                    echo "Delete Failed";
                    //header("refresh:5;url=$_SERVER['HTTP_REFERER']");
                    $url = $_SERVER['HTTP_REFERER'];
                    header('Location: $url');
                }
            } // end if(isset($_GET['billinventory']))
            if(isset($_GET['sales'])){
                $sales =  $_GET['sales'];
                $stmt = $con->prepare("SELECT * FROM sales WHERE id = ? LIMIT 1");
                $stmt->execute(array($sales));
                $count = $stmt->rowCount();
                if($count>0){
                    $stmt = $con->prepare("DELETE FROM sales WHERE id = :ID");
                    $stmt->bindParam(":ID" ,$sales );
                    $stmt->execute();
                    $url = $_SERVER['HTTP_REFERER'];
                    header("Location: $url");      
                }
                else{
                    echo "Delete Failed";
                    //header("refresh:5;url=$_SERVER['HTTP_REFERER']");
                    $url = $_SERVER['HTTP_REFERER'];
                    header('Location: $url');
                }
            } // end if(isset($_GET['sales']))
            elseif(isset($_GET['billid'])){
                $bill = $_GET['billid'];
                $stmt = $con->prepare("SELECT * FROM bills WHERE id = ? LIMIT 1");
                $stmt->execute(array($bill));
                $count = $stmt->rowCount();
                if($count>0){
                    $stmt = $con->prepare("DELETE FROM bills WHERE id = :ID");
                    $stmt->bindParam(":ID" ,$bill );
                    $stmt->execute();
                    $url = $_SERVER['HTTP_REFERER'];
                    header("Location: $url");      
                }
                else{
                    echo "Delete Failed";
                    //header("refresh:5;url=$_SERVER['HTTP_REFERER']");
                    $url = $_SERVER['HTTP_REFERER'];
                    header('Location: $url');
                }
            }
        } // end elseif($action == 'delete')

        elseif($action == 'edit'){
           if(isset($_GET['billid'])){
                $bill = $_GET['billid'];    
                $stmt = $con->prepare("select b.* , p.Name , sum(i.Price) as Value FROM bills b inner join bill_item i inner join vip v inner join person p on b.vip_id = v.id and v.id_person = p.id and b.id = i.bill_id where b.id = ? group by(b.id) LIMIT 1");
                $stmt->execute(array($bill));
                $data = $stmt->fetch();

                $msg = "تعديل فاتورة";
                array_push($link,array('link'=>'#','name'=>$msg));

                
?>
<div class="container container-box">
    <h2 class="text-center custom-h2">تعديل الفاتورة رقم <?php echo $data['Number']; ?></h2>
    <hr class="custom-hr">
    <form class="form-horizontal" method="POST" action="?action=update">
        <input type="hidden" name="billid" value="<?php echo $bill; ?>">
        <!-- Start Number -->
            <div class="form-group">			
                <label class="col-sm-3 col-sm-push-6 control-label text-center">رقم الفاتورة</label>
                <div class="col-sm-5 ">            
                    <input type="text"
                        name="number"
                        class="form-control"
                        autocomplete="off"
                        required="required"
                        value="<?php echo $data['Number']; ?>">
                </div>
            </div>  		
        <!-- End Number -->
        <!-- Start Date -->
            <div class="form-group">			
                <label class="col-sm-3 col-sm-push-6 control-label text-center">التاريخ</label>
                <div class="col-sm-5 ">            
                    <input type="date"
                        name="date"
                        class="form-control"
                        autocomplete="off"
                        required="required"
                        value="<?php echo $data['Date']; ?>">
                </div>
            </div>  		
        <!-- End Date -->
        <!-- Start Submit -->            
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <input type="submit"
                                value="تعديل فاتورة" 
                                class="btn btn-success btn-block">

                    </div>
            </div> 
        <!-- End Submit -->
        </form>
        </div>
        <?php   } // end if(isset($_GET['billid']))
        } // end elseif($action == 'edit')
        elseif($action == 'update'){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $number  = $_POST['number'];
                $date    = $_POST['date'];
                $ID      = $_POST['billid'];

                // Validate The Form 
                $formErrors = array(); 
                if(empty($formErrors)){
                    // update the database
                    $stmt1 = $con->prepare("UPDATE bills SET
                                Number =?, Date =?
                                WHERE id = ?");
                    $stmt1->execute(array($number,$date,$ID));

                    if($stmt1){
                        $url = $_SERVER['HTTP_REFERER'];
                        header("Location: $url");
                    }
                }


            } // end if($_SERVER['REQUEST_METHOD'] == 'POST')
        } // end elseif($action == 'update')
        AutoBreadcrumb($link);  
    include $templates."footer.php";
} else {
    header('Location: index.php');
	exit(); 
}
?>