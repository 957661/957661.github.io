# 域名单页 + PHP 后台（免数据库）

## 上传即可用
将整个 `domain_panel_pkg` 文件夹内的所有内容上传到你的服务器（支持 PHP 7.2+）。
然后访问：
- 前台：`/index.php`（已嵌入你提供的前端样式与交互）
- 后台：`/admin.php`（默认账号 admin / 密码 admin123）

> 首次上线后，请立即编辑 `config.php` 修改后台账号与密码！

## 功能
- 免数据库，使用 `data/*.json` 持久化保存数据
- 后台可：新增/编辑/删除域名、管理“已出售”滚动条
- 前台自动读取 JSON 数据并展示（已和你的单页对接）

## 文件结构
- `index.php`：网站前台（基于你提供的 HTML 页面改造，数据由 PHP 注入）
- `admin.php`：简单后台管理（登录、增删改）
- `config.php`：后台登录配置
- `functions.php`：读写 JSON、会话、CSRF 辅助
- `data/domains.json`：域名列表
- `data/sold.json`：已出售列表

## 使用建议
- 上传前，先在本地修改 `config.php` 的账号密码
- 如果服务器 `data` 目录不可写，请为该目录设置写权限（如 `chmod 755` 或 `chmod 775/777` 视主机而定）
- 想回到初始数据：清空 `data/*.json` 内容为 `[]` 即可