<?php
  include_once("MMR.php");

  class Block {
    public int $id;
    public float $timestamp;
    public string $data;
    public string $previousHash;
    public int $nonce = 0;
    public string $hash;
    public $header = [];

    public function __construct(int $index, string $data, string $previousHash) {
      $this->index = $index;
      $this->timestamp = microtime(true);
      $this->data = $data;
      $this->previousHash = $previousHash;
      $this->hash = $this->calculateHash();
    }

    public function calculateHash(): string {
      return hash(
        'sha256',
        $this->index .
        $this->timestamp .
        $this->data .
        $this->previousHash .
        $this->nonce
      );
    }
  }

?>