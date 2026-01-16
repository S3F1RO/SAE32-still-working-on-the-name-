<?php

include_once("./MMR.php");

#data={"firstName":"zzz","lastName":"zzz","nickname":"zzz","passphrase":"zzz"}
class Transaction{
    public $id;
    public $hash;
    public $transactionTimeStamp;
    public $transactionType;
    public $hashData;
    public $data=[];


    function hashElements($elements=[]){
        $string2Hash="";
        // Get each elements into a string
        for ($i=0 ; $i<count($elements); $i++){
            $string2Hash.=$elements[$i];
        }
        // Hash this string and return it
        $hashedString=hash("sha256",$string2Hash);
        
        return $hashedString;
    }

    function  __construct($id,$transactionType,$data=[]){
        //Setting up the variables     
        $buffer="";
        $bufferData="";
        $now=date("Y-m-d H:i:s");
        $now = "2026-01-16 12:49:41"; 
        
        // Get the elements
        $this->id=$id;
        $this->transactionType=$transactionType;
        $this->data=$data;
        $this->transactionTimeStamp = $now;
        
        // Hash them
        $this->hashElements([$this->id,$this->transactionTimeStamp,$this->transactionType]);
        
        // Hash the Data
        foreach ($data as $key => $value) {
            $bufferData .= "$key.$value.";
        }
        $hashedData = hash("sha256",$bufferData);
        $this->hashData = $hashedData;

        //Hash the all
        $buffer =
            'id.' . $this->id . '.' .
            'timestp.' . $this->transactionTimeStamp . '.' .
            'type.' . $this->transactionType . '.' .
            'data.' . $this->hashData . '.';
        
        //Setting up the new Hash
        $hash = hash('sha256', $buffer);
        $this->hash = $hash;

    }

    function verifyTransaction(){
        $buffer="";
        $bufferData="";

        // Hash the Elements
        $this->hashElements([$this->id,$this->transactionTimeStamp,$this->transactionType]);
        
        //Hash The Data
        foreach ($this->data as $key => $value) {
            $bufferData .= "$key.$value.";
        }

        $hashedData = hash("sha256",$bufferData);

        //Hash the Transaction
        $buffer =
            'id.' . $this->id . '.' .
            'timestp.' . $this->transactionTimeStamp . '.' .
            'type.' . $this->transactionType . '.' .
            'data.' . $this->hashData . '.';

        $hash = hash('sha256', $buffer);
        
        return $hash == $this->hash;
    }

}
// $id = 1;
// $transactionType=1;
// $data = ["firstName"=>"zzA","lastName"=>"zzz","nickname"=>"zzz","passphrase"=>"zzz"];
// $transaction = new Transaction($id,$transactionType,$data);
// $transaction->verifyTransaction();
// echo json_encode($transaction,JSON_PRETTY_PRINT);

?>