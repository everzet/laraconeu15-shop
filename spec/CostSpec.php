<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CostSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromFloat', [20.3]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Cost');
    }
}
