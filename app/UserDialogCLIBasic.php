<?php

namespace App;

class UserDialogCLIBasic implements UserDialogInterface
{

    public function welCome(): void
    {
        echo "Bem-vindo à Jogo  Gourmet! \n\n";
    }

    public function thinkOfaDish(): void
    {
        echo "Pense em um prato que gosta...";
        readline();
    }

    public function askIfDishHasProperty(string $property): bool
    {
        echo "O prato que você pensou é $property?(S/N) \n\n";
        return $this->confirm();
    }

    public function askIfDishIsThis(string $dishFound): bool
    {
        echo "O prato que você pensou é " . $dishFound . "? (S/N) \n\n";
        return $this->confirm();
    }

    public function askWhichDish(): string
    {
        echo "Qual prato você pensou? \n\n";
        return readline();
    }

    public function askExclusiveProperty(string $dishYouThouthName, string $dishFound): string
    {
        echo "$dishYouThouthName é__________ mas $dishFound não? \n\n";
        return readline();
    }

    public function confirm(): bool
    {
        $input = strtoupper(readline());
        if ($input === "S") {
            return true;
        }
        return false;
    }

    public function celebratesSuccess(): void
    {
        echo "Acertei de novo! \n\n";
    }
}