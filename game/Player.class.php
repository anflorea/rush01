<?php

require_once("DummyShip.class.php");

class Player
{
    private $_pid;
    private $_ships;

    public function __construct($pid)
    {
        $this->_pid = $pid;
    }
    public function fire()
    {
        $this->_ships[$_SESSION['id']]->reduceProjectiles();
    }
    public function addShip($ship)
    {
        $this->_ships[] = $ship;
    }
    public function damageShip($ship)
    {
        $this->_ships[$ship]->damage(5);
    }
    public function moveShip($distance)
    {
        $this->_ships[$_SESSION['id']]->move($distance, $this->_pid - 1);
    }
    public function addSpeed($pp)
    {
        $this->_ships[$_SESSION['id']]->addSpeed($pp);
    }
    public function addWeapon($pp)
    {
        $this->_ships[$_SESSION['id']]->addWeapon($pp);
    }
    public function addShield($pp)
    {
        $this->_ships[$_SESSION['id']]->addShield($pp);
    }
    public function printShips($turn, $active)
    {
        foreach ($this->_ships as $key=>$ship)
        {
            if ($this->_pid == $turn)
                $ship->printShip(1, $active, $key, $this->_pid - 1);
            else
                $ship->printShip(0, $active, $key, $this->_pid - 1);

        }
    }
    public function getShips()
    {
        foreach ($this->_ships as $key=>$ship)
            $ships[] = array('x'=>$ship->getX(), 'y'=>$ship->getY(), 'shipId'=>$key);
        return $ships;
    }
}