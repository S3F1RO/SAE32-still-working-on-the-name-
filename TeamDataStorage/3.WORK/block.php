<?php

  include_once("MMR.php");
  include_once("transactions.php");

  // Block Header class to access the data
  class BlockHeader {
    public int $index;
    public string $previousHash;
    public string $mmrRoot;
    public string $blockTimestamp;
    public string $hash;
    public string $nonce;

    public function __construct(int $index, string $previousHash, string $mmrRoot) {
      $now = date("Y-m-d H:i:s");
      $now = "2026-01-16 12:49:41";  
      $this->index = $index;
      $this->previousHash = $previousHash;
      $this->mmrRoot = $mmrRoot;
      $this->blockTimestamp = $now;
      $this->nonce = "";
    }

  }

class Block {
  public BlockHeader $header;
  public array $transactions=[];

  public function __construct(BlockHeader $header, array $transactions = []) {
    $this->header = $header;
    $this->transactions = $transactions;
    $transactionBuffer="";
    $buffer = "";
    // Compute Hash
    for ($i=0 ; $i<count($transactions) ; $i++){
      if( $transactions[$i] -> verifyTransaction()) $transactionBuffer .= $transactions[$i]->hash;
    }
    $buffer .= $this->header->index . ".";
    $buffer .= $this->header->previousHash. ".";
    $buffer .= $this->header->mmrRoot . ".";
    $buffer .= $this->header->blockTimestamp . ".";
    $buffer .= $this->header->nonce . ".";
    $this->header->hash = hash('sha256', $buffer.$transactionBuffer);
  }

  public function getHash(){
    return $this->header->hash;
  }

  public function verifyBlockIntegrity(){
    $transactionBuffer="";
    $buffer = "";
    // Verify Hash and Compute Hash of each transaction
    for ($i=0 ; $i<count($this->transactions) ; $i++){
      if( $this->transactions[$i] -> verifyTransaction()) $transactionBuffer .= $this->transactions[$i]->hash;
    }
    //Compute the header buffer hash
    $buffer .= $this->header->index . ".";
    $buffer .= $this->header->previousHash. ".";
    $buffer .= $this->header->mmrRoot . ".";
    $buffer .= $this->header->blockTimestamp . ".";
    $buffer .= $this->header->nonce . ".";
    $computedHash = hash('sha256', $buffer.$transactionBuffer);
    return $computedHash == $this->header->hash;
  }
}

// $id = 1;
// $transactionType = 1;
// $data = ["firstName"=>"zzA","lastName"=>"zzz","nickname"=>"zzz","passphrase"=>"zzz"];
// $transaction = new Transaction($id,$transactionType,$data);
// $transaction2 = new Transaction(2,0,$data);                          
// $blockHeader = new BlockHeader("1","",$transaction->hash);
// $transactions[] = $transaction;
// $transactions[] = $transaction2;
// $block = new Block($blockHeader, $transactions);

// echo json_encode($block,JSON_PRETTY_PRINT);                               

?>