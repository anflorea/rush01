<?php
require_once ("IShip.class.php");
abstract class Ship implements IShip
{
    protected $_image;
    protected $_width;
    protected $_height;
    protected $_speed;
    protected $_maneuver;
    protected $_shield;
    protected $_projectiles;
    protected $_hp;
    protected $_pp;
    protected $_x;
    protected $_y;
    protected $_rotation;
    protected $_name;
    public static $verbose;
    
    public function printShip($turn, $active, $id, $rev)
    {

        if ($this->_hp > 0) {
            if ($turn == 1) //link wrapper
                echo "<a href='?activate=" . ($id + 1) . "''>";

            //ship
            echo '<img src="' . $this->_image . '"';
            echo ' class="ship" style="width: ' . $this->_width * 9 . 'px; height: ' . $this->_height * 9 . 'px;';
            echo ' top: ' . ($this->_y * 9 + 8) . 'px; left: ' . ($this->_x * 9 + 8) . 'px;';
            if ($rev)
                echo 'transform: scaleX(-1);';
            if ($active == $id && $turn == 1) {
                $_SESSION['pp'] = $this->_pp;
                $_SESSION['x'] = $this->_x;
                $_SESSION['y'] = $this->_y;
                $_SESSION['speed'] = $this->_speed;
                $_SESSION['shield'] = $this->_shield;
                $_SESSION['maneuver'] = $this->_maneuver;
                $_SESSION['projectiles'] = $this->_projectiles;
                $_SESSION['id'] = $id;
                echo 'border: 3px solid red;';
            }
            echo '">';

            if ($turn == 1) //link wrapper
                echo "</a>";

            //hp bar
            echo "<div id = 'hpbar' style='width: " . ($this->_hp * 9) . "px; top:" . ($this->_y * 9 + 4) . "px; ";
            echo "left: " . ($this->_x * 9 + 8) . ";'></div>\n";
        }
    }
    
    public function reduceProjectiles()
    {
        $this->_projectiles--;
    }
    
    //enhancers
    public function addSpeed($pp)
    {
        if ($pp <= $this->_pp)
        {
            $this->_pp -= $pp;
            $this->_speed += $pp;
        }
    }
    public function addShield($pp)
    {
        if ($pp <= $this->_pp)
        {
            $this->_pp -= $pp;
            $this->_shield += $pp;
        }
    }
    public function addWeapon($pp)
    {
        if ($pp <= $this->_pp)
        {
            $this->_pp -= $pp;
            $this->_projectiles += $pp;
        }
    }
    //getters
    public function damage($hp)
    {
        $this->_hp -= $hp;
    }
    public function move($dist, $rev)
    {
        if ($rev)
            $this->_x -= $dist;
        else
            $this->_x += $dist;
    }
    public function getImage()
    {
        return $this->_image;
    }
    public function getWidth()
    {
        return $this->_width;
    }
    public function getHeight()
    {
        return $this->_height;
    }
    public function getX()
    {
        return $this->_x;
    }
    public function getY()
    {
        return $this->_y;
    }
    public function getHp()
    {
        return $this->_hp;
    }
    public function __toString()
    {
        echo $this->_name;
    }
}

?>