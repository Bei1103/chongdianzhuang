1、安装微擎，安装模块。
2、配置公众号信息，之后访问一次后台(必须访问)。
3、服务器命令行运行：
   cd /你网站目录/GatewayWorker;
   php start.php start -d;
4、nginx配置文件添加wss代理：
    #wss代理
    location /wss
     {
       proxy_pass http://127.0.0.1:8787;
       proxy_http_version 1.1;
       proxy_set_header Upgrade $http_upgrade;
       proxy_set_header Connection "Upgrade";
        proxy_set_header X-Real-IP $remote_addr;
     }
 5、服务器安全组放行端口8787;宝塔面板同样;
 6、访问后台-设备，查看 本地服务连接 和 远端服务连接 是否已连接
 7、设置-交易-支付管理 添加支付分配置，支付设置 下拉选择支付分