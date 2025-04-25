# 视频应用后端 Docker 部署指南

## 项目说明
这是 Your Videos Channel 视频应用的后端管理系统，使用 PHP 和 MySQL 构建。本指南介绍如何使用 Docker 部署该项目。

## 环境要求
- Docker
- Docker Compose

## 快速开始

### 1. 克隆项目
```bash
git clone <项目仓库地址>
cd your_videos_channel
```

### 2. 构建并启动 Docker 容器
```bash
docker-compose up -d
```

### 3. 访问后台管理面板
在浏览器中访问: http://localhost:8080

### 4. 数据库信息
- 数据库名: your_videos_channel_db
- 用户名: root
- 密码: root_password
- 主机: db (容器内) 或 localhost:3306 (主机访问)

## 目录结构说明
- `/api` - API 接口文件
- `/assets` - 静态资源文件
- `/db` - 数据库初始化文件
- `/includes` - 公共组件和配置文件
- `/upload` - 上传文件存储目录

## 技术栈
- PHP 7.2
- Apache
- MySQL 5.7

## 数据库配置
数据库配置文件位于 `includes/config.php`，默认使用 Docker 环境变量进行配置。

## 注意事项
1. 项目挂载了本地目录，修改源代码后无需重新构建镜像
2. MySQL 数据持久化存储在 Docker 卷中
3. 首次运行会自动导入 `/db` 目录下的 SQL 文件
4. 默认后台访问端口为 8080，可在 docker-compose.yml 中修改 