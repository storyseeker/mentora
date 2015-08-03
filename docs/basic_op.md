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

## 拒绝 添加团队成员
* cgi/user/team/deny
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

## 申请加入团队
* cgi/user/team/apply
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

## 通过申请加入团队
* cgi/team/member/pass
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

## 拒绝申请加入团队
* cgi/team/member/deny
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

## 关注个人
* cgi/user/follow/user/add
* 请求格
```
{
  'id': '',                       // 必填；用户ID
  'target_id': '',                // 必填；目标用户ID
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 取消关注个人
* cgi/user/follow/user/del
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'target_id': '',                // 必填；目标用户ID
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 关注团队
* cgi/user/follow/team/add
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

## 取消关注团队
* cgi/user/follow/team/del
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

## 个人申请导师
* cgi/user/mentor/apply
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'target_id': '',                // 必填；导师ID
}
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 通过 个人申请导师
* cgi/mentor/newbie/pass
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'target_id': '',                // 必填；申请者ID
}
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 拒绝 个人申请导师
* cgi/mentor/newbie/deny
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'target_id': '',                // 必填；申请者ID
}
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 个人取消导师
* cgi/user/mentor/del
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'target_id': '',                // 必填；申请者ID
}
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 导师解除关系
* cgi/mentor/newbie/del
* 请求格式
```
{
  'id': '',                       // 必填；用户ID
  'target_id': '',                // 必填；申请者ID
}
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```
