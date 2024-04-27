<?php

class Order
{
  private $id;
  private $total_amount;
  private $notes;
  private $status;
  private $date;

  private $roomId;

  private $total_quantity;

  public function __construct($total_amount, $notes, $status, $date, $total_quantity)
  {
    $this->total_amount = $total_amount;
    $this->notes = $notes;
    $this->status = $status;
    $this->date = $date;
    $this->total_quantity = $total_quantity;
  }
  public function getId()
  {
    return $this->id;
  }

  public function getTotalAmount()
  {
    return $this->total_amount;
  }

  public function getNotes()
  {
    return $this->notes;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function getDate()
  {
    return $this->date;
  }

  public function getTotalQuantity()
  {
    return $this->total_quantity;
  }
  public function setTotalAmount($total_amount)
  {
    $this->total_amount = $total_amount;
  }

  public function setNotes($notes)
  {
    $this->notes = $notes;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function setDate($date)
  {
    $this->date = $date;
  }

  public function setTotalQuantity($total_quantity)
  {
    $this->total_quantity = $total_quantity;
  }
}
