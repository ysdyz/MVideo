# MVideo

1. 自动采集影视资源
2. 在线播放功能
3. 搜索全网资源功能
4. 无需数据库

对接资源站点：zuida.me 做到实时更新

推荐配置：Nginx+PHP7.1

演示站点：[https://cbox.ooo](https://cbox.ooo)


## 伪静态配置规则

### Nginx

```
location / {
	rewrite ^/list/?([0-9]+)?/?$ /index.php?id=$1;
	rewrite ^/play/?([0-9]+)?/?$ /lib/play.php?id=$1;
	rewrite ^/search/([^/]+)/?$ /lib/search.php?key=$1;
	rewrite ^/zhibo.html /lib/zhibo.php;
	rewrite ^/password.html /lib/password.php;
}
```

### Apache

```
RewriteEngine On
RewriteRule ^list/?([0-9]+)?/?$ index.php?id=$1
RewriteRule ^play/?([0-9]+)?/?$ lib/play.php?id=$1
RewriteRule ^search/([^/]+)/?$ lib/search.php?key=$1
RewriteRule ^zhibo.html lib/zhibo.php
RewriteRule ^password.html lib/password.php
```