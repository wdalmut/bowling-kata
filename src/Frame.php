<?php

class Frame
{
    private $rolls;

    public function addRoll(Ball $ball)
    {
        $this->rolls[] = $ball->getKnockedPins();
    }

    public function getScore()
    {
        return array_sum($this->rolls);
    }

    public function isSpare()
    {
        if (count($this->rolls) == 2 && $this->getScore() == 10) {
            return true;
        }

        return false;
    }

    public function isStrike()
    {
        if (count($this->rolls) == 1 && $this->getScore() == 10) {
            return true;
        }

        return false;
    }

    public function firstBallKnockedPins()
    {
        return $this->rolls[0];
    }
}
