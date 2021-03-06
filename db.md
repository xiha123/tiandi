## 基础内容

- 开发后台账号:  tiandi/tiandi

## 关于数据库

- collation 设置为 utf8_general_ci
- 所有表主键为 id

### ad 表

用来放和页面上的广告相关，目前还没使用。

- name 有索引
- img
- link
- text

### site 表

用来存放一些网站相关信息。

- type 内容的类型
    - 001 在线课堂课程
    - 002 在线课堂课表
- content 内容

### admin 表

用来存放管理员。

- pwd
- salt
- nickname 昵称
- name 有索引
- type 1 最高权限管理员，2 普通权限管理员
- limit 限制普通管理员可以使用那些功能，JSON数组

### user 表

用来存放普通用户。

- pwd
- salt
- nickname 昵称
- name 真实姓名
- email 邮箱，用作登录
- type -1 邮箱未认证， 0 为学生，1 为老师，2 为申请老师审核中
- avatar 头像
- cellphone 手机号
- description 个人描述
- god_description 大神描述
- collect_problem_count 收藏的问题数量
- collect_problems 收藏列表，id数组
- ask_count 提问的数量
- answer_count 回答的数量
- follow_user_count 关注的人的数量
- follow_users 关注的用户，id数组
- follower_count 被多少人关注
- followers 被哪些用户关注，id数组
- skilled_tags 收藏的标签，JSON数组
- god_skilled_tags 大神擅长的标签，JSON数组
- alipay 支付宝账号
- gold_coin 金币数量
- silver_coin 银币数量
- notes 拥有的笔记组，JSON数组
- fathcer_tag 父标签 0 3d，1 swift，2 web，3 coco，4 android
- Integral 积分
- lost_time 上次登录时间，方便计算可否赠其银币
- prestige 威望用于老师
- chou 我众筹了那些问题
- teacher 是否为讲师
- key 一个随机的字符串（长度随机）用来激活邮箱或找回密码等操作，该字符串不是永久固定的
- email_active 邮箱是否激活了 0 未激活，1激活
- course 用来存放大神用户所开课程，JSON数组
- oauth_key 第三方登录后账号关联的凭证，头像地址for qq
- god_course_count 用来存放 god_course 的数量，和 god_course 表中的数据一致
- register_ip 注册IP
- last_login_ip 最后一次登录的IP

### class_guide

用来存放在线课堂页面的 guide。

- name
- img
- link

### tag

用来存放 tag 相关。

- type 0 为 course，1 为问题
- name 有索引
- count 属于这个 tag 的数量
- content tag描述
- json_who 谁收藏了这个标签
- link tag对应的链接
- active_god 标签活跃大神 {user_id:count}
- active_stu 标签活跃学员，同上

### slide 表

用来存放轮播相关。

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

- title 课程名字，有索引
- type 课程分类，有索引，0 3d，1 swift，2 web，3 coco，4 android（有新的再说）
- video 视频地址
- tags 标签列表，JSON对象，key 为 tag 表的 id
- description 课程描述
- site 课程的一些设置
- steps 课程对应的步骤，JSON数组，按照 id 排序，顺序为步骤顺序
- god 该课程由那些大神上课，JSON数组

### problem 表

用来存放用户提问。

- type 0 未回答，1 认领中，2 已回答，3 关闭
- title
- owner_id 提问者 id
- answer_id 回答者 id
- answer_time 回答者认领的时间
- details 问题详情（学生提问，老师回答）,JSON数组
- comments 问题下面的评论，JSON数组
- tags 标签列表，JSON对象，key 为 tag 表的 id
- up_count 被赞的次数
- up_users 被哪些人赞，JSON
- collect_count 被收藏的次数
- collect_users 被那些人收藏，JSON
- view_count 被浏览的次数
- ctime 创建时间
- hot 火热值，计算方式为：up * 5 + comment_count * 1 + collect_cout * 3 + view_count * 0.01
- down_users 被哪些人踩，JSON
- gold_coin 问题价值，金币
- silver_coin 问题价值，银币
- who 谁参加了众筹
- online 谁在线围观了这个问题 ,JSON数组
- agree 是不是满意了

### problem_detail 表

存放问题详情。

- content
- type 0 为提问，1 为回答，3 为在线保存
- owner_id 发表这个详情的人的 id
- ctime 创建时间
- problem_id
- language

### problem_comment 表

存放问题评论。

- content
- owner_id
- ctime 创建时间
- problem_id

### news 表

存放新消息提醒。

- type
    - 0xx 账户通知
        - 000 注册成功
        - 001 密码重置
        - 002 激活成功
    - 1xx 申请大神
        - 100 提交申请
        - 101 申请通过
        - 102 申请拒绝
    - 2xx 提问相关
        - 200 被认领
        - 201 被回答
        - 202 被评论
    - 3xx 众筹相关
        - 300 参与成功
        - 301 被回答
    - 4xx 大神相关
        - 400 被满意
        - 401 认领过期
        - 402 金币到账
    - 5xx 社交相关
        - 500 被关注
- target
- problem_id
- from_id
- status 0 未读 1 已读
- ctime

### note 表

存放笔记。

- title
- content
- owner_id 所有者 id
- group_id 所属笔记组 id

### note_group 表

存放笔记组

- name 名字
- list 笔记 id 列表
- owner_id 所有者 id

### god_course

存放大神在腾讯课堂上的课程

- god 大神的 id
- link
- img
- title
