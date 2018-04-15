
<?php
/* Start Our Functions .. Let's go */

// setActive v1.0
// This Function To Set Class active in <li>
// $page Parameter For Know Page
function setActive($page){
    global $active;
    if(isset($active)){
        if($active==$page){
            echo "active";
        }    
    } 
}


// getAllFrom v2.0
// This Function To Get All Data From Table
// $table Parameter For Name Table 
// $table Parameter For Conistraint  
function getAllFrom($table , $where=' '){
    global $con;
    $stmt = $con->prepare("	 SELECT * FROM $table  $where ");
    $stmt->execute();
    $items = $stmt->fetchAll();
    return $items;
}

// PrintItem v1.0
// This Function To Print Box Item
// $name Name Of Item
// $price Name Of Item
function PrintItem($name,$price,$imge='Default.PNG'){
    $w = $price/5;
    if(empty($imge)){ $imge = 'Default.PNG'; }
   echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 pull-right">';
   echo '<div class="item">';
        echo "<img src='data/upload/item/$imge' class='img-responsive center-block'>";
       echo '<ul class="list-unstyled">';
                echo '<li class="text-center">';
                    echo $name;  
            echo '</li>';
            echo '<li>';
                    echo "    $w :<span>سعر الوقية</span>";
            echo '</li>';
            echo '<li>';
            echo "        $price :<span>سعر الكيلو</span>";
            echo '</li>';
            if(isset($_SESSION['user'])){
                echo '<li class="text-center">';
                echo "<a href='#' class='btn btn-danger'>Delete <i class='fa fa-close'></i></a>";
                echo "<a href='#' class='btn btn-info'>Edit <i class='fa fa-edit'></i></a>";
                echo '</li>';
            }
        echo'</ul>';
    echo '</div>';
  echo '</div>';
}

// PrintAllItems v1.0
// This Function To Print All Items
function PrintAllItems(){
        echo '<div class="product-area ">';
        echo '<div class="items-box ">';
        echo '<div class="row">';
        $items =  getAllFrom("item");
            foreach($items as $item){ 
                PrintItem($item['Name'],$item['Price']);
                            } // end foreach
        echo "</div>  <!--End Div Product Area-->";
        echo "</div>  <!--End Div container-->"; 
        echo "</div>  <!--End Div item box-->";
}

// AddBreadcrumb v1.0
// This Function To Add breadcrumb in page
// $section Parameter For Name Current Section
function AddBreadcrumb($section){
        echo '<div class="container">';
                echo '<ol class="breadcrumb">';
               echo '<li><a href="dashboard.php">لوحة التحكم</a></li>';
               echo "<li class='active'>$section</li>" ;     
               echo '</ol>';
        echo '</div>'; 
}

// AutoBreadcrumb v2.0 
// This Function To Generate Auto breadcrumb in page
// $array array of link
function AutoBreadcrumb($array){
    echo '<div class="container">';
       echo '<ol class="breadcrumb">';
       foreach($array as $item)
           {
               if(!(end($array)==$item)){
                   echo '<li>';
                   echo  '<a href="'.$item['link'];
                   echo  '">';
                   echo $item['name'];
                   echo '</a></li>';
               }else{
               echo "<li class='active'>";
               echo $item['name'];
               echo "</li>";
            }       
           }  
       echo '</ol>';
    echo '</div>'; 
}


  // Check Item Function v1.0
  function checkItem($select , $from , $value){
    global $con;

    $statment = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
    $statment->execute(array($value));
    $count = $statment->rowCount();
    return $count;
}

  // getOneRecord Function v1.0
  // Get One Row From Any Table 
  function getOneRecord($select , $table , $where , $value){
    global $con;

	    $stmt = $con->prepare("SELECT $select FROM $table WHERE $where = ? LIMIT 1");
     	$stmt->execute(array($value));
        $item = $stmt->fetch();
    return $item;
}

// getLastRecord Function v1.0
// get last record from any table
function getLastRecord($select ,$table, $order){
    global $con;
    $stmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT 1");
     $stmt->execute();
    $item = $stmt->fetch();
return $item;
}

// query Function v1.0
// $select is the query
function query($select){
    global $con;
    $stmt = $con->prepare($select);
     $stmt->execute();
    $result = $stmt->fetchAll();
return $result;
}

// BillsTable Function v1.0
// $rows is array of contents
function BillsTable($rows){ 
    if(!empty($rows)){
    ?>
            <div class="container container-box">
            <div class="table-resposive">
                <table class="main-table table table-bordered text-center">
                <tr>
                    <td>رقم الفاتورة</td>
                    <td>التاريخ</td>
                    <td>اسم التاجر</td>
                    <td>نوع الفاتورة</td>
                    <td>القيمة</td>
                    <td>المحتويات</td>
                    <td>حذف أو تعديل</td>
                </tr>

                <?php

                foreach ($rows as $row) {
                        echo '<tr>';
                            echo '<td>'.$row['Number'].'</td>';
                            echo '<td>'.$row['Date'].'</td>';
                            echo '<td>'.$row['Name'].'</td>';
                            echo '<td>';
                                if($row['Buy_Sale']==1)
                                { echo "فاتورة مبيع"; }
                                else { echo "فاتورة شراء"; }
                            echo '</td>';
                            echo '<td>'.$row['Value'].'</td>';
                            echo '<td>';
                             echo "<a href='?action=bill&id=".$row['id']."'>التفاصيل</a>";
                            echo'</td>';
                            echo "<td>
                            <a href='bill.php?action=edit&billid=".$row['id']."' class='btn btn-success '><i class='fa fa-edit'></i> تعديل</a>
                            <a href='bill.php?action=delete&billid=".$row['id']."' class='btn btn-danger confirm'><i class='fa fa-close'></i> حذف</a>";
                            echo '</td>';
                        echo '</tr>';  	
                }
                
                ?>
                </table>	
            </div>
    <?php } else { ?>
            <div class="text-center message-no-bill"> <span>عذراً | </span>لا يوجد فواتير لعرضها</div>
    <?php  } // end else ?>
        </div>
<?php } // End Function BillsTable

// BillsTableVip Function v1.0
// $rows is array of contents
function BillsTableVip($rows){ 
    if(!empty($rows)){
    ?>
            <div class="container">
            <div class="table-resposive">
                <table class="main-table table table-bordered text-center">
                <tr>
                    <td>رقم الفاتورة</td>
                    <td>التاريخ</td>
                    <td>نوع الفاتورة</td>
                    <td>القيمة</td>
                    <td>المحتويات</td>
                </tr>

                <?php

                foreach ($rows as $row) {
                        echo '<tr>';
                            echo '<td>'.$row['Number'].'</td>';
                            echo '<td>'.$row['Date'].'</td>';
                            echo '<td>';
                                if($row['Buy_Sale']==1)
                                { echo "فاتورة مبيع"; }
                                else { echo "فاتورة شراء"; }
                            echo '</td>';
                            echo '<td>'.$row['Value'].'</td>';
                            echo '<td>';
                             echo "<a href='bill.php?action=bill&id=".$row['id']."'>التفاصيل</a>";
                            echo'</td>';
                        echo '</tr>';  	
                }
                
                ?>
                </table>	
            </div>
    <?php } else { ?>
            <div class="text-center message-no-bill"> <span>عذراً | </span>لا يوجد فواتير لعرضها</div>
    <?php  } // end else ?>
        </div>
<?php } // End Function BillsTableVip

// CashTable Function v1.0
// $rows is array of contents
function CashTable($rows){ 
    echo '<div class="container">';
    if(!empty($rows)){
    ?>
            
            <div class="table-resposive">
                <table class="main-table table table-bordered text-center cash-tabel">
                <tr>
                    <td class="date-col">التاريخ</td>
                    <td class="date-col">القيمة</td>
                </tr>

                <?php

                foreach ($rows as $row) {
                        echo '<tr>';
                            echo '<td>'.$row['Date'].'</td>';
                            echo '<td>'.$row['Value'].'</td>';
                        echo '</tr>';  	
                }
                
                ?>
                </table>	
            </div>
    <?php } else { ?>
            <div class="text-center message-no-bill"> <span>عذراً | </span>لا يوجد بيانات لعرضها</div>
    <?php  } // end else ?>
        </div>

<?php } // End Function CashTable

// BillsInventoryTable Function v1.0
// $rows is array of contents
function BillsInventoryTable($rows){
    if(!empty($rows)){
        ?>
                <div class="container container-box">
                <div class="table-resposive">
                    <table class="main-table table table-bordered text-center">
                    <tr>
                        <td class="date-col">التاريخ</td>
                        <td>المواد</td>
                        <td class="date-col">حذف</td>
                    </tr>
    
                    <?php

                    foreach ($rows as $row) {
                        global $con;
                         $stmt = $con->prepare("select b.Ammount , i.Name From bill_inventory b inner join item i on b.item_id = i.id AND b.inventory_id = ?");
                         $stmt->execute(array($row['id']));
                         $items = $stmt->fetchAll();
                            echo '<tr>';
                                echo '<td>'.$row['Date'].'</td>';
                                echo '<td>';
                                 foreach ($items as $item){
                                    echo '<span>';
                                    echo $item['Name'].' ('.$item['Ammount'].')';
                                    if(!(end($items)==$item)){
                                        echo ' - ';
                                    }
                                    echo '</span>';
                                 }
                                echo '</td>';
                                echo "<td>
                                      <a href='bill.php?action=delete&billinventory=".$row['id']."' class='btn btn-danger btn-block confirm'><i class='fa fa-close'></i> حذف</a>";
                                echo '</td>';
                            echo '</tr>';  	
                    }
                    
                    ?>
                    </table>	
                </div>
        <?php } else { ?>
                <div class="text-center message-no-bill"> <span>عذراً | </span>لا يوجد فواتير لعرضها</div>
        <?php  } // end else ?>
            </div>
    <?php } // End Function BillsInventoryTable

// Sales Function v1.0
// $rows is array of contents
function Sales($rows){
    if(!empty($rows)){
        ?>
                <div class="container container-box">
                <div class="table-resposive">
                    <table class="main-table table table-bordered text-center">
                    <tr>
                        <td class="date-col">التاريخ</td>
                        <td>المادة</td>
                        <td>السعر</td>
                        <td class="date-col">حذف</td>
                    </tr>
    
                    <?php

                    foreach ($rows as $row) {
                            echo '<tr>';
                                echo '<td>'.$row['Date'].'</td>';
                                echo '<td>'.$row['Name'].'</td>';
                                echo '<td>'.$row['Price'].'</td>';
                                echo "<td>
                                      <a href='bill.php?action=delete&sales=".$row['id']."' class='btn btn-danger btn-block confirm'><i class='fa fa-close'></i> حذف</a>";
                                echo '</td>';
                            echo '</tr>';  	
                    }
                    
                    ?>
                    </table>	
                </div>
        <?php } else { ?>
                <div class="text-center message-no-bill"> <span>عذراً | </span>لا يوجد مشتريات لعرضها</div>
        <?php  } // end else ?>
            </div>
    <?php } // End Function Sales

// BillRecord Function v1.0
// $info array of information bill
// $items array of items
function BillRecord($info , $items){ ?>
 <div class="container container-box">
    <div class="row">
        <div class="col-md-6 items">
        <h2 class=" text-center">المواد</h2> 
        <hr class="custom-hr">
            <div class="row text-center">
                 <div class="col-md-4">
                       <h4>السعر</h4><hr class="custom-hr2">
                       <?php foreach($items as $item){
                            echo "<span>";
                            echo $item['Price'];
                            echo "</span>";
                        }
                       ?>
                 </div> 
                 <div class="col-md-4">
                       <h4>الكمية</h4><hr class="custom-hr2">
                       <?php foreach($items as $item){
                            echo "<span>";
                            echo $item['Ammount'];
                            echo "</span>";
                        }
                       ?>
                 </div>
                 <div class="col-md-4">
                       <h4>المادة</h4><hr class="custom-hr2">
                       <?php foreach($items as $item){
                            echo "<span>";
                            echo $item['Name'];
                            echo "</span>";
                        }
                       ?>
                 </div>
                 <hr class="custom-hr-plus">
                 
                 <h3 class="text-center custom-price"> 
                 <span> ليرة سورية </span>        
                    <span> <?php echo "   ".$info['Value']; ?></span>
                    
                 </h3>
                 
            </div>   
        </div>
        <div class="col-md-6 item-info">
          <h2> <?php echo " فاتورة رقم ". $info['Number']; ?> </h2>
          <p> 
               <?php 
                    if($info['Buy_Sale']==1)
                    { echo "مبيعات"; }
                    else { echo "شراءات"; }
                ?> 
          </p>
          <ul class="list-unstyled">
          <li>     
              <?php echo $info['Date']; ?>   
              :<span>تاريخ الفاتورة</span>
              <i class="fa fa-calendar fa-fw"></i>
          </li>

          <li> 
              <?php echo $info['Value']; ?>
              :<span>السعر</span>
              <i class="fa fa-money fa-fw"></i>
          </li>

          <li>
               <?php echo $info['Number'];  ?>
               :<span>رقم الفاتورة</span> 
               <i class="fa fa-building fa-fw"></i>       
          </li>

          <li> 
                <?php 
                    if($info['Buy_Sale']==1)
                    { echo "فاتورة مبيع"; }
                    else { echo "فاتورة شراء"; }
                ?> 
               :<span>نوع الفاتورة</span>  
               <i class="fa fa-tags fa-fw"></i>                
          </li>

          <li>   
               <a href="#"> <?php echo $info['Name']; ?> </a>
               :<span>اسم التاجر</span>
               <i class="fa fa-user fa-fw"></i> 
          </li>
          </ul>
        </div>
    </div>
<?php } // End Function BillRecord


// VipInfo Function v1.0
// $info array of information vip
// $bills array of bills 
// $cash array of cash payment
function VipInfo($info , $bills , $cash){ ?>
 <div class="container container-box">
    <div class="row">
        <div class="col-lg-offset-3 col-md-6 item-info">
          <h2 class="text-center"> <?php echo "السيد ". $info['Name']; ?> </h2>

          <ul class="list-unstyled" style="margin-top:20px;">
          <li>     
              <?php echo $info['Address']; ?>   
              :<span>العنوان</span>
              <i class="fa fa-calendar fa-fw"></i>
          </li>

          <li> 
              <?php echo $info['Phone'];; ?>
              :<span>الهاتف</span>
              <i class="fa fa-money fa-fw"></i>
          </li>

          <li>
               <?php echo $info['Balance'];;  ?>
               :<span>الذمة المالية</span> 
               <i class="fa fa-building fa-fw"></i>       
          </li>

          </ul>
        </div>
    </div>
    <hr class="custom-hr2">

     	<div class="bills">
            <h1 class="text-center" style="margin-bottom: 20px;">
            الفواتير
            </h1>
             <?php BillsTableVip($bills); ?>
        </div>
    <hr class="custom-hr2">
    
     	<div class="cash">
            <h1 class="text-center">
                الدفعات النقدية
             </h1>
             <?php  CashTable($cash) ?>
        </div>
</div>


<?php } // end function VipInfo()

// VipInfo Function v1.0
// $info array of information vip
// $bills array of bills 
// $cash array of cash payment
function EmpInfo($info , $bills , $cash){ ?>
    <div class="container container-box">
       <div class="row">
           <div class="col-lg-offset-3 col-md-6 item-info">
             <h2 class="text-center"> <?php echo "السيد ". $info['Name']; ?> </h2>
   
             <ul class="list-unstyled" style="margin-top:20px;">
             <li>     
                 <?php echo $info['Address']; ?>   
                 :<span>العنوان</span>
                 <i class="fa fa-calendar fa-fw"></i>
             </li>
   
             <li> 
                 <?php echo $info['Phone'];; ?>
                 :<span>الهاتف</span>
                 <i class="fa fa-money fa-fw"></i>
             </li>
   
             <li>
                  <?php echo $info['Balance'];;  ?>
                  :<span>الذمة المالية</span> 
                  <i class="fa fa-building fa-fw"></i>       
             </li>
   
             </ul>
           </div>
       </div>
   
       <hr class="custom-hr2">
   
            <div class="bills">
               <h1 class="text-center" style="margin-bottom: 20px;">
               السلف المسحوبة
               </h1>
                <?php CashTable($bills); ?>
           </div>
       <hr class="custom-hr2">
       
            <div class="cash">
               <h1 class="text-center">
                   الدفعات النقدية
                </h1>
                <?php  CashTable($cash) ?>
           </div>

   </div>
   
<?php } // end function EmpInfo


  // Count Number Of Items Function v1.0
  function countItem($item , $table){
    global $con;

    $statment = $con->prepare("SELECT COUNT($item) FROM $table");
    $statment->execute();
    return $statment->fetchColumn();
  }

    // Sum Number Of Items Function v1.0
    function sumItem($item , $table){
        global $con;
    
        $statment = $con->prepare("SELECT sum($item) FROM $table");
        $statment->execute();
        return $statment->fetchColumn();
      }

    // resultBox Function v1.0
    // nice square to show number
    function resultBox($num){ ?>
        <div class="center-block text-center alert-danger resultBox">
            <?php echo $num; ?>
        </div>
 <?php   } // end resultBox


?>