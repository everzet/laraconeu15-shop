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

    function it_can_tell_if_it_is_more_than_provided_cost()
    {
        $this->shouldBeMoreThan(Cost::fromFloat(20.0));
        $this->shouldNotBeMoreThan(Cost::fromFloat(21.0));
    }

    function it_can_be_added_with_another_cost()
    {
        $this->add(Cost::fromFloat(0.8))->shouldBeLike(Cost::fromFloat(21.1));
    }

    function it_can_be_added_with_percentage()
    {
        $this->beConstructedThrough('fromFloat', [5.0]);
        $this->addPercent(20)->shouldBeLike(Cost::fromFloat(6.0));
    }

    function it_can_be_converted_to_string()
    {
        $this->__toString()->shouldReturn('20.3');
    }
}
