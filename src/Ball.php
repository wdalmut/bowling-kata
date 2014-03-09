<?php

class Ball
{
    private $knockedPins;

    public function __construct($knockedPins)
    {
        $this->knockedPins = $knockedPins;
    }

    public function getKnockedPins()
    {
        return $this->knockedPins;
    }
}
