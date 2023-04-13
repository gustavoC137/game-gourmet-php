<?php

namespace App;
class Game
{
    public UserDialogInterface $dialogUser;
    public string $dishFound;
    public string $dishYouThouthName;
    public string $dishYouThouthProperty;


    public DishesMap $dishesMap;
    public PropertyTreeNode $propertyTreeNode;
    public string $dishKey;
    public function __construct($dialogUser, $dishesMapArr = [], $propertyTreeNodeArr = []) {
        $this->dialogUser = $dialogUser;
        $this->dishesMap = new DishesMap($dishesMapArr);

        $children = [new PropertyTreeNode(
            $propertyTreeNodeArr['children'][0]['property'],
            $propertyTreeNodeArr['children'][0]['children'])
        ];

        $this->propertyTreeNode = new PropertyTreeNode(
            $propertyTreeNodeArr['property'],
            $children
        );
    }

    public function thinkOfaDish(): void
    {
        $this->dialogUser->thinkOfaDish();
    }

    public function wtDishDYouThink()
    {
        $this->dishYouThouthName = $this->dialogUser->askWhichDish();

        $this->dishYouThouthProperty = $this->dialogUser->askExclusiveProperty($this->dishYouThouthName, $this->dishFound);
    }

    public function askForDishFound(PropertyTreeNode $node) {
        $this->dishFound = $this->dishesMap->getDish($this->dishKey);

        if ($this->dialogUser->askIfDishIsThis($this->dishFound)) {
            $this->dialogUser->celebratesSuccess();
        } else {
            $this->wtDishDYouThink();
            $this->dishesMap->addDish(new Dish($this->dishYouThouthName, "$this->dishKey.$this->dishYouThouthProperty"));
            $node->addChild(new PropertyTreeNode($this->dishYouThouthProperty, []));
        }
        $this->start();
    }

    public function dishHasThisProperty(PropertyTreeNode $node): void
    {
        if ($node->children) {
            foreach ($node->children as $child) {
                if ($this->dialogUser->askIfDishHasProperty($child->property)) {
                    $this->dishKey .= ".$child->property";
                    $this->dishHasThisProperty($child);
                    return;
                }
            }
        }
        $this->askForDishFound($node);
    }

    /**
     * @return void
     */
    public function start(): void
    {
        $this->dialogUser->welCome();
        
        $this->thinkOfaDish();
        $this->dishKey = $this->propertyTreeNode->property;
        $this->dishHasThisProperty($this->propertyTreeNode);
    }
}