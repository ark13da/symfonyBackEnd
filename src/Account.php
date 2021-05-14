<?php


namespace App;


class Account
{
    private $balance;
    private $id;

    public function __construct($balance, $id){
        $this->balance = $balance;
        $this->id = $id;
    }


    public function getBalance()
    {
        return $this->balance;
    }
    public function getId()
    {
        return $this->id;
    }

    public function deposit(int $param)
    {
        if($param>0){
            $this->balance+=$param;
        }
        return $this->balance;
    }

    public function withdraw(int $param)
    {
        if($param<=$this->balance){
            $this->balance-=$param;
         }
        return $this->balance;
    }
}