<?php
include("../lib/db.php");
class log extends Table{
    public function getByMonth(){
        $tmp = $this->select("month(date) as bulan, count(*) as jumlah")
        ->group("month(date)")->exec()->fetch();
        return json_encode($tmp);
    }
    public function getData($count=0){
        if(!$count){
            $tmp = $this->select("date as tanggal, count(*) as jumlah")
            ->group("date")->exec()->fetch();
        }
        else{
            $tmp = $this->select("date as tanggal, count(*) as jumlah")
            ->group("date")->order("tanggal","desc")->limit($count)
            ->exec()->fetch();
        }
        
        return json_encode($tmp);
    }
};
?>