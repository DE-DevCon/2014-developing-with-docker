docker ps|awk '{print $1}'|grep -v CONTAINER|xargs docker rm -f #Remove all running images

docker build -t my-nginx .

docker run -d --name demo-mysql -e MYSQL_ROOT_PASSWORD=password mysql
docker run -d -v $(pwd):/srv/http --name demo-phpfpm --link demo-mysql:mysql jprjr/php-fpm
docker run -d -v $(pwd):/usr/local/nginx/html --link demo-phpfpm:phpfpm -p 80:80 my-nginx
