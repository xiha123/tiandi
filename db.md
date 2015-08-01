## 基础内容

- 开发后台账号:  tiandi/tiandi

## 关于数据库

- collation 设置为 utf8_general_ci
- 所有表主键为 id
- 所有 status 都 0 为非激活，1 为激活

### ad 表

用来放和页面上的广告相关，目前还没使用。

- name 有索引
- img
- link
- text
- status

### site 表

用来存放一些网站相关信息，比如 QQ、电话什么的，目前还没使用。

### admin 表

用来存放管理员。

- pwd
- salt
- nickname 昵称
- name 有索引
- status

### user 表

用来存放普通用户。

- pwd
- salt
- nickname 昵称
- type 0 为学生，1 为老师，2 为申请老师审核中
- name 有索引
- avatar 头像
- email 邮箱
- cellphone 手机号
- description 个人描述
- collect_count 收藏的数量
- follow_count 关注的数量
- ask_count 提问的数量
- answer_count 回答的数量
- collect_problems 收藏列表，JSON数组
- follow_problems 关注列表，JSON数组
- skilled_tags 擅长的标签，JSON数组
- alipay 支付宝账号
- gold_coin 金币数量
- silver_coin 银币数量
- status

### class_guide

用来存放在线课堂页面的 guide。

- name
- img
- link
- status

### tag

用来存放 tag 相关。

- type 0 为 course，1 为问题
- name 有索引
- count 属于这个 tag 的数量
- status

### slide 表

用来存放轮播相关。

- status
- name 用来搜索和 alt 显示的，有索引
- img 图片地址
- link 目标跳转地址
- color 背景色
- type 0 为首页，1 为在线课堂
- text 为在线课堂轮播提供内容，JSON: info, schedule

### course_chapter 表

存放课程章节内容。

- title 章节标题
- content 章节内容
- course_id

### course_step 表

存放课程步骤内容。

- title 步骤标题，用于在线课堂页面展示
- img 点开详情的图片
- description 点开详情的描述
- level 点开详情的难度
- course_id

### course 表

用来存放课程相关信息。

- status
- title 课程名字，有索引
- type 课程分类，有索引，0 3d，1 swift，2 web，3 coco，4 android（有新的再说）
- video 视频地址
- tags 标签列表，JSON对象，key 为 tag 表的 id
- description 课程描述
- chapters 课程对应的章节，JSON数组，按照 id 排序，顺序为章节顺序
- steps 课程对应的步骤，JSON数组，按照 id 排序，顺序为步骤顺序

### problem 表

用来存放用户提问。

- status
- type 0 未回答，1 认领中，2 已回答，3 关闭
- title
- owner_id 提问者 id
- answer_id 回答者 id
- details 问题详情（学生提问，老师回答）,JSON数组
- comments 问题下面的评论，JSON数组
- tags 标签列表，JSON对象，key 为 tag 表的 id
- up_count 被赞的次数
- down_count 被踩的次数
- collect_count 被收藏的次数
- follow_count 被关注的次数
- view_count 被浏览的次数
- ctime 创建时间

### problem_detail 表

存放问题详情。

- content
- type 0 为提问，1 为回答
- owner_id 发表这个详情的人的 id
- ctime 创建时间
- problem_id

### problem_comment 表

存放问题评论。

- content
- owner_id
- ctime 创建时间
- problem_id

### news 表

存放新消息提醒。

- type
- target
- content

### note 表

存放笔记。

- status
- title
- content
- owner_id
