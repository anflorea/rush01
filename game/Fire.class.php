<?php

trait Fire
{
    function fire($colliders)
    {
        $this->_players[$this->_turn - 1]->fire();
        for ($i = $this->$_SESSION['x']; $i < 150; $i++)
        {
            foreach ($colliders as $collider)
            {
                if ($collider['x'] == $i && ($collider['y'] >= $_SESSION['y'] - 1 && $collider['y'] <= $_SESSION['y'] + 1))
                    $this->_players[!($this->_turn - 1)]->damageShip($collider['shipId']);
            }
        }
        $this->_phase = 0;
        $this->_turn = !($this->_turn - 1) + 1;
        $this->_active = -1;
    }
}

?>