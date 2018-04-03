package main

import (
  "bytes"
  "encoding/base64"
  "encoding/json"
  "fmt"
  "io/ioutil"
  "net/http"
  "os"
)

func main() {

  fmt.Println()
  key := os.Getenv("appKey")
  secret := os.Getenv("appSecret")
  token := os.Getenv("token")

  url := "https://api.jpush.cn/v3/push"
  authorization := "Basic " + base64.StdEncoding.EncodeToString([]byte(key+":"+secret))
  platform := "all"

  fmt.Println("url      : " + url)
  fmt.Println("key      : " + key)
  fmt.Println("secret   : " + secret)
  fmt.Println("auth     : " + authorization)
  fmt.Println("platform : " + platform)
  fmt.Println("token    : " + token)

  body := `{"platform":"` + platform + `", "audience":{"registration_id":["` + token + `"]}, "notification":{"alert":"Hello"}}`
  byteBody := []byte(body)

  fmt.Println("\n==sender==")
  fmt.Println(body)
  // decode1 := jsonDecode(byteBody)
  // fmt.Println(decode1)
  //
  fmt.Println()
  httpDo(url, authorization, byteBody)
}

func httpDo(url string, authorization string, byteBody []byte) {

  req, err := http.NewRequest("POST", url, bytes.NewBuffer(byteBody))
  if err != nil {
    // handle error
  }
  req.Header.Set("Content-Type", "application/json")
  req.Header.Set("Authorization", authorization)

  client := &http.Client{}
  resp, err := client.Do(req)

  defer resp.Body.Close()

  fmt.Println("response Status:", resp.Status)
  fmt.Println("response Headers:", resp.Header)
  body, _ := ioutil.ReadAll(resp.Body)
  fmt.Println("response Body:", string(body))
}

/*
jsonDecode ...
*/
func jsonDecode(srcJSON []byte) map[string]interface{} {
  jsonDecode := map[string]interface{}{}
  json.Unmarshal(srcJSON, &jsonDecode)
  return jsonDecode
}

/*
jsonEncode ...
*/
func jsonEncode(jsonData map[string]interface{}) []byte {
  srcJSON, err := json.Marshal(jsonData)
  if err != nil {
    panic(err)
  }
  return srcJSON
}
