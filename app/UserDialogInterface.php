<?php

namespace App;

interface UserDialogInterface
{
    public function welCome(): void;
    public function thinkOfaDish(): void;
    public function askIfDishHasProperty(string $property): bool;
    public function askIfDishIsThis(string $dishFound): bool;
    public function askWhichDish(): string;
    public function askExclusiveProperty(string $dishYouThouthName, string $dishFound): string;
    public function confirm(): bool;
    public function celebratesSuccess(): void;
}