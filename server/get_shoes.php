<?php

include('connect.php');

$stm=$conn->prepare("select * from products where product_category='shoes' limit 4");

$stm->execute();

$shoes=$stm->get_result();  //it  store an array here

?>