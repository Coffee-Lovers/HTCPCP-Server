# HTCPCP-Server
Hyper Text Coffee Pot Control Protocol Server

For protocol details, please check https://www.ietf.org/rfc/rfc2324.txt


## how to start?
- install dependencies
`docker-compose run fpm composer install`
- run service
`docker-compose up -d`
- test if it works
`curl localhost:8080/hello/world`
