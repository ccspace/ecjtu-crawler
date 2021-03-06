# Ecjtu Crawler

- 简单的获取信息接口

- 目前提供的组件（命名空间Megoc\Ecjtu\Components）
  - Education 教务管理系统（获取教务相关如成绩、考试、学分、实验、课表、教务处公告等）
  - Elective 选课系统（获取选课、公共任选课、教师简历等）
  - Library 图书馆（借阅历史等）
  - Portal 智慧交大（通知公告、失物招领、cas认证等）
  - PortalCAS 智慧交大CAS认证（cas认证登录支持的子系统）

- How use

```php
// 所有组件都通过数组 $user = [
//     'username' => 'your username',
//     'password' => 'your password',
// ] 形式传递登录信息，你可以在实例化时传递，也可以通过实例后的对象手动调用login方法完成登录操作。
// 示例代码
$educaiton = new Megoc\Ecjtu\Components\Education([
    'username' => 'your username',
    'password' => 'your password',
]);

// 获取2018.1学期的成绩
$score = $educaiton->score('2018.1');
var_dump($score);

// and so on...

```

## 组件接口及返回数据

- Education 组件

| 方法名称 | 参数列表 | 返回值类型 | 备注说明 |
| ------ | ------ | ------ | ------ |
| score | string $term | array | 成绩 |
| credit |  | array | 学分获得情况 |
| second_credit |  | array | 第二课堂学分获得情况 |
| schedule | string $term | array | 课表 |
| week_schedule | string $week </br> string $term | array | 周历 |
| daily | string $date | array | 日历 |
| exam | string $term | array | 考试安排 |
| bexam | string $term | array | 补考安排 |
| experiment | string $term | array | 实验安排 |
| classmate | string $class_id | array | 班级名单 |
| profile |  | array | 账号信息 |
| class_number | string $term | array | 小班序号 |
| class_list | string $college </br> string $grade | array | 班级列表 |
| college_list |  | array | 学院列表 |
| cas_authority | string $uid </br> string $cas_link |  | cas认证登录 |
| login | array $user |  | 登录 |
| notifications | integer $page | array | 通知公告 |
| notification_detail | string $resource_id | array | 通知公告信息 |

- Elective 组件

| 方法名称 | 参数列表 | 返回值类型 | 备注说明 |
| ------ | ------ | ------ | ------ |
| course | string $term | array | 我的选课 |
| profile |  | array | 账号信息 |
| public_course_list | integer $page | array | 公共任选课列表 |
| teacher_resume | string $teacher_task_id | array | 教师简历 |
| course_select_info |  | array | 选课信息 |
| cas_authority | string $uid </br> string $cas_link |  | cas认证登录 |
| login | array $user |  | 登录 |

- Library 组件

| 方法名称 | 参数列表 | 返回值类型 | 备注说明 |
| ------ | ------ | ------ | ------ |
| history | integer $page | array | 历史借阅记录 |
| profile |  | array | 账号信息 |
| cas_authority | string $uid </br> string $cas_link |  | cas认证登录 |
| login | array $user |  | 登录 |

- Portal 组件

| 方法名称 | 参数列表 | 返回值类型 | 备注说明 |
| ------ | ------ | ------ | ------ |
| notifications | integer $page </br> integer $page_size | array | 通知公告 |
| notification_detail | string $resource_id | array | 通知公告详细信息 |
| lost_notifications | integer $page </br> integer $page_size | array | 失物招领公告 |
| profile |  | array | 账号信息 |
| cas_authority | string $uid </br> string $cas_link |  | cas认证登录 |
| login | array $user |  | 登录 |

- PortalCAS 组件

| 方法名称 | 参数列表 | 返回值类型 | 备注说明 |
| ------ | ------ | ------ | ------ |
| cas_authority_link | string $service_cas_uri </br> string $cas_link | string | cas认证登录链接 |
| login | array $user |  | 登录 |
| encrypted_password | string $password | string | 加密密码 |
| service_name2service_uri | string $service_name | string | 根据服务名获取服务cas认证服务器地址 |

## Installing Ecjtu Crawler

The recommended way to install Ecjtu Crawler is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of Ecjtu Crawler:

```bash
php composer.phar require megoc/ecjtu-crawler
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update Ecjtu Crawler using composer:

```bash
composer.phar update
```
