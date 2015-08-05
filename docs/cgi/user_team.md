# 前端交互接口文档 - 用户团队

## 已加入的团队列表
* cgi/user/team/list
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
  'team': [
    {
      'tid': '',                  // 必填；团队ID
      'name': '',                 // 必填；团队Name
      'mission': '',              // 必填；团队使命
      'logo': '',                 // 必填；团队Logo
    }
  ]
}

## 团队邀请列表
* cgi/user/team/invite
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
  'team': [
    {
      'tid': '',                  // 必填；团队ID
      'name': '',                 // 必填；团队name
    }
  ]
}


## 通过 团队邀请
* cgi/user/team/pass
* 请求格式
```
{
  'tid': '',                      // 必填；团队ID
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 拒绝 团队邀请
* cgi/user/team/deny
* 请求格式
```
{
  'tid': '',                      // 必填；团队ID
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
  'tid': '',                      // 必填；团队ID
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```

## 退出团队
* cgi/user/team/del
* 请求格式
```
{
  'tid': '',                      // 必填；团队ID
}
```
* 响应格式
```
{
  'status': 0,                    // 必填；状态 0 - 成功；1 - 失败
  'message': ''                   // 可选；消息
}
```
