# 極光推送

- 檢查 ./app/config.env

# use docker run
- `docker run --rm --name jiguang_push --env-file ./app/config.env -v $(pwd)/app:/go/src/app golang:1.10-stretch go run /go/src/app/main.go`

# use docker-compose
1. `docker-compose up -d`
2. `docker exec -it jiguang_push /bin/bash`
3. `go run main.go`