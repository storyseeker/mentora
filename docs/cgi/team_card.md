# 前端交互接口文档

## 创建团队
* cgi/team/create
* 请求格式
```
{
  'flag': '',                           // 可选；团队类型, myspace | mate | group | class | team, 缺省为team
  'name': '',                           // 必填；团队名称
  'mission': '',                        // 必填；团队使命
  'logo': '',                           // 必填；团队logo
  'intro': '',                          // 必填；团队简介
  'stage': {                            // 可选；Mate与学习组 无此字段
    'realm': '',                        // 必填；业务领域
    'finance': '',                      // 必填；融资状态
    'size': '',                         // 必填；团队规模
    'location': ''                      // 必填；总部所在地
  }
}
```

## 基本信息
* cgi/team/card/{teamId}
* 请求格式，支持直接将参数写入url
```
{
  'tid': '',                            // 可选；团队ID，缺省时表示获取的是Mate
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功， 1 - 失败
  'message': '',                        // 可选；消息
  'name': '',                           // 必填；团队名称
  'mission': '',                        // 必填；团队使命
  'logo': '',                           // 必填；团队logo
  'intro': '',                          // 必填；团队简介
  'stage': {                            // 可选；Mate与学习组 无此字段
    'realm': '',                        // 必填；业务领域
    'finance': '',                      // 必填；融资状态
    'size': '',                         // 必填；团队规模
    'location': ''                      // 必填；总部所在地
  }
  'leader': [                           // 可选；团队领袖
    {
      'id': '',                         // 必填；ID
      'name': '',                       // 必填；姓名
      'pic': '',                        // 必填；头像
      'role': '',                       // 必填；职位
      'intro': '',                      // 必填；简介
      'email': ''                       // 可选；邮箱, 成员可见
      'phone': ''                       // 可选；手机号, 成员可见
    }
  ]
}
```

## 修改团队卡片
* cgi/team/card/set/{teamId}/{field}

field | 含义
----|----
name | 名称
mission | 使命
logo | 团队logo
intro |  团队简介
realm | 业务领域
finance | 融资状态
size | 团队规模
location | 总部所在地

* 请求格式
```
{
  'tid': '',                            // 必填；团队ID
  'value': '',                          // 必填；参数值
  'value2': ''                          // 可选；参数值
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功；1 - 失败
  'message': ''                         // 可选；消息
}
```

## 添加团队领袖
* cgi/team/leader/add/{teamId}
* 请求格式
```
{
  'tid': '',                      // 必填；团队ID
  'leader': {
    'name': '',                   // 必填；姓名
    'pic': '',                    // 必填；头像
    'role': '',                   // 必填；职位
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
* cgi/team/leader/delelte/{teamId}/{leaderId}
* 请求格式
```
{
  'teamId': '',                   // 必填；团队ID
  'leaderId': ''                  // 必填；Leader ID
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
* cgi/team/leader/update/{teamId}/{leaderId}
* 请求格式
```
{
  'tid': '',                      // 可选；团队ID, 缺省时表示获取的是Mate
  'leader': {
    'id': '',                     // 可选；ID
    'name': '',                   // 可选；姓名
    'pic': '',                    // 可选；头像
    'role': '',                   // 可选；职位
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

