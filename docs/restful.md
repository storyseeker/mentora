# 前端交互接口文档

## 公共声明
* 域名前缀: 统一省略域名前缀 http#www.mentora.cn，从根路径开始
* 后端API统一根路径: http#www.mentora.cn/cgi，除此路径外的所有请求均指向前端静态or动态页面
* 页面字符编码: UTF-8

## 登录接口
* cgi/login
* 请求格式，支持直接将参数写入url
```
{
  'id': {your-account},                   // 必填字段；用户帐号（手机号或者邮箱，检查格式），urlencode
  'password': {your-password},            // 必填字段；密码（前端先做MD5再传给服务端，全部转小写），urlencode
  'redirect': {redirect-url}              // 可选；登录后跳转地址，urlencode
}
```
* 响应格式
```
{
  'status': 0,                   // 必填；状态: 0 - 成功，1 - 失败，2 - 帐号不存在，3 - 密码错误
  'message': ‘’,                 // 可选；提示信息
  'id': '',                      // 必填；帐号
  'display_id': ''               // 必填；显示名（姓名）
}
```
## 注册接口
* cgi/reg
* 请求格式，支持直接将参数写入url
```
{
  'name': {your-name},                    // 必填；姓名，实名，urlencode[下同]
  'phone': {your-phone-number},           // 必填；手机号
  'email': {your-email-address},          // 必填；邮箱地址
  'company': {your-company},              // 必填；公司
  'job': {your-job-title},                // 必填；职位
  'weibo': {your-weibo-account},          // 必填；微博帐号
  'wexin': {your-weixin-account},         // 必填；微信帐号
  'weixin_public': {your-weixin-public},  // 可选；微信公众号
  'linkedin': {your-linkedin-account},    // 必填；LinkedIn帐号
  'password': {your-password}             // 必填；密码（MD5）
}
```
* 响应格式
```
{
  'status': 0,                            // 必填；状态 0 - 成功；1 - 失败
  'message': ''                           // 可选；原因（失败的细化是否需要再加一个字段？）
}
```
## 个人卡片-获取基本信息
* cgi/user/card，支持直接将参数写入url
* 请求格式
```
{
  'id': '',           // 必填；帐号(隐含的字段在cookie中补充说明)
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'name': '',                           // 必填；姓名
  'head_pic': {your-head-picture},      // 必填；头像，图片
  'company': '',                        // 必填；公司
  'job_title': '',                      // 必填；职位
  'weibo': '',                          // 可选；微博，是否可见取决于用户身份以及是否公开该资料[下同]
  'weixin': '',                         // 可选；微信
  'weixin_public': '',                  // 可选；微信公众号
  'linkedin': '',                       // 可选；LinkedIn帐号
  'github': ''                          // 可选；github帐号
}
```

## 团队卡片-获取基本信息
* cgi/team/card
* 请求格式，支持直接将参数写入url
```
{
  'id': '',                             // 必填；用户ID
  'team_id': '',                        // 必填；团队ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功， 1 - 失败
  'message': '',                        // 可选；消息
  'team_name': '',                      // 必填；团队名称
  'team_slogan': '',                    // 必填；团队使命
  'team_logo': '',                      // 必填；团队logo
  'team_intro': '',                     // 必填；团队
  'team_member': [                      // 必填；团队成员
    {
      'id': '',                         // 可选；成员ID，如果是mentora用户
      'name': '',                       // 必填；姓名
      'head_pic': '',                   // 必填；头像
      'job_title': '',                  // 必填；职位
      'intro': ''                       // 必填；简介
    }
  ]
}
```
