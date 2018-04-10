# 極光推送

- 檢查 ./app/config.env

# use docker run
- `docker run --rm --name jiguang_push --env-file ./app/config.env -v $(pwd)/app:/go/src/app golang:1.10-stretch go run /go/src/app/main.go`

# use docker-compose
1. `docker-compose up -d`
2. `docker exec -it jiguang_push /bin/bash`
3. `go run main.go`

# 使用心得
- server 使用極光 api 進行推送行為，若整個 registration_ids 全部都是錯的，會直接返回 400 錯誤。若其中一個是正確，其他是錯誤，則會返回 200，並附帶 msg_id 進行回調查詢。
- 極光推送，不像 firebase，需要特別調用 '送达状态查询 : `POST /status/message`' 的這隻 api，來回報 server 哪些 id 是無效的，須在 server 端進行刪除行為。
- 在調用 '送达状态查询 : `POST /status/message` api 時，msg_id 必須是 int value
- 調用 report 的 api, 極容易發生 error, 我想應該是極光推送系統來不及寫入的關係

# app

## android
> 測試的版本是 : JPushExample(892748)

1. 請註冊極光帳號後，設定 android 裝置
2. 下載 demo 範例，載入範例
3. jave -> MainActivity 中，新增 `import android.util.Log;`
4. jave -> MainActivity 中，搜尋 rid 的變數，更改如下
```
case R.id.getRegistrationId:
  String rid = JPushInterface.getRegistrationID(getApplicationContext());
  if (!rid.isEmpty()) {
    mRegId.setText("RegId:" + rid);
    Toast.makeText(this, rid, Toast.LENGTH_SHORT).show();
    Log.d("getRegistrationID : ", rid);
  } else {
    Toast.makeText(this, "Get registration fail, JPush init failed!", Toast.LENGTH_SHORT).show();
  }
  break;
}
```
5. 運行 JPushExample
    - 執行 getRegistrationID : 在 logcat 中取得 id
6. 回到極光推送網站，執行推送測試
