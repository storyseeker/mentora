# 名词解释

## 名词解释
名词 | 中文名 | 含义
----|----|----
user | 用户 | 一个人，注册并通过认证的帐号
team | 团队 | 一个组织，有自己的形象、名称、成员等；同一个团队内的动态是共享的
growth | 里程碑 | 记录阶段性的成长
label | 标签 | 可以给里程碑设置几个关键词，方便查找
activity | 活动 | 线上或线下活动，一个特殊的growth
event | 事件 | growth的一种，重大事件（值得突出的成果）
newbie | 新人 | 在某方面处于学习和成长阶段，跟随一个或多个人学习
mentor | 导师 | 在某方面比较擅长，能向他人分享自己的专业见解；个人可以拜导师，团队可以邀请顾问
follow | 关注 |  user or team 可以关注其他 user or team，但仅可看到被关注方公开的里程碑
fellow | 粉丝 | 个人或团队的关注者
r-follow | 指导 | 拜师，反向关注；newbie/team 把自己的成果展示个 mentor
card | 名片 | 团队与个人的名片，标识个人的基本信息
member | 成员 | 团队的成员

## 隐私保护
隐私程度 | 中文名 | 含义
----|----|----
public | 公开 | 所有人可见，不需要特殊的权限
protected | 保护 | 用户的密友圈、导师可见；团队的密友圈、顾问可见
private | 私有 | 仅 用户本人可见；仅团队成员可见

## 里程碑标注(Mark)
名称 | 中文名 | 含义
----|----|----
star | 加星 | 重要事件 event
job | 招聘 | 招聘帖
media | 媒体 | 媒体报道或者宣传帖
salon | 沙龙 | 线下活动

## 团队的几个特殊类型
名称 | 中文名 | 含义
----|----|----
myspace | 私人空间 | 自己的空间
mate | 密友圈| 好朋友，亲密圈子，替代通讯录功能
group | 圈子 | 兴趣组，拥有共同学习兴趣的几个人
class | 班级 | 学习组，相同导师下的学员
manongdahui | 码农大会 | 分享会，发布活动信息

## 查询类接口
编号|名称|路径|文件
----|----|----|----
1 | 登录 | cgi/login | docs/basics.md
2 | 注册 | cgi/reg | docs/basics.md
3 | 个人名片 | cgi/user/card | docs/basics.md
4 | 团队名片 | cgi/team/card | docs/basics.md
5 | 个人大事记 | cgi/user/event | docs/basics.md
6 | 团队大事记 | cgi/team/event | docs/basics.md
7 | 个人成长列表 | cgi/user/growth | docs/basics.md
8 | 团队成长列表 | cgi/team/growth | docs/basics.md
9 | 个人成长 | cgi/user/growth/${growth_id} | docs/basics.md
10 | 团队成长 | cgi/team/growth/${growth_id} | docs/basics.md
11 | 加入的团队 | cgi/user/team | docs/relation.md
12 | 团队领袖 | cgi/team/leader | docs/relation.md
13 | 团队成员 | cgi/team/member | docs/relation.md
14 | 我的关注 | cgi/user/follow | docs/relation.md
15 | 我的关注者 | cgi/user/fellow | docs/relation.md
16 | 我的导师 | cgi/user/mentor | docs/relation.md
17 | 我的学员 | cgi/user/newbie | docs/relation.md
18 | 推荐动态 | cgi/user/rec | docs/recommend.md
19 | 分享团队 | cgi/share/t/${team_id} | docs/share.md
20 | 分享个人 | cgi/share/u/${user_id} | docs/share.md
21 | 分享成长 | cgi/share/g/${growth_id} | docs/share.md
22 | 分享活动 | cgi/share/a/${activity_id} | docs/share.md

## 上传类接口
编号 | 名称 | 路径
----|----|----
1 | 图片上传 | cgi/upload/pic

## 基本信息编辑类接口
名称|路径
----|----
个人名片 | cgi/user/card/set
团队名片 | cgi/team/card/set
创建团队 | cgi/team/create
添加团队领袖 | cgi/team/leader/add
删除团队领袖 | cgi/team/leader/del
修改团队领袖 | cgi/team/leader/set

## 里程碑编辑接口
名称|路径
----|----
删除个人里程碑 | cgi/user/growth/del
标注个人里程碑 | cgi/user/growth/mark
修改个人里程碑 | cgi/user/growth/edit
新增个人里程碑 | cgi/user/growth/add
删除团队里程碑 | cgi/team/growth/del
标注团队里程碑 | cgi/team/growth/mark
修改团队里程碑 | cgi/team/growth/set
新增团队里程碑 | cgi/team/growth/add

## 关系类接口
名称|路径
----|----
添加团队成员 | cgi/team/member/add
通过 添加团队成员 | cgi/user/team/pass
拒绝 添加团队成员 | cgi/user/team/deny
删除团队成员 | cgi/team/user/del
申请加入团队 | cgi/user/team/apply
通过 申请加入团队 | cgi/team/member/pass
拒绝 申请加入团队 | cgi/team/member/deny
关注个人 | cgi/user/follow/user/add
取消关注个人 | cgi/user/follow/user/del
关注团队 | cgi/user/follow/team/add
取消关注团队 | cgi/user/follow/team/del
个人申请导师 | cgi/user/mentor/add
通过 个人申请导师 | cgi/mentor/newbie/pass
拒绝 个人申请导师 | cgi/mentor/newbie/deny
个人取消导师 | cgi/user/mentor/del
解除导师关系 | cgi/mentor/newbie/del
添加好友 | cgi/user/mate/add
通过 添加好友 | cgi/user/mate/pass
拒绝 添加好友 | cgi/user/mate/deny
删除好友关系 | cgi/user/mate/del

## 审核类接口
* 所有的动作都有审核操作，对应的结果有pass(同意)、deny（拒绝）
* 路径格式参考编辑类接口，cgi/pass/*，cgi/deny/*
* 存储结构设计时，所有的结构设计成 double struct，选用标志 using，是否新数据项标识 is_new


## 社会化分享
编号|名称|路径
----|----|----
1 | 社会化分享 | third-party plugin
