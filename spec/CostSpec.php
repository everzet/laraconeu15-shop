<?php

namespace spec;

use Cost;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CostSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromFloat', [20.3]);
    }

    function it_can_tell_if_it_is_the_same_as_provided_cost()
    {
        $this->equals(Cost::fromFloat(20.3))->shouldReturn(true);
        $this->equals(Cost::fromFloat(20.4))->shouldReturn(false);
    }
}
