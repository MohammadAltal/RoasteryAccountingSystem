<?php 

session_start();

$active="service";
if(isset($_SESSION['user'])){
    include "init.php";
    include $templates."header.php";
    include $templates."navbar-manager.php";

    // BreadCrumb
    $link=array(array("link"=>"dashboard.php","name"=>"لوحة التحكم"),
    array("link"=>"service.php","name"=>"الخدمات"));
?>

 <div class="container container-box">
        <div class="dashboard">
            <div class="sale">
                    <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group form-group-lg">
                                <label class="col-lg-3 col-lg-push-9 control-label">قيمة جميع المبيعات خلال شهر :</label>
                                <div class="col-lg-1 col-lg-push-5">
                                    <select  name="buy" class="form-control">
                                        <option value="0">...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-lg-push-2">
                                <input type="submit" class="btn btn-success btn-lg btn-block" 
                                value="موافق">
                                </div>
                            </div>
                    </form>
            </div>   <!-- End sale -->

            <hr class="custom-hr2">

            <div class="sale">
                    <form class="form-horizontal" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group form-group-lg">
                                <label class="col-lg-3 col-lg-push-9 control-label">قيمة جميع المشتريات خلال شهر :</label>
                                <div class="col-lg-1 col-lg-push-5">
                                    <select  name="sale" class="form-control">
                                        <option value="0">...</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option  value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-lg-push-2">
                                <input type="submit" class="btn btn-success btn-lg btn-block" 
                                value="موافق">
                                </div>
                            </div>
                    </form>
            </div>   <!-- End sale -->  
        </div>  <!-- End dashboard -->
    </div> <!-- End Container -->

   
<?php
         if($_SERVER['REQUEST_METHOD'] == 'POST'){

            
            if(isset($_POST['buy'])){
                $buy = $_POST['buy'];
            }
            if(isset($_POST['sale'])){
                $sale = $_POST['sale'];
            }
            
            if(isset($buy)){    
                $statment = $con->prepare("SELECT sum(i.Price) From bills b inner join bill_item i on b.id = i.bill_id and b.Buy_Sale=1 and month(b.Date)=? and year(b.Date) = year(now())");
                $statment->execute(array($buy));
                $result =  $statment->fetchColumn();
                resultBox($result);

            } elseif(isset($sale)){
                $statment = $con->prepare("SELECT sum(i.Price) From bills b inner join bill_item i on b.id = i.bill_id and b.Buy_Sale=0 and month(b.Date)=? and year(b.Date) = year(now())");
                $statment->execute(array($sale));
                $result =  $statment->fetchColumn();
                resultBox($result);
            }

         } // end if($_SERVER['REQUEST_METHOD'] == 'POST')
    
    AutoBreadcrumb($link);
    include $templates."footer.php";

} else {
    header('Location: index.php');
	exit(); 
}
?>