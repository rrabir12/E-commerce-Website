<?php

include('connect.php');

$stm=$conn->prepare("select * from products where product_category='watches' limit 4");

$stm->execute();

$watches=$stm->get_result();  //it  store an array here

?>



