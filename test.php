<?php 

session_start();
$active="service";

if(isset($_SESSION['user'])){
    include "init.php";
    include $templates."header.php";
    include $templates."navbar-manager.php"; 
$action ='';
    if(isset($_GET['action'])){
		$action = $_GET['action']; 
	}
	else {
		$action = 'manage';
    }
     $link ;
    $link=array(array("link"=>"#","name"=>"لوحة التحكم"),
           array("link"=>"#","name"=>"الخدمات"));


    
    if($action == 'manage'){?>
        <h1>manage</h1>

    <?php }elseif ($action == 'test') {
        array_push($link,array('link'=>'#','name'=>'1')); ?>
        <h1>test</h1>
    <?php }
    elseif ($action == 'test1') {
        array_push($link,array('link'=>'#','name'=>'2'));
       // AutoBreadcrumb($link);
        if(isset($_GET['lolo'])){
            $lolo = $_GET['lolo']; 
            if($lolo==1){
                array_push($link,array('link'=>'#','name'=>'lolo'));
                 
            }
    }}



$age=array(array("link"=>"#","name"=>"لوحة التحكم"),
           array("link"=>"#","name"=>"المنتجات"),
           array("link"=>"#","name"=>"بزر اسود"),
           array("link"=>"#","name"=>"ايراني"));

           AutoBreadcrumb($link); 

    include $templates."footer.php";

} else {
    header('Location: index.php');
	exit(); 
}