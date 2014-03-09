<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use \Ball;

class FrameSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Frame');
    }

    function it_shows_the_first_ball_balue(Ball $ball, Ball $ball2)
    {
        $ball->getKnockedPins()->willReturn(6);
        $ball2->getKnockedPins()->willReturn(4);

        $this->addRoll($ball);
        $this->addRoll($ball2);

        $this->firstBallKnockedPins()->shouldReturn(6);
    }

    function it_shows_the_frame_score(Ball $ball, Ball $ball2)
    {
        $ball->getKnockedPins()->willReturn(6);
        $ball2->getKnockedPins()->willReturn(4);

        $this->addRoll($ball);
        $this->addRoll($ball2);

        $this->getScore()->shouldReturn(10);
    }

    function it_identifies_a_spare(Ball $ball, Ball $ball2)
    {
        $ball->getKnockedPins()->willReturn(6);
        $ball2->getKnockedPins()->willReturn(4);

        $this->addRoll($ball);
        $this->addRoll($ball2);

        $this->isSpare()->shouldReturn(true);
    }

    function it_identifies_a_strike(Ball $ball)
    {
        $ball->getKnockedPins()->willReturn(10);

        $this->addRoll($ball);

        $this->isStrike()->shouldReturn(true);
    }
}
