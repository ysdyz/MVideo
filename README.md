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
	rewrite ^/list/?([0-9]+)?/?$ /index.php?id=$1 last;
	rewrite ^/play/?([0-9]+)?/?$ /play.php?id=$1 last;
	rewrite ^/search/?([^/]+)?/?$ /search.php?key=$1 last;
}
```

### Apache

```
RewriteEngine On
RewriteCond %{QUERY_STRING} (^|&)id=\$1($|&)
RewriteRule ^index\.php$ /list/?([0-9]+)?/?$&%{QUERY_STRING}
RewriteCond %{QUERY_STRING} (^|&)id=\$1($|&)
RewriteRule ^play\.php$ /play/?([0-9]+)?/?$&%{QUERY_STRING}
RewriteCond %{QUERY_STRING} (^|&)key=\$1($|&)
RewriteRule ^search\.php$ /search/?([0-9]+)?/?$&%{QUERY_STRING}
```