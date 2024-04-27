<?php
include '../model/order_model.php';

function orderSanitizer(Order $order) {

  $total_amount = filter_var($order->getTotalAmount(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $order->setTotalAmount($total_amount);

  $notes = filter_var($order->getNotes(), FILTER_UNSAFE_RAW);
  $order->setNotes($notes);


  $status = $order->getStatus();
  $order->setStatus($status);

  $date = $order->getDate();
  $order->setDate($date);

  $total_quantity = filter_var($order->getTotalQuantity(), FILTER_SANITIZE_NUMBER_INT);
  $order->setTotalQuantity($total_quantity);
}

?>