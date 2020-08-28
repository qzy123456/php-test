<?php

class Unlimited{
    protected $mysqli;
    public function __construct(){
        $this->mysqli=new mysqli("127.0.0.1","root","root");
        $this->mysqli->select_db('test');
        $this->mysqli->set_charset('utf8');
        if ($this->mysqli->connect_errno) {
            echo $this->mysqli->connect_error;
        }
    }

    private function getList($pid=0,&$result=array(),$spac=0){
        $spac=$spac+2;
        $sql="select * from onepiece where pid={$pid}";
        $rs=$this->mysqli->query($sql);
        while($row=$rs->fetch_assoc()) {
            $row['name']=str_repeat('&nbsp;&nbsp',$spac).$row['name'];
            $result[]=$row;
            $this->getList($row['id'],$result,$spac);
        }
        return $result;
    }
    /**
     * 展现下拉列表式分类
     * @return [type]
     */
    public function displayList(){
        $rs=$this->getList();
        $str="<select name='cate'>";

        foreach ($rs as $key => $val) {
            $str.="<option >{$val['name']}</option>";
        }
        $str.="</select>";
        return $str;
    }

    private function getLink($cid,&$result=array()){
        $sql="select * from onepiece where id={$cid}";
        $rs=$this->mysqli->query($sql);
        if($row=$rs->fetch_assoc()){
            $result[]=$row;
            $this->getLink($row['pid'],$result);
        }
        return array_reverse($result);
    }
    /**
     * 展现导航Link
     * @param  [type] $cid [description]
     * @return [type]      [description]
     */
    public function displayLink($cid){
        $rs=$this->getLink($cid);
        $str='';
        foreach ($rs as $val) {
            $str.="<a href=''>{$val['name']}</a>>";
        }

        return $str;
    }
    /**
     * 增加分类
     * @param [type] $pid  父类id
     * @param [type] $name 本类名
     */
    public function addNodes($pid,$name){
        $sql="insert into onepiece values('',{$pid},'".$name."')";
        if($this->mysqli->query($sql)){

            return true;

        }
    }
    /**
     * 删除分类
     * @param  [type] $id 本类id
     * @return [type]
     */
    public function deleteNodes($id){
        $sql="select * from onepiece where pid ={$id}";
        $rs=$this->mysqli->query($sql);
        if($row=$rs->fetch_assoc()){
            $mes="还有子元素，请勿删除";
        }else{
            $sql="delete from onepiece where id={$id}";
            if($this->mysqli->query($sql)){
                $mes="删除成功";
            }
        }
        return $mes;
    }
}

$unlimit = new Unlimited();
echo  $unlimit->displayList();
echo $unlimit->displayLink(12);
