<?php

require_once ("Player.class.php");
require_once ("Fire.class.php");
class Game
{
    private $_players;
    private $_turn;
    private $_phase;
    private $_active;
    
    public function __construct()
    {
        $this->_turn = 1;
        $this->_phase = 0;
        $this->newGame();
    }

    public function newGame()
    {
        //add players to array
        $this->_players[] = new Player(1);
        $this->_players[] = new Player(2);

        //add ships to each player in arbitrary positions
        $this->_players[0]->addShip(new DummyShip(2, 3));
        $this->_players[0]->addShip(new DummyShip(5, 6));
        $this->_players[0]->addShip(new DummyShip(3, 10));
        $this->_players[0]->addShip(new DummyShip(6, 13));
        $this->_players[0]->addShip(new DummyShip(5, 17));

        $this->_players[1]->addShip(new DummyShip(104, 3));
        $this->_players[1]->addShip(new DummyShip(101, 6));
        $this->_players[1]->addShip(new DummyShip(103, 10));
        $this->_players[1]->addShip(new DummyShip(100, 13));
        $this->_players[1]->addShip(new DummyShip(101, 17));


        //
        $this->_active = -1;
    }
    public function moveShip($dist)
    {
        $this->_players[$this->_turn - 1]->moveShip($dist);
        $this->_phase = 3;
    }
    public function printAllShips()
    {
        foreach ($this->_players as $player)
            $player->printShips($this->_turn, $this->_active);
    }
    public function getPhase()
    {
        return $this->_phase;
    }
    public function getPlayer()
    {
        return $this->_turn;
    }
    public function activate($active)
    {
        $this->_active = $active;
        $this->_phase = 1;
    }
    public function addSpeed($pp)
    {
        $this->_players[$this->_turn - 1]->addSpeed($pp);
        $this->_phase = 2;
    }
    public function addShield($pp)
    {
        $this->_players[$this->_turn - 1]->addShield($pp);
        $this->_phase = 2;
    }
    public function addWeapon($pp)
    {
        $this->_players[$this->_turn - 1]->addWeapon($pp);
        $this->_phase = 2;
    }
    public function skip()
    {
        if ($this->_phase == 3)
        {
            $this->_phase = 0;
            $this->_turn = !($this->_turn - 1) + 1;
            $this->_active = -1;
        }
        else
            $this->_phase++;
    }
    use fire;
    public function getCollision()
    {
        return $this->_players[!($this->_turn - 1)]->getShips();
    }
    public function __toString()
    {
        return ("awesome game");
    }

}