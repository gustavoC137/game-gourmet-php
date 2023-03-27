<?php
class Prompt
{
    public int $count = 1;
    public bool $prompting = true;
    public string $input;
    public string $dishFound;
    public string $dishYouThouthName;
    public string $dishYouThouthProperty;


    public DishesMap $dishesMap;
    public PropertyTreeNode $propertyTreeNode;
    public string $dishKey;
    public function __construct($count, $dishesMapArr = [], $propertyTreeNodeArr = []) {
        $this->count = $count;
        $this->dishesMap = new DishesMap($dishesMapArr);

        $children = [new PropertyTreeNode(
            $propertyTreeNodeArr['children'][0]['property'],
            $propertyTreeNodeArr['children'][0]['children'])
        ];

        $children[0]->addChild(new PropertyTreeNode('fitro', []));

        $this->propertyTreeNode = new PropertyTreeNode(
            $propertyTreeNodeArr['property'],
            $children
        );
    }

    public function thinkOfaDish(): void
    {
        echo "Pense em um prato que gosta...";
        $this->input = readline();
    }

    public function wtDishDYouThink()
    {
        echo "Qual prato você pensou? \n\n";
        $this->dishYouThouthName = readline();

        echo "$this->dishYouThouthName é__________ mas $this->dishFound não? \n\n";
        $this->dishYouThouthProperty = readline();
    }

    public function askForDishFound(PropertyTreeNode $node) {
        $this->dishFound = $this->dishesMap->getDish($this->dishKey);
        echo "O prato que você pensou é " . $this->dishFound . "? (S/N) \n\n";

        if ($this->confirm()) {
            echo "Acertei de novo! \n\n";
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
                echo "O prato que você pensou é $child->property?(S/N) \n\n";

                if ($this->confirm()) {
                    $this->dishKey .= ".$child->property";
                    $this->dishHasThisProperty($child);
                    return;
                }
            }
        }
        $this->askForDishFound($node);
    }

    public function confirm(): bool
    {
        $this->input = strtoupper(readline());
        if ($this->input === "S") {
            return true;
        }
        return false;
    }

    /**
     * @return void
     */
    public function start(): void
    {
        echo "Bem-vindo à Jogo  Gourmet! \n\n";
        
        $this->thinkOfaDish();
        $this->dishKey = $this->propertyTreeNode->property;
        $this->dishHasThisProperty($this->propertyTreeNode);
    }
}