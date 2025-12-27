<?php
include_once("./node.php");

class MMR {
    public $nodes;

    function __construct(){
        $this->nodes = [];
        $this->nodes[] = new Node(0,"xxc",1,NULL,NULL,true);
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
        $leaf=$this->addNode($nodeHash,$level);                  // SULYVAN "$level" is not defined here same in addParent
        $this->recursivelyAddParentFromNode($leaf); 
    }

    function getPeakOfLevel($level){
        foreach ($this->nodes as $node){
            //Get level of each node
            if ($this->getNodeLevel($node->level) == $level){
                //Check if peak
                if ($node->isPeak) return $node;
                else return NULL;
            };
        }
    }

    function getLastNodeId(){
        return count($this->nodes);
    }

    function getNextLeafId($leafId){
        while ($this->getLastNodeId() <= $leafId) {
            $this->addLeaf($this->getLastNodeId(),"",NULL,NULL,true);
        }
        return getLastNodeId()+1;
    }

    function addNode($hash,$level,$idChild1=NULL,$idChild2=NULL){
        $this->nodes[] = new Node($this->getLastNodeId()+1,"$hash",$level,$idChild1,$idChild2);
        return $lastId;                                                                 // SULYYYYY WHO IS THIS F*CKING $lastId
    }

    function recursivelyAddParentFromNode($idNode){
        $peak=$this->getPeakOfLevel()->id;
        $this->addParent($peak,$idNode);
        if ($peak) return recursivelyAddParentFromNode($peak);
        else return NULL;
    }

    function addParent($idChild1=NULL,$idChild2=NULL){
        //Get parent hash based 
        $level+=1;                                                          // $level ??? idk what is this
        $parentNodeHash = hash("sha256",$this->nodes[$idChild1]->hash.$this->nodes[$idChild2]->hash);
        $this->nodes[$idChild1]->isPeak = false;
        $this->nodes[$idChild2]->isPeak = false;

        $this->addNode($parentNodeHash,$level,$idChild1,$idChild2);
        echo $parentNodeHash;

    }

}
$testNode = new Node(1,"xxc",1,NULL,NULL,true);
$testNode2 = new Node(1,"xxc",1,1,2,true);
$testPeak = new Node(2,"xxc",2,0,1,true);

$MMR = new MMR();
$MMR->addLeaf("xxx");
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
echo "-----------------Get MMR-------------------\n";
echo json_encode($MMR,JSON_PRETTY_PRINT);
echo $MMR->getLastNodeId();
// echo "\n-----------------Get Node------------------\n";
// echo json_encode($node0,JSON_PRETTY_PRINT);
// echo "\n-----------------Get Peak Of Level------------------\n";

// $peakNode=$MMR->getPeakOfLevel(1);
// $peakNode=$MMR->getNodeHash($peakNode->idNode);
// echo json_encode($peakNode,JSON_PRETTY_PRINT);
// $MMR->addParent(1,2);
?>