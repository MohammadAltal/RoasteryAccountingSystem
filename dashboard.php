<?php 

session_start();


if(isset($_SESSION['user'])){
    include "init.php";
    include $templates."header.php";
    include $templates."navbar-manager.php";

    // AddBreadcrumb(" ");
?>

<div class="container text-center home-stats">

<h1>لوحة التحكم</h1>
<div class="row">
   <div class="col-md-3">
       <div class="stat st-member">
       <i class="fa fa-users"></i>
           <div class="info">
               عدد العاملين
               <span><a href="employee.php">
               <?php  echo countItem('id','employee'); ?>
                </a></span>
           </div>
       </div>
   </div>
   <div class="col-md-3">
       <div class="stat st-pinding">
       <i class="fa fa-pie-chart"></i>
           <div class="info">
          جميع الفواتير
           <span><a href="#">	
               <?php  echo countItem('id','bills'); ?>
           </a></span>
           </div>
       </div>
   </div>
   <div class="col-md-3">
       <div class="stat st-item">
       <i class="fa fa-cart-plus"></i>
           <div class="info">
               فواتير الشراء
           <span><a href="bill.php?action=bill&all=buy">
           <?php  echo countItem('id','bills WHERE Buy_Sale = 0'); ?>
            </a></span>
           </div>
       
       </div>
   </div>
   <div class="col-md-3">
       <div class="stat st-comment">
       <i class="fa fa-money"></i>
           <div class="info">
              فواتير البيع
               <span><a href="bill.php?action=bill&all=sales">
               <?php  echo countItem('id','bills WHERE Buy_Sale = 1'); ?>
                </a></span>
           </div>
       </div>
   </div>
    
</div> <!-- end din row -->

<hr class="custom-hr-plus">
    <div class="value">
        <span>ليرة سورية</span>
        <span>
        <?php if(!empty(sumItem('price*Ammount','item'))){
                   echo sumItem('price*Ammount','item');
                  }else{
                      echo 0;
                  }
        ?> 
        </span>
        <span> : القيمة التقريبية لجميع البضائع</span>
    </div>
    <hr class="custom-hr-doted ">
    <div class="value">
        <span>ليرة سورية</span>
        <span>
         <?php  
              if(!empty(sumItem('i.Price','bills b inner join bill_item i on b.id = i.bill_id and b.Buy_Sale=1'))){
                echo sumItem('i.Price','bills b inner join bill_item i on b.id = i.bill_id and b.Buy_Sale=1');
              } else{
                  echo 0;
              }
          ?> 
         </span>
        <span> : قيمة جميع فواتير البيع</span>
    </div>
    <hr class="custom-hr-doted ">
    <div class="value">
        <span>ليرة سورية</span>
        <span> 
        <?php  
              if(!empty(sumItem('i.Price','bills b inner join bill_item i on b.id = i.bill_id and b.Buy_Sale=0'))){
                echo sumItem('i.Price','bills b inner join bill_item i on b.id = i.bill_id and b.Buy_Sale=0');
              } else{
                  echo 0;
              }
          ?> 
        </span>
        <span> : قيمة جميع فواتير الشراء</span>
    </div>
   
</div> <!-- end din container -->

<?php
    include $templates."footer.php";

} else {
    header('Location: index.php');
	exit(); 
}
?>