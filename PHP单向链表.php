<?php
class Hero{
    public $no;
    public $name;
    public $nickname;
    public $next=null;
    public function __construct($no='',$name='',$nickname=''){
        $this->no=$no;
        $this->name=$name;
        $this->nickname=$nickname;
    }
}
class LinkListDemo{
    public static function main(){
        $head=new Hero();
        $hero1=new Hero(1,"宋江","及时雨");
        $head->next=$hero1;
        $hero2=new Hero(2,"卢俊义","玉麒麟");
        $hero1->next=$hero2;
        LinkListDemo::showHeros($head);
    }
    /**
     * 展示英雄
     */
    public static function showHeros($head){
        $cur=$head;
        while($cur->next!=null){
            echo "姓名：".$cur->next->name."<br/>";
            $cur=$cur->next;
        }
    }

    //

}

LinkListDemo::main();