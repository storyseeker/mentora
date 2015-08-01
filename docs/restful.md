# 前端交互接口文档

## 公共声明
* 域名前缀: 统一省略域名前缀 http#www.mentora.cn，从根路径开始
* 后端API统一根路径: http#www.mentora.cn/cgi，除此路径外的所有请求均指向前端静态or动态页面
* 页面字符编码: UTF-8
* 内容可见性: 公开、保护、私有，公开都可见，保护导师及团队可见，私有仅个人可见
* Mate: 密友圈，一个特殊的团队；隶属于个人，私有权限，裁剪掉团队卡片、团队核心成员、团队状态等
* 学习组: 学习组，一个特殊的团队；非正式组织，裁剪掉团队状态等

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
  'target_id': ''        // 可选；查看对象帐号，缺省情况下表示看自己的信息
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

## 团队/Mate/学习组卡片-获取基本信息
* cgi/team/card
* 请求格式，支持直接将参数写入url
```
{
  'id': '',                             // 必填；用户ID
  'team_id': '',                        // 可选；团队ID，缺省时表示获取的是Mate（Mate ID是唯一的）
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功， 1 - 失败
  'message': '',                        // 可选；消息
  'team_name': '',                      // 必填；团队名称
  'team_mission': '',                   // 必填；团队使命
  'team_logo': '',                      // 必填；团队logo
  'team_intro': '',                     // 必填；团队简介
  'team_status': {                      // 可选；Mate与学习组 无此字段
    'realm': '',                        // 必填；业务领域
    'finance': '',                      // 必填；融资状态
    'size': '',                         // 必填；团队规模
    'location': ''                      // 必填；总部所在地
  }
  'team_member': [                      // 必填；团队成员
    {
      'id': '',                         // 可选；成员ID，如果是mentora用户
      'name': '',                       // 必填；姓名
      'head_pic': '',                   // 必填；头像
      'job_title': '',                  // 必填；职位
      'intro': '',                      // 必填；简介
      'status': '',                     // 可选；状态 0 - 公开，1 - 私有，缺省表示公开身份
    }
  ]
}
```

## 个人里程碑-关键事件
* cgi/user/growth/events
* 请求格式，支持直接将参数写入url
```
{
  'id': '',                             // 必填；帐号ID
  'target_id': '',                      // 可选；目标帐号ID，默认情况下表示查看自己的信息
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'event': [
    {
      'date_from': '',                  // 必填；开始时段，精确到天
      'date_to': '',                    // 可选；结束日期，缺省情况下表示一个时刻
      'title': '',                      // 必填；新闻项，一段文字
      'link': '',                       // 可选；更多内容链接，可以指向站内或站外
      'status': '',                     // 可选；状态 0 - 公开，1 - 保护，2 - 私有，缺省表示保护
    }
  ]
}
```

## 团队/Mate/学习组里程碑-关键事件
* cgi/team/growth/events
* 请求格式，支持直接将参数写入url
```
{
  'id': '',                             // 必填；帐号ID
  'team_id': '',                        // 可选；团队ID，缺省时表示获取的是Mate（Mate ID是唯一的）
}
```
* 响应格式
```
{
  'status': 0,
  'message': '',
  'event': [
    {
      'date_from': '',                  // 必填；开始时段，精确到天
      'date_to': '',                    // 可选；结束日期，缺省情况下表示一个时刻
      'title': '',                      // 必填；新闻项，一段文字
      'link': '',                       // 可选；更多内容链接，可以指向站内或站外
      'status': '',                     // 可选；状态 0 - 公开，1 - 保护，2 - 私有，缺省表示保护
    }
  ]
}
```

## 个人里程碑-成长轨迹
* cgi/user/growth/list
* 请求格式，支持直接将参数写入url
```
{
  'id': '',                             // 必填；帐号ID
  'target_id': '',                      // 可选；查看对象ID，缺省时表示看自己
  'offset': 0,                          // 可选；偏移量，缺省为0
  'count': 0,                           // 可选；获取条数，缺省时采用服务端配置（如10条等）
  'direct': 0                           // 可选；滑动方向，0 - 更多新事件，1 - 更多旧事件，缺省为1
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'event': [
    {
        'id': '',                       // 必填；编号
        'date_from': '',                // 必填；开始日期
        'date_to': '',                  // 可选；结束日期
        'title': '',                    // 必填；标题
        'summary': '',                  // 可选；摘要
        'content': '',                  // 可选；正文内容
        'head_pic': '',                 // 可选；宣传图
        'status': '',                   // 可选；状态 0 - 公开，1 - 保护，2 - 私有，缺省表示保护        
    }
  ]
}
```

## 团队/Mate/学习组里程碑-成长轨迹
* cgi/team/growth/list
* 请求格式，支持直接将参数写入url
```
{
  'id': '',                             // 必填；帐号ID
  'team_id': '',                        // 可选；团队ID，缺省时表示获取的是Mate（Mate ID是唯一的）
  'offset': 0,                          // 可选；偏移量，缺省为0
  'count': 0,                           // 可选；获取条数，缺省时采用服务端配置（如10条等）
  'direct': 0                           // 可选；滑动方向，0 - 更多新事件，1 - 更多旧事件，缺省为1  
}
```
* 响应格式
```
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'event': [
    {
        'id': '',                       // 必填；编号    
        'date_from': '',                // 必填；开始日期
        'date_to': '',                  // 可选；结束日期
        'title': '',                    // 必填；标题
        'summary': '',                  // 可选；摘要
        'author': '',                   // 可选；作者
        'content': '',                  // 可选；正文内容
        'head_pic': '',                 // 可选；宣传图
        'status': '',                   // 可选；状态 0 - 公开，1 - 保护，2 - 私有，缺省表示保护
    }
  ]
}
```

## 里程碑详情
* cgi/growth/detail
* 请求格式，支持直接将参数写入url
```
{
  'id': '',                             // 必填；帐号 ID
  'team_id': '',                        // 可选；团队 ID，缺省时表示查看 Mate 下的里程碑详情
  'thread_id': '',                      // 必填；里程碑 ID
  'mode': '',                           // 可选；显示模式，0 - 动态网页，1 - 静态网页（移动等场景）,  缺省为0
}

```
* 响应格式
```
mode = 1
  直接 跳转至一个静态化的网页

mode = 0
{
  'status': 0,                          // 必填；状态 0 - 成功，1 - 失败
  'message': '',                        // 可选；消息
  'partial': {
    'title': '',                        // 必填；标题
    'head_pic': '',                     // 可选；图片
    'summary': '',                      // 可选；摘要
    'author': '',                       // 可选；作者
    'content': '',                      // 必填；正文内容
    'content_type': '',                 // 可选；正文内容格式，0 - 纯文本，1 - HTML，2 - MarkDown，缺省为0
    'more_link': '',                    // 可选；外链URL
  }
}
```
