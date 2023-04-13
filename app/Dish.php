<?php

namespace App;
class Dish {
    public string $name;
    public string $key;

    public function __construct($name, $key) {
        $this->name = $name;
        $this->key = $key;
    }
}