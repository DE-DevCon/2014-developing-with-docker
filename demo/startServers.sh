docker run -d -v $(pwd):/srv/http --name demo-phpfpm jprjr/php-fpm
docker run -d -v $(pwd):/usr/local/nginx/html --link demo-phpfpm:phpfpm -p 81:80 my-nginx
