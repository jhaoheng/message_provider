# build
docker-compose up -d

# use

1. setting docker-compose environment

## firebase

ref : https://firebase.google.com/docs/cloud-messaging/send-message

```
curl -X POST \
-H "Content-Type: application/json" \ 
-d '{"registrationIds":[], "title":"", "body":"", "badge":""}' \
http://localhost:2000/firebase.php
```


## slack

ref : https://api.slack.com/docs/message-formatting

```
curl -X POST \
-H "Content-Type: application/json" \ 
-d '{"message":""}' \
http://localhost:2000/slack.php
```