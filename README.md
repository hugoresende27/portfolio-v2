# https://hugoresende.pt/

### My portfolio v2

- https://picsum.photos/1920/1080
- certobot : https://mindsers.blog/post/https-using-nginx-certbot-docker/
- weather API : https://www.weatherapi.com/my/
- elasticSearch Tut : https://itnext.io/the-ultimate-guide-to-elasticsearch-in-laravel-application-ee636b79419c
- news API : https://newsdata.io/
--------------
- useful docker commands:
1. get db host : sudo docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' portfolio-db
2. initiante elasticsearch server with docker and 4gb memory : sudo docker run --name es01 --net elastic -p 9200:9200 -it --memory=4g docker.elastic.co/elasticsearch/elasticsearch:8.7.0

--------
- Useful Git commands:
1. git reset --hard HEAD (reset for no changes to commit)



