# Game Gourmet
Simple guess the dish game implementing a tree data structure

### Build an image with php-fpm:8.2.4 and composer
```
docker-compose up -d
```
### Install composer and autoload
```
docker-compose exec game-gourmet composer install
```
### Run the game
```
docker-compose exec game-gourmet php gameGourmetCLI.php
```