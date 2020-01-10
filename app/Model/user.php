<?php
error_reporting(E_ERROR | E_PARSE);
include("../lib/db.php");
include("../lib/global.php");
class User extends Table{
    public $username;
    public $email;
    public function Token(){
        $temp=$this->select('token')
            ->where("username",$this->username)
            ->exec()->result->fetch_assoc();
        return json_encode($temp['token']);
    }
    public function Code(){
        $temp=$this->select('code')
            ->where("username",$this->username)
            ->exec()->result->fetch_assoc();
        return json_encode($temp['code']);
    }
    function __construct($user=null){
        if($user!=null){
            $temp=$this->selectAll()
            ->where("username",$user)
            ->exec()->result->fetch_assoc();
        $this->username=$temp['username'];
        $this->email=$temp['email'];
        }
        
    }
    public function getData(){
        $tmp;
        $tmp2=$this->select("count(*) as jumlah")
            ->where("verify","y")->exec()->fetch();
        // array_push($tmp,$tmp2[0]['jumlah']);
        $tmp->verify=$tmp2[0]['jumlah'];
        $tmp2=$this->select("count(*) as jumlah")
            ->where("verify","N")->exec()->fetch();
        // array_push($tmp,$tmp2[0]['jumlah']);
        $tmp->not=$tmp2[0]['jumlah'];
        // array_push($tmp,$tmp[0]+$tmp[1]);
        $tmp->all=$tmp->verify+$tmp->not;
        return json_encode($tmp);
    }
    public function getStatus(){
        $tmp=$this->select('verify as v')->where("username",$this->username)
        ->exec()->fetch();
        return $tmp[0]['v'];
    }

}

