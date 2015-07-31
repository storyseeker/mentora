# 前端交互接口文档

接口公共声明
* 域名前缀: 统一省略域名前缀 http://www.mentora.cn/，从根路径开始
* 后端API统一根路径: http://www.mentora.cn/cgi，除此路径外的所有请求均指向前端静态or动态页面

登录接口
* path: /cgi/login
* 请求格式
```
?name={your-name}&password={your-passwd}&redirect={redirect-url}
参数说明
  name: 必填字段；用户名（手机号或者邮箱，检查格式），urlencode
  password: 必填字段；密码（前端先做MD5再传给服务端，全部转小写），urlencode
  redirect: 可选；登录后跳转地址，urlencode
```
* 响应格式
```
{
  'status': 0,              // 状态: 0 - 成功，1 - 失败，2 - 帐号不存在，3 - 密码错误
  'message': '',            // 提示信息
  'display_name': ''        // 用户显示名（昵称）
}
```
