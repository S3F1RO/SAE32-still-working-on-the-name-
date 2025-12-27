<?php

  include_once("MMR.php");

  class Block {
    public int $index;
    public string $previousHash;
    public string $mmrRoot;
    public int $blockTimestamp;

    public function __construct(int $index, string $previousHash, string $mmrRoot) {
      $this->index = $index;
      $this->previousHash = $previousHash;
      $this->mmrRoot = $mmrRoot;
      $this->blockTimestamp = time();
    }

    public function hash(): string {
      return hash(
        "sha256",
        $this->index .
        $this->previousHash .
        $this->mmrRoot .
        $this->blockTimestamp
      );
    }
  }


  class Transaction {
    

      
    
  }

?>