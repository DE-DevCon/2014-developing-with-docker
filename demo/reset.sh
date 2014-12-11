docker ps -aq | xargs docker rm -f #Remove all running images

docker build -t my-nginx .

docker run -d --name db -e MYSQL_ROOT_PASSWORD=password mysql
docker run -d -v $(pwd):/srv/http -v $(pwd)/timezone.ini:/etc/php/conf.d/timezone.ini --name demo-phpfpm --link db:mysql jprjr/php-fpm
docker run -d --link demo-phpfpm:phpfpm -p 80:80 my-nginx
