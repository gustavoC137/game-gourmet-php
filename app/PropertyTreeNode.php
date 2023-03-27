<?php

class PropertyTreeNode
{
    public string $property;
    public array $children = [];

    public function __construct(string $property, $children = []) {
        $this->property = $property;
        $this->children = $children;
    }

    public function addChild(PropertyTreeNode $node): void
    {
        $this->children[] = $node;
    }
}