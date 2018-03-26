# build
docker-compose up -d

# use

1. setting docker-compose environment

## slack

ref : https://api.slack.com/docs/message-formatting

```
curl -X POST \
-H "Content-Type: application/json" \ 
-d '{"message":""}' \
http://localhost:2000/slack.php
```