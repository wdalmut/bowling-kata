<?php

class Game
{
    private $frames;

    public function addFrame(Frame $frame)
    {
        $this->frames[] = $frame;
    }

    public function getScore()
    {
        $score = 0;

        foreach ($this->frames as $i => $frame) {
            $score += $frame->getScore();

            if (isset($this->frames[$i-1]) && $this->frames[$i-1]->isSpare()) {
                $score += $frame->firstBallKnockedPins();
            }

            if (isset($this->frames[$i-1]) && $this->frames[$i-1]->isStrike()) {
                $score += $frame->getScore();

                if ($i < 8) {
                    if ($frame->isStrike()) {
                        $score += $this->frames[$i+1]->firstBallKnockedPins();
                    }
                }
            }
        }

        return $score;
    }
}
