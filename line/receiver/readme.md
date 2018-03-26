# Notice

1. https
2. 不能用自簽憑證
3. 將 url 放入 line : webhook 中後，有測試的 btn 可以測試

# 從 line 拿到的資料

> 2018/03/26

## header
```
{
  "Connection": "keep-alive",
  "Content-Length": "722",
  "X-Forwarded-Proto": "https",
  "X-Forwarded-Port": "443",
  "X-Forwarded-For": "203.104.156.73",
  "X-Line-Signature": "AZiwwVzcBAEo+zPVOCF83MS1AVgwIgMHEICV2IbcA+c=",
  "User-Agent": "LINE-Developers/0.1",
  "Content-Type": "application/json",
  "Accept-Encoding": "gzip,deflate",
  "Host": "line.gotomythings.com"
}
```

## body
```
{
  "events": [
    {
      "type": "message",
      "replyToken": "2304c5398efe4167a608825c3ddc99f0",
      "source": {
        "userId": "U90b348c49d5aa35af96723fbcdc24c09",
        "type": "user"
      },
      "timestamp": 1522053610198,
      "message": {
        "type": "text",
        "id": "7688245817447",
        "text": "........"
      }
    }
  ]
}
```