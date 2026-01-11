<?php
include_once("./node.php");

class MMR {
    public $nodes;

    function __construct(){
        $this->nodes = [];
        // $this->nodes[] = new Node(0,"xxcp",0,NULL,NULL,true);
    }
    function getNode($idNode){
        $node = $this->nodes[$idNode];
        return $node;
    }
    function getNodeLevel($idNode){
        $node=$this->getNode($idNode);
        return $node->level;
    }
    function getNodehash($idNode){
        $node=$this->getNode($idNode);
        return $node->hash;
    }

    function addLeaf($nodeHash=NULL){
        if ($nodeHash === NULL) $nodeHash = "leaf_".count($this->nodes);
        $level = 0; 
        $leaf = $this->addNode($nodeHash, $level, NULL, NULL, true); 
        $this->recursivelyAddParentFromNode($leaf);
    }

    function getPeakOfLevel($level,$idNode){
        foreach ($this->nodes as $node){
            //Get level of each node & Check if is Peak
            if ($this->getNodeLevel($node->idNode) == $level && $node->isPeak && $node->idNode !== $idNode) return $node;
        }
        return NULL;
    }

    function getRootHash(){
        return $this->getNodehash($this->getLastNodeId());
    }

    function getLastNodeId(){
        return count($this->nodes)-1;
    }

    function getNextLeafId($leafId){
        while ($this->getLastNodeId() <= $leafId) {
            $this->addLeaf();
        }
        return $this->getLastNodeId()+1;
    }

    function addNode($hash,$level,$idChild1=NULL,$idChild2=NULL,$isPeak=false){
        $newId = count($this->nodes);
        $this->nodes[] = new Node($newId,$hash,$level,$idChild1,$idChild2,$isPeak);
        return $newId;                                                             
    }

    function recursivelyAddParentFromNode($idNode){
        // Get Peak from Level
        $level = $this->getNodeLevel($idNode);
        $peak = $this->getPeakOfLevel($level,$idNode);

        if ($peak == NULL) {
            $this->nodes[$idNode]->isPeak = true;
            return;
        }
        // If there's no peak then there's no peak to add so node is peak else add anoter parent
        else{
            $parentID = $this->addParent($peak->idNode,$idNode);
            return $this->recursivelyAddParentFromNode($parentID);
        }
    }

    function addParent($idChild1=NULL,$idChild2=NULL){
        // Get parent hash based 
        if ($this->nodes[$idChild1] == NULL || $this->nodes[$idChild2] == NULL) return NULL;
        // Add the parent to the newt level
        $level = $this->nodes[$idChild1]->level+1;
        // Get hash from Children                                                       
        $parentNodeHash = hash("sha256",$this->getNodehash($idChild1).$this->getNodehash($idChild2));
        // Set the children to leaf since they're not the peak anymore
        $this->nodes[$idChild1]->isPeak = false;
        $this->nodes[$idChild2]->isPeak = false;

        $parentId = $this->addNode($parentNodeHash,$level,$idChild1,$idChild2,true);
        return $parentId;

    }

}


// Test
$MMR = new MMR();
$MMR->addLeaf("tx1");
$MMR->addLeaf("tx2");
$MMR->addLeaf("tx3");
$MMR->addLeaf("tx4");
$MMR->addLeaf("tx5");
$MMR->addLeaf("tx6");
$MMR->addLeaf("tx7");
$MMR->addLeaf("tx8");
// $MMR->addLeaf("tx9");
// echo json_encode($MMR);
echo json_encode($MMR,JSON_PRETTY_PRINT);

// ----------------------------------
// echo "Root: " . $MMR->getRoot() . "\n";
// print_r($MMR->nodes);
// $testNode = new Node(1,"xxc",1,NULL,NULL,true);
// $testNode2 = new Node(1,"xxc",1,1,2,true);
// $testPeak = new Node(2,"xxc",2,0,1,true);
echo "Root Hash : ",$MMR->getRootHash();
// $MMR = new MMR();
// $MMR->addLeaf("xxx");
// ----------------------------------
// $MMR->addLeaf($testNode2);
// $MMR->addLeaf($testPeak);
// $node0=$MMR->getNode(0);
// echo "-----------------Get Node Level -------------------\n";
// echo json_encode($MMR->getNodeLevel(0));
// echo "\n";
// echo json_encode($MMR->getNodeLevel(1));
// echo "\n";
// echo json_encode($MMR->getNodeLevel(2));
// echo "\n";
// echo json_encode($MMR,JSON_PRETTY_PRINT);
// ----------------------------------
// echo "-----------------Get MMR-------------------\n";
// echo json_encode($MMR,JSON_PRETTY_PRINT);
// echo $MMR->getLastNodeId();
// ----------------------------------
// echo "\n-----------------Get Node------------------\n";
// echo json_encode($node0,JSON_PRETTY_PRINT);
// echo "\n-----------------Get Peak Of Level------------------\n";

// $peakNode=$MMR->getPeakOfLevel(1);
// $peakNode=$MMR->getNodeHash($peakNode->idNode);
// echo json_encode($peakNode,JSON_PRETTY_PRINT);
// $MMR->addParent(1,2);
?>