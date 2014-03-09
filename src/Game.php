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

        $isSpare = false;
        $isStrike = false;
        foreach ($this->frames as $i => $frame) {
            $score += $frame->getScore();

            if ($isSpare) {
                $isSpare = false;

                $score += $frame->firstBallKnockedPins();
            }

            if ($isStrike) {
                $isStrike = false;
                $score += $frame->getScore();

                if ($i < 8) {
                    if ($frame->isStrike()) {
                        $score += $this->frames[$i+1]->firstBallKnockedPins();
                    }
                }
            }

            if ($frame->isSpare()) {
                $isSpare = true;
            }

            if ($frame->isStrike()) {
                $isStrike = true;
            }
        }

        return $score;
    }
}
