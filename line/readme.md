# line app
1. 建立一個新的 line app
2. webhook
  1. enable
  2. 填寫 Webhook URL (receivce 說明)

# receive
> 在 receiver folder 下

1. 建立 instance
2. 在 instance 中，執行 `docker-compose -f docker-compose-receive.yml up -d`
3. 將 https url 放入 line app webhook URL 中

# push
> 在 push folder 下

1. 設定 config.json
2. `docker run --rm --name firebase -v $(pwd):/line php:7.2-rc-cli php /line/push.php` 