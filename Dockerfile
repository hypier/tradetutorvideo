FROM php:7.2-apache

# 安装 PHP 扩展和依赖
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# 配置 Apache
RUN a2enmod rewrite

# 创建工作目录
WORKDIR /var/www/html

# 复制项目文件
COPY . /var/www/html/

# 确保目录权限正确
RUN chown -R www-data:www-data /var/www/html

# 确保上传目录及其子目录有正确的写入权限
RUN mkdir -p /var/www/html/upload/video /var/www/html/upload/category /var/www/html/upload/notification && \
    chmod -R 777 /var/www/html/upload && \
    chown -R www-data:www-data /var/www/html/upload

# 暴露端口
EXPOSE 80

# 启动 Apache
CMD ["apache2-foreground"] 