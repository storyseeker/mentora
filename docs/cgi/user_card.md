# 前端交互接口文档 - 个人卡片

## 获取个人卡片
* cgi/user/card
* 请求格式
```
{
  'id': '',                             // 可选；查看对象帐号ID, 缺省表示看自己的信息
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'name': '',                           // 必填；姓名
  'head_pic': '',                       // 必填；头像，图片url
  'company': '',                        // 必填；公司
  'job_title': '',                      // 必填；职位
  'access': '',                         // 可选；社交帐号是否可见, 0 - 公开， 1 - 保护，2 - 私有
  'weibo': '',                          // 可选；微博
  'weixin': '',                         // 可选；微信
  'linkedin': '',                       // 可选；LinkedIn帐号
  'github': ''                          // 可选；github帐号
}
```

## 修改个人卡片
* cgi/user/card/set/${OP}

OP | 含义
----|----
phone | 手机号
email |  邮箱
company | 公司
job | 工作职位
weibo |  微博
weixin | 微信
linkedin | 领英
password | 密码

* 请求格式
```
{
  'value': '',                          // 必填；参数值
  'old_value': ''                       // 可选；参数值
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功；1 - 失败
  'message': ''                         // 可选；消息
}
```
