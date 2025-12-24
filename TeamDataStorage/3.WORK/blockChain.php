<?php

  include_once("MMR.php");

  class Block {
    public int $index;
    public string $previousHash;
    public string $mmrRoot;
    public int $timestamp;

    public function __construct(int $index, string $previousHash, string $mmrRoot) {
      $this->index = $index;
      $this->previousHash = $previousHash;
      $this->mmrRoot = $mmrRoot;
      $this->timestamp = time();
    }

    public function hash(): string {
      return hash(
        "sha256",
        $this->index .
        $this->previousHash .
        $this->mmrRoot .
        $this->timestamp
      );
    }
  }


  class Transaction {
    

      
    
  }

?>