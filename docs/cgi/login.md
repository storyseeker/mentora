# 前端交互接口文档 - 登录/注册

## 登录接口
* cgi/login/{account}/{password}
* 请求格式，支持直接将参数写入url
```
{
  'account': '',                          // 必填字段；用户帐号（手机号或者邮箱，检查格式），urlencode
  'password': '',                         // 必填字段；密码（前端先做MD5再传给服务端，全部转小写），urlencode
}
```
* 响应格式
```
{
  'status': 0,                            // 必填；状态: 0 - 成功，1 - 失败，2 - 帐号不存在，3 - 密码错误
  'message': ‘’,                          // 可选；提示信息
  'uid': '',                              // 必填；帐号ID
  'name': ''                              // 必填；姓名
}
```

## 注销接口
* cgi/logout


## 注册接口
* cgi/signup
* cgi/signup/verify/email/{email}
* cgi/signup/verify/phone/{phone}
* 请求格式，支持直接将参数写入url
```
{
  'name': '',                             // 必填；姓名，实名，urlencode[下同]
  'phone': '',                            // 必填；手机号
  'email': '',                            // 必填；邮箱地址
  'company': '',                          // 必填；公司
  'job': '',                              // 必填；职位
  'weibo': '',                            // 必填；微博帐号
  'wexin': '',                            // 必填；微信帐号
  'linkedin': '',                         // 必填；LinkedIn帐号
  'password': ''                          // 必填；密码（MD5）
}
```
* 响应格式
```
{
  'status': 0,                            // 必填；状态 0 - 成功；1 - 失败
  'message': ''                           // 可选；原因
}
```
