<?php
require_once ("Ship.class.php");
class DummyShip extends Ship
{
    public function __construct($x, $y)
    {
        //ship specific data
        $this->_image = "assets/imperator.png";
        $this->_width = 7;
        $this->_height = 2;
        $this->_hp = 8;
        $this->_projectiles = 0;
        $this->_pp = 12;
        $this->_speed = 10;
        $this->_maneuver = 5;
        $this->_shield = 2;
        $this->_name = 'Dummy ship';

        //set initial position
        $this->_x = $x;
        $this->_y = $y;
        if (self::$verbose)
        {
            echo "$this->_name HAS ARRIVED\n";
        }
    }
}

?>