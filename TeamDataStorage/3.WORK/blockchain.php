<?php

  include_once("MMR.php");
  include_once("transactions.php");
  include_once("block.php");
  include_once("dataStorageWrapper.php");


  class Blockchain {
    // The blockchain will be the database we're going to use
    public array $chain = [];
    private MMR $stateTree;
    private MMR $MMR;

    public function __construct() {
        $this->stateTree = new MMR(); // This is for the transaction state tree
        $this->MMR = new MMR(); // This is for the block state tree
        $this->chain[] = $this->createGenesisBlock();
    }

    private function createGenesisBlock(): Block {
        //Create a first Transaction
        $firstTransaction = new Transaction(0, "GENESIS", ["GENESIS"=>"Start"]);
        $transactions[] = $firstTransaction;
        $firstTransaction->transactionTimeStamp = "2026-01-16 12:49:41";

        //Add the first leaf
        $this->stateTree->addLeaf($firstTransaction->hash);
        $this->MMR->addLeaf(hash("sha256","GENESIS"));
        $merkleRoot  = $this->MMR->getRootHash();
        
        //Create the block
        $header = new BlockHeader(0, "0", $merkleRoot);
        $block = new Block($header,$transactions);
        
        // Add his Hash to the MMR
        $this->MMR->addLeaf($block->getHash());
        $block->header->mmrRoot = $this->MMR->getRootHash();
        $block->header->blockTimestamp = "2026-01-16 12:49:41";

        return $block;
    }

    public function verifyBlock(Block $block): bool {

      // If the hash is not the same we can just trash the block
      if (!$block->verifyBlockIntegrity()) return false;
      
      // Check if the index is the next index
      $index = count($this->chain);
      if ($block->header->index != $index) return false;
  
      // Check timestamp diff (blocktimestp > blockn-1timestp)   
      $timestpPrevIndex = strtotime($this->chain[$index-1]->header->blockTimestamp);
      $block->header->blockTimestamp = date("Y-m-d H:i:s");
      $timestp = strtotime($block->header->blockTimestamp);
      $diffSeconds = abs($timestp - $timestpPrevIndex);
      if ($timestp <= $timestpPrevIndex) return false;

      // Check if merkleRoot is the same
      if ($block->header->mmrRoot != $this->MMR->getRootHash()) return false;
      
      // Check if the hash of block n-1 corresponds
      if ($block->header->previousHash != $this->chain[$index-1]->header->hash) return false;  

      return true;

    }

    public function addBlock(Block $block): int {
      if (!$this->verifyBlock($block)) return false;
      for ($i=0 ; $i<count($block->transactions) ; $i++){
        $transaction = $block->transactions[$i];
        echo json_encode($transaction,JSON_PRETTY_PRINT);
        $type = $transaction->transactionType;
        // Parsing Data based on the type
        $data = $transaction->data;
        // echo json_encode($data);
        if ($type == 0){
          $firstName = $data['firstName'];
          $lastName = $data['lastName'];
          $nickname = $data['nickname'];
          $pubU = $data['pubU'];
          $userInfosHashCryptPrivU = $data["userInfosHashCryptPrivU"];
          DataStorage::addVerifiedUser($firstName, $lastName, $nickname, $pubU, $userInfosHashCryptPrivU);
        }
        else if ($type == 1){
          $idUCreator = $data['idUCreator'];
          $mainName = $data['mainName'];
          $subName = $data['subName'];
          $domain = $data['domain'];
          $level = $data['level'];
          $imgUrl = $data['imgUrl'];
          $color = $data['color'];
          $skillInfosHashCryptPrivUC = $data['color'];
          DataStorage::addVerifiedSkill($idUCreator, $mainName, $subName, $domain, $level, $imgUrl, $color, $skillInfosHashCryptPrivUC);
        }
        else if ($type == 2){
          $idUCreator = $data['idUCreator'];
          $mainName = $data['mainName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          $firstName = $data['firstName'];
          DataStorage::addVerifiedCompetence($idUTeacher, $idUStudent, $idSkill, $revokedDate, $masteryLevel, $competenceInfosHashCryptPrivUT);
        }
      }
      return true;
    }
    public function writeBlockchain(){
      file_put_contents("blockchain.json", json_encode($this,JSON_PRETTY_PRINT));
    }

    public function loadBlockchain(){
      // load blockchain
      $json = file_get_contents("blockchain.json");
      $data = json_decode($json, true);
      print_r ($data);

    }
  }
  $blockchain = new Blockchain();
  $firstTransaction = new Transaction(0, "GENESIS", ["firstName"=>"zzA","lastName"=>"zzz","nickname"=>"zzz","passphrase"=>"zzz"]);
  $secondTransaction = new Transaction(0, "GENESIS", ["firstName"=>"zz2A","lastName"=>"z2zz","nickname"=>"z2zz","pass2phrase"=>"zzz"]);
  $transactions[] = $firstTransaction;
  $transactions[] = $secondTransaction; 
  sleep(1);
  $header = new BlockHeader(1, "a960e8e836eb51da4c4506f43dc494a9ddfb54dd22dbebde47f22c55010cc0fa", "78aabdaab6767cb50621a2c9e344b188925d055bfa859eb7292b98bd6d57fc72");
  $block = new Block($header,$transactions);
  // echo json_encode($blockchain->chain,JSON_PRETTY_PRINT);
  // echo $blockchain->verifyBlock($block);
  $blockchain->writeBlockchain();
  $blockchain->loadBlockchain();
  // echo $blockchain->addBlock($block);
?>