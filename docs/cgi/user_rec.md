# 前端交互接口文档-推荐内容
```
推荐里程碑：每天都有推荐的内容，历史推荐内容不会消失
推荐人与团队：推荐一些用户和团队，可能是已关注或跟随的人；无新内容时，也可以推荐人和团队
```

## 个人的动态列表
* cgi/user/rec
* 请求格式，支持直接将参数写入url
```
{
  'id': '',                             // 必填；帐号ID
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
      'type': '',                       // 必填；类型 0 - 用户动态，1 - 团队动态，2 - 用户card， 3 - 团队card
      'min_id': '',                     // 必填；Min偏移量
      'max_id': '',                     // 必填；Max偏移量
      'timestamp': '',                  // 必填；时间戳
      'user_growth': {                  // 可选；type = 0 必填
        'gid': '',                      // 必填；编号
        'from': '',                     // 必填；开始日期
        'to': '',                       // 可选；结束日期
        'title': '',                    // 必填；标题
        'summary': '',                  // 可选；摘要
        'content': '',                  // 可选；正文内容
        'pic': '',                      // 可选；宣传图
        'uid': '',                      // 必填；用户ID 
        'name': '',                     // 必填；作者姓名
      },
      'team_growth': {                  // 可选；type = 1 必填
        'gid': '',                      // 必填；编号
        'tid':'',                       // 必填；ID
        'from': '',                     // 必填；开始日期
        'to': '',                       // 可选；结束日期
        'title': '',                    // 必填；标题
        'summary': '',                  // 可选；摘要
        'content': '',                  // 可选；正文内容
        'banner': '',                   // 可选；宣传图
        'tid': '',                      // 必填；用户ID 
        'name': '',                     // 必填；作者姓名
      },
      'user_card': {                    // 可选；type = 2 必填
        'uid':'',                       // 必填；ID
        'name': '',                     // 必填；姓名
        'pic': '',                      // 必填；头像，图片
        'company': '',                  // 必填；公司
        'job': '',                      // 必填；职位
        'weibo': '',                    // 可选；微博，是否可见取决于用户身份以及是否公开该资料[下同]
        'weixin': '',                   // 可选；微信
        'linkedin': '',                 // 可选；LinkedIn帐号
        'github': ''                    // 可选；github帐号
      },
      'team_card': {                    // 可选；type = 3 必填
        'tid':'',                       // 必填；团队ID
        'name': '',                     // 必填；团队名称
        'mission': '',                  // 必填；团队使命
        'logo': '',                     // 必填；团队logo
        'intro': '',                    // 必填；团队简介
        'stage': {                      // 可选
          'realm': '',                  // 必填；业务领域
          'finance': '',                // 必填；融资状态
          'size': '',                   // 必填；团队规模
          'location': ''                // 必填；总部所在地
        }
      }
    }
  ]
}
```

