<?php

class DishesMap
{
    public array $dishes;

    public function __construct($dishes) {
        $this->dishes = $dishes;
    }

    public function addDish(Dish $dish): void
    {
        $this->dishes[$dish->key] = $dish->name;
    }

    public function getDish(string $key)
    {
        return $this->dishes[$key];
    }
}