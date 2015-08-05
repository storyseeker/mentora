# 前端交互接口文档 - 关注/粉丝

## 已关注的对象
* cgi/user/follow
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

## 已关注我的人
* cgi/user/fellow
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

## 关注个人
* cgi/user/follow/user
* 请求格式
```
{
  'uid': '',                            // 必填；对象ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 关注团队
* cgi/user/follow/team
* 请求格式
```
{
  'tid': '',                            // 必填；对象ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 取消关注个人
* cgi/user/unfollow/user
* 请求格式
```
{
  'uid': '',                            // 必填；对象ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 取消关注团队
* cgi/user/unfollow/team
* 请求格式
```
{
  'tid': '',                            // 必填；对象ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
}
```

## 个人粉丝
* cgi/user/fellow
* 请求格式
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'fellow': [
    {
      'uid': '',
      'name': '',
      'pic': ''
    }
  ]
}
```

## 团队粉丝
* cgi/team/fellow
* 请求格式
```
{
  'tid': '',                            // 必填；对象ID
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'fellow': [
    {
      'uid': '',
      'name': '',
      'pic': ''
    }
  ]
}
```
