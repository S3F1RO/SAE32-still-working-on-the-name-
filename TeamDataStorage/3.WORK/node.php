#!/bin/php8.4
<?php

class Node {
    //members
    public $idNode;
    public $hash;
    public $level;
    public $idChild1;     // It would be better if called left and right !?!?!?
    public $idChild2;
    public $isPeak;

    function __construct($idNode,$hash,$level,$idChild1,$idChild2,$isPeak){
        $this->idNode = $idNode;
        $this->hash = $hash;
        $this->level = $level;
        $this->idChild1 = $idChild1;
        $this->idChild2 = $idChild2;
        $this->isPeak = $isPeak;
    }

}

// $testNode = new Node(1,"xxc","1","1","2",true);
// echo json_encode($testNode,JSON_PRETTY_PRINT);

?>