<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BallSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(4);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Ball');
    }

    function it_count_knocked_pins()
    {
        $this->getKnockedPins(4);
    }
}
