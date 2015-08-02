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
r-follow | 指导 | 拜师，反向关注；newbie/team 把自己的成果展示个 mentor
card | 名片 | 团队与个人的名片，标识个人的基本信息
member | 成员 | 团队的成员

## 隐私保护
隐私程度 | 中文名 | 含义
----|----|----
public | 公开 | 所有人可见，不需要特殊的权限
protected | 保护 | 用户的密友圈、导师可见；团队的密友圈、顾问可见
private | 私有 | 仅 用户本人可见；仅团队成员可见

## 团队的几个特殊类型
名称 | 中文名 | 含义
----|----|----
myspace | 私人空间 | 自己的空间
mate | 密友圈| 好朋友，亲密圈子，替代通讯录功能
group | 圈子 | 兴趣组，拥有共同学习兴趣的几个人
class | 班级 | 学习组，相同导师下的学员
manongdahui | 码农大会 | 分享会，发布活动信息

## 查询类接口
编号|名称|路径
----|----|----
1 | 登录 | cgi/login
2 | 注册 | cgi/reg
3 | 个人名片 | cgi/user/card
4 | 团队卡片 | cgi/team/card
5 | 个人大事记 | cgi/user/event
6 | 团队大事记 | cgi/team/event
7 | 个人成长列表 | cgi/user/growth
8 | 团队成长列表 | cgi/team/growth
9 | 个人成长 | cgi/user/growth/${growth_id}
10 | 团队成长 | cgi/team/growth/${growth_id}
11 | 加入的团队 | cgi/user/team
12 | 团队领袖 | cgi/team/leader
13 | 团队成员 | cgi/team/member
14 | 我的关注 | cgi/user/follow
15 | 我的关注者 | cgi/user/fellow
16 | 我的导师 | cgi/user/mentor
17 | 我的学员 | cgi/user/newbie
18 | 推荐动态 | cgi/user/rec
19 | 分享团队 | cgi/share/t/${team_id}
20 | 分享个人 | cgi/share/u/${user_id}
21 | 分享成长 | cgi/share/g/${growth_id}
22 | 分享活动 | cgi/share/a/${activity_id}
