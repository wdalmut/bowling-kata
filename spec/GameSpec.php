<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use \Frame;

class GameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new \SplDoublyLinkedList());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Game');
    }

    function it_computes_a_simple_game_score(Frame $frame)
    {
        $frame->getScore()->willReturn(5);
        $frame->isSpare()->willReturn(false);
        $frame->isStrike()->willReturn(false);

        for ($i=0; $i<10; $i++) {
            $this->addFrame($frame);
        }

        $this->getScore()->shouldReturn(50);
    }

    function it_computes_a_game_score_with_a_spare(Frame $spare, Frame $frame)
    {
        $spare->getScore()->willReturn(10);
        $spare->isSpare()->willReturn(true);
        $spare->isStrike()->willReturn(false);

        $frame->getScore()->willReturn(6);
        $frame->isSpare()->willReturn(false);
        $frame->isStrike()->willReturn(false);
        $frame->firstBallKnockedPins()->willReturn(4);

        $this->addFrame($spare);
        $this->addFrame($frame);

        $this->getScore()->shouldReturn(20);
    }

    function it_computes_a_game_score_with_a_strike(Frame $strike, Frame $frame)
    {
        $strike->getScore()->willReturn(10);
        $strike->isSpare()->willReturn(false);
        $strike->isStrike()->willReturn(true);

        $frame->getScore()->willReturn(6);
        $frame->isSpare()->willReturn(false);
        $frame->isStrike()->willReturn(false);
        $frame->firstBallKnockedPins()->willReturn(4);

        $this->addFrame($strike);
        $this->addFrame($frame);

        $this->getScore()->shouldReturn(22);
    }

    function it_computes_a_game_score_with_two_consecutive_strikes(Frame $strike, Frame $frame)
    {
        $strike->getScore()->willReturn(10);
        $strike->isSpare()->willReturn(false);
        $strike->isStrike()->willReturn(true);

        $frame->getScore()->willReturn(6);
        $frame->isSpare()->willReturn(false);
        $frame->isStrike()->willReturn(false);
        $frame->firstBallKnockedPins()->willReturn(4);

        $this->addFrame($strike);
        $this->addFrame($strike);
        $this->addFrame($frame);

        $this->getScore()->shouldReturn(46);
    }

    function it_computes_a_game_score_with_three_consecutive_strikes(Frame $strike, Frame $frame)
    {
        $strike->getScore()->willReturn(10);
        $strike->isSpare()->willReturn(false);
        $strike->isStrike()->willReturn(true);
        $strike->firstBallKnockedPins()->willReturn(10);

        $frame->getScore()->willReturn(9);
        $frame->isSpare()->willReturn(false);
        $frame->isStrike()->willReturn(false);
        $frame->firstBallKnockedPins()->willReturn(0);

        $this->addFrame($strike);
        $this->addFrame($strike);
        $this->addFrame($strike);
        $this->addFrame($frame);

        $this->getScore()->shouldReturn(78);
    }

    function it_computes_the_perfect_game_score(Frame $strike, Frame $lastStrike)
    {
        $strike->getScore()->willReturn(10);
        $strike->isSpare()->willReturn(false);
        $strike->isStrike()->willReturn(true);
        $strike->firstBallKnockedPins()->willReturn(10);

        for ($i=0; $i<9; $i++) {
            $this->addFrame($strike);
        }

        $lastStrike->getScore()->willReturn(30);
        $lastStrike->isSpare()->willReturn(false);
        $lastStrike->isStrike()->willReturn(true);
        $lastStrike->firstBallKnockedPins()->willReturn(10);

        $this->addFrame($lastStrike);

        $this->getScore()->shouldReturn(300);
    }
}
