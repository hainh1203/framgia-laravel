docker-compose exec workspace eslint resources/js/ --ext .js
docker-compose exec workspace phpcs --standard=Framgia --ignore=app/Supports/* --encoding=utf-8 app
docker-compose exec workspace php vendor/bin/phpunit
