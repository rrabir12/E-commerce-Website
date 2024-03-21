<?php

include('connect.php');

$stm=$conn->prepare("select * from products limit 4");

$stm->execute();

$featured_products=$stm->get_result();

?>