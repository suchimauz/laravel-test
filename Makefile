container-up:
	cd _docker && docker-compose up -d nginx mysql phpmyadmin laravel-horizon redis redis-webui && cd ..
container-down:
	cd _docker && docker-compose down && cd ..
workspace:
	cd _docker && docker-compose exec workspace bash && cd ..
