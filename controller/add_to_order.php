<?php
require_once '../base.php';
require_once './order_item_controller.php';

$orderItemController = new OrderItemController();
$orderItemController->addOrderItem();

?>
