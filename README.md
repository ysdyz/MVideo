# MVideo

1. 自动采集影视资源
2. 在线播放功能
3. 搜索全网资源功能
4. 无需数据库

data文件夹里面的GetMacAdr.class.php是用来取用户MAC地址的,本来是用MAC判断敏感资源访问权限的,结果没有用上文件也没有删除，有需要的可以留着，无需者可直接删除！（该文件在D盾扫描报后门,特此注明）

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
RewriteRule ^list/?([0-9]+)?/?$ index.php?id=$1
RewriteRule ^play/?([0-9]+)?/?$ play.php?id=$1
RewriteRule ^search/?([^/]+)?/?$ search.php?key=$1
```