<?php

include('connect.php');

$stm=$conn->prepare("select * from products where product_category='coats' limit 4");

$stm->execute();

$coats_products=$stm->get_result();  //it  store an array here

?>