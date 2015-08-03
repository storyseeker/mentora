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

## 添加团队领袖
* cgi/team/leader/add
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'team_id': '',                  // 必填；团队ID
  'team_leader': {
    'name': '',                   // 必填；姓名
    'head_pic': '',               // 必填；头像
    'job_title': '',              // 必填；职位
    'intro': '',                  // 必填；简介
    'email': ''                   // 必填；邮箱
    'phone': ''                   // 必填；手机号
  }
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 删除团队领袖
* cgi/team/leader/del
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'team_id': '',                  // 必填；团队ID
  'leader_email': ''              // 必填；邮箱
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 修改团队领袖
* cgi/team/leader/set
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'team_id': '',                  // 必填；团队ID
  'team_leader': {
    'name': '',                   // 可选；姓名
    'head_pic': '',               // 可选；头像
    'job_title': '',              // 可选；职位
    'intro': '',                  // 可选；简介
    'email': ''                   // 可选；邮箱
    'phone': ''                   // 可选；手机号
  }
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 添加团队成员
* cgi/team/member/add
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'team_id': '',                  // 必填；团队ID
  'member_id': ''                 // 必填；成员ID(手机号 or 邮箱)
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 通过 添加团队成员
* cgi/user/team/pass
```
{
  'id': '',                       // 必填；用户ID
  'team_id': '',                  // 必填；团队ID
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 拒绝 添加团队成员
* cgi/user/team/deny
```
{
  'id': '',                       // 必填；用户ID
  'team_id': '',                  // 必填；团队ID
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 删除团队成员
* cgi/team/member/del
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'team_id': '',                  // 必填；团队ID
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```
