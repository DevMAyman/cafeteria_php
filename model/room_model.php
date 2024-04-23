<?php

class Room {
    private $id;
    private $roomNumber;
    private $roomName;
    private $isBusy;
    
    public function __construct($roomNumber, $roomName, $isBusy) {
        $this->roomNumber = $roomNumber;
        $this->roomName = $roomName;
        $this->isBusy = $isBusy;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getRoomNumber() {
        return $this->roomNumber;
    }
    
    public function setRoomNumber($roomNumber) {
        $this->roomNumber = $roomNumber;
    }
    
    public function getRoomName() {
        return $this->roomName;
    }
    
    public function setRoomName($roomName) {
        $this->roomName = $roomName;
    }
    
    public function getIsBusy() {
        return $this->isBusy;
    }
    
    public function setIsBusy($isBusy) {
        $this->isBusy = $isBusy;
    }
    
}

?>
