#  前端交互接口文档-基本信息


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
  'id': '',                       // 必填；用户帐号
  'value': '',                    // 必填；参数值
  'old_value': ''                 // 可选；参数值
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```
