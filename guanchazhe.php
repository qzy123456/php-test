<?php
//抽象目标类
abstract class Subject
{
    protected $stateNow;
    protected $observers = [];

    public function attach(Observer $observer)
    {
        array_push($this->observers, $observer);
    }

    public function detach(Observer $ob)
    {
        $pos = 0;
        foreach ($this->observers as $viewer) {
            if ($viewer == $ob) {
                array_splice($this->observers, $pos, 1);
            }
            $pos++;
        }
    }

    public function notify()
    {
        foreach ($this->observers as $viewer) {
            $viewer->update($this);
        }
    }
}
//具体目标类
class ConcreteSubject extends Subject
{
    public function setState($state)
    {
        $this->stateNow = $state;
        $this->notify();
    }

    public function getState()
    {
        return $this->stateNow;
    }
}
//抽象观察者
abstract class Observer
{
    abstract public function update(Subject $subject);
}
//具体观察者
class ConcreteObserverDT extends Observer
{
    private $currentState;

    public function update(Subject $subject)
    {
        $this->currentState = $subject->getState();

        echo '<div style="font-size:10px;">'. $this->currentState .'</div>';
    }
}
//使用观察者模式
class ConcreteObserverPhone extends Observer
{
    private $currentState;

    public function update(Subject $subject)
    {
        $this->currentState = $subject->getState();

        echo '<div style="font-size:20px;">'. $this->currentState .'</div>';
    }
}
class Client
{
    public function __construct()
    {
        $sub = new ConcreteSubject();

        $obDT = new ConcreteObserverDT();
        $obPhone = new ConcreteObserverPhone();

        $sub->attach($obDT);
        $sub->attach($obPhone);
        $sub->setState('Hello World');
    }
}

$worker = new Client();

