<?php

class Game
{
    private $frames;

    public function __construct()
    {
        $this->frames = array();
    }

    public function addFrame(Frame $frame)
    {
        $this->frames[] = $frame;
    }

    public function getScore()
    {
        $score = 0;

        foreach ($this->frames as $i => $frame) {
            $score += $frame->getScore();

            if ($this->previousFrameIsASpare($i)) {
                $score += $frame->firstBallKnockedPins();
            }

            if ($this->previousFrameIsAStrike($i)) {
                $score += $frame->getScore();

                if ($this->isNotTheLastFrame($i)) {
                    if ($frame->isStrike()) {
                        $score += $this->frames[$i+1]->firstBallKnockedPins();
                    }
                }
            }
        }

        return $score;
    }

    private function isNotTheLastFrame($i)
    {
        return ($i < 8);
    }

    private function previousFrameIsASpare($i)
    {
        return isset($this->frames[$i-1]) && $this->frames[$i-1]->isSpare();
    }

    private function previousFrameIsAStrike($i)
    {
        return isset($this->frames[$i-1]) && $this->frames[$i-1]->isStrike();
    }
}
