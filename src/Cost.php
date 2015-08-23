<?php

class Cost
{
    private $float;

    public static function fromFloat($float)
    {
        $cost = new Cost();
        $cost->float = $float;

        return $cost;
    }

    public function equals(Cost $aCost)
    {
        return $this->float === $aCost->float;
    }

    public function add(Cost $aCost)
    {
        return Cost::fromFloat($this->float + $aCost->float);
    }
}
