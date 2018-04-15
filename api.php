<?php


include "init.php";
include $templates."header.php";
 $result =  $users = getAllFrom("item");    
                        

 echo json_encode($result);

 
?>

<script>
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML = myObj.name;
    }
};
xmlhttp.open("GET", "api.php", true);
xmlhttp.send();
</script>