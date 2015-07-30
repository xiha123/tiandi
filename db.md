## 基础内容

- 开发后台账号:  tiandi/tiandi

## 关于数据库

- collation 设置为 utf8_general_ci
- 所有表主键为 id

### ad 表

用来放和页面上的广告相关，目前还没使用。

- name 有索引

### admin 表

用来存放管理员。

- name 有索引

### user 表

用来存放普通用户。

- type 0 为学生，1为老师
- name 有索引

### slide 表

用来存放轮播相关。

- status 0 为非展示，1 为展示
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

### course_step 表

存放课程步骤内容。

- title 步骤标题，用于在线课堂页面展示
- img 点开详情的图片
- description 点开详情的描述
- level 点开详情的难度

### course 表

用来存放课程相关信息。

- title 课程名字，有索引
- type 课程分类，有索引，0 3d，1 swift，2 web，3 coco，4 android（有新的再说）
- video 视频地址
- tags 标签列表，JSON对象，key 为标签名
- description 课程描述
- chapters 课程对应的章节，JSON数组，按照 id 排序，顺序为章节顺序
- steps 课程对应的步骤，JSON数组，按照 id 排序，顺序为步骤顺序
