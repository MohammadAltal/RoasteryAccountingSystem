<?php 

session_start();
$active="service";

if(isset($_SESSION['user2'])){
    include "init.php";
    include $templates."header.php";
    $action ='';


    //get last inventory in database
    $lastRecord1= getLastRecord("id","inventory","id");
    $inventory = $lastRecord1['id']+1;


    if(isset($_GET['action'])){
		$action = $_GET['action']; 
	}
	else {
		$action = 'manage';
	}
 if($action == 'manage'){
?>
    <div class="container">
        <div class="admin2-box text-center">
            <a href="index.php"><h1>محمصة الدبش | المشرف</h1></a>
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
        </div> <!-- admin2-box -->
    </div> <!-- End Container -->
<?php
 } elseif($action == 'inventory'){
    if(isset($_GET['inventoryid']) && is_numeric($_GET['inventoryid'])){
        $inventoryid = $_GET['inventoryid']; 
      } else {
        $inventoryid =0;
      } 
      
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
                echo "<div class='container'>";
                for($i=1;$i<=$count;$i++){
                ?>
                <div class="admin2-box text-center">
                    <a href="index.php"><h1>محمصة الدبش | المشرف</h1></a>
                </div>
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
    } // end  if($_SERVER['REQUEST_METHOD'] == 'POST')

    header('Location: dashboard2.php');
}
    include $templates."footer.php";

} else {
    header('Location: index.php');
	exit(); 
}