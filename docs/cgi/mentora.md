# 前端交互接口文档 - 导师/顾问

## 我的导师
* cgi/user/mentora
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'mentora': [
    {
      'uid': '',
      'name': '',
    }
  ]
}
```

## 团队的导师
* cgi/team/mentora
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'mentora': [
    {
      'uid': '',
      'name': '',
    }
  ]
}
```

## 我指导的新人
* cgi/mentora/user
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'user': [
    {
      'uid': '',
      'name': '',
    }
  ]
}
```

## 我指导的团队 
* cgi/mentora/team
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'team': [
    {
      'tid': '',
      'name': '',
    }
  ]
}
```

## 申请导师列表
* cgi/mentora/apply
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'team': [
    {
      'tid': '',
      'name': '',
    }
  ],
  'user': [
    {
      'uid': '',
      'name': '',
    }
  ]
}
```

## 个人申请导师
* cgi/user/mentora/add
* 请求格式
```
{
  'uid': '',                            // 必填；用户ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 通过 个人申请导师
* cgi/mentora/user/pass
* 请求格式
```
{
  'uid': '',                            // 必填；用户ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 拒绝 个人申请导师
* cgi/mentora/user/deny
* 请求格式
```
{
  'uid': '',                            // 必填；用户ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 团队申请导师
* cgi/team/mentora/add
* 请求格式
```
{
  'tid': '',                            // 必填；团队id
  'uid': '',                            // 必填；用户id
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 通过 团队申请导师
* cgi/mentora/team/pass
* 请求格式
```
{
  'tid': '',                            // 必填；团队id
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 拒绝 团队申请导师
* cgi/mentora/team/deny
* 请求格式
```
{
  'tid': '',                            // 必填；团队id
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 个人取消导师关系
* cgi/user/mentora/del
* 请求格式
```
{
  'uid': '',                            // 必填；用户ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 团队取消导师关系
* cgi/team/mentora/del
* 请求格式
```
{
  'tid': '',                            // 必填；团队id
  'uid': '',                            // 必填；用户ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 导师取消与个人指导关系
* cgi/mentora/user/del
* 请求格式
```
{
  'uid': '',                            // 必填；用户ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 导师取消与团队指导关系
* cgi/mentora/user/del
* 请求格式
```
{
  'tid': '',                            // 必填；团队id
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```
