<?php
class Sql{
    private $sql=array("from"=>"",
        "where"=>"",
        "order"=>"",
        "limit"=>"");

    public function from($tableName) {
        $this->sql["from"]="FROM ".$tableName;
        return $this;
    }

    public function where($_where='1=1') {
        $this->sql["where"]="WHERE ".$_where;
        return $this;
    }

    public function order($_order='id DESC') {
        $this->sql["order"]="ORDER BY ".$_order;
        return $this;
    }

    public function limit($_limit='5') {
        $this->sql["limit"]="LIMIT 0,".$_limit;
        return $this;
    }
    public function select($_select='*') {
        return "SELECT ".$_select." ".(implode(" ",$this->sql));
    }
}

$sql =new Sql();

echo $sql->from("blog")->where("id=1")->order("id DESC")->limit(10)->select();
//输出 SELECT * FROM blog WHERE id=1 ORDER BY id DESC LIMIT 0,10