<?php
interface Subjects{
    public function attach(Observers $observers);
    public function dettach(Observers $observers);
    public function notify();
}

class Subject implements Subjects{
    public $sub = array();
    public function attach(Observers $observers)
    {
        // TODO: Implement attach() method.
        return array_push($this->sub,$observers);
    }
    public function dettach(Observers $observers)
    {
        // TODO: Implement dettach() method.
        $index = array_search($observers, $this->sub);
        if ($index === FALSE || ! array_key_exists($index, $this->sub)) {
            return FALSE;
        }

        unset($this->sub[$index]);
        return TRUE;

    }
    public function notify()
    {
        // TODO: Implement notify() method.
        if(!is_array($this->sub)){
            return;
        }
        foreach ($this->sub as $v){
            $v->update();
        }
    }
}

interface  Observers{
    public function update();
}

class Observer implements Observers{
    public $name="";
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function update()
    {
        // TODO: Implement update() method.
        echo $this->name;
    }
}

$subjects = new Subject();
$observers1 = new Observer("111");
$subjects->attach($observers1);
$subjects->notify();
$observers2 = new Observer("2222");
$subjects->attach($observers2);
$subjects->notify();
$subjects->dettach($observers1);
$subjects->notify();
