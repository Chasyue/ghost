http://ghost.betanews.com.cn


Install
-------

### 下载源代码

    git clone https://github.com/tangwenming/Ghost Ghost

### 配置

    cd app/config
    cp parameters.yml.dist parameters.yml
    # 修改其中的数据库连接参数

### 安装依赖包

- 运行 `php composer.phar install` 安装vendor
- 安装 php sundown 扩展（markdown支持）


### 初始化

    php app/console doctrine:database:create
    php app/console doctrine:shema:update
    php app/console ghost:acl:installAces
    
### 导入Session数据表结构
    
    mysql -uroot -proot
    source src/Ghost/PostBundle/Resources/doc/schema.sql
    
### 完成

访问 `http://localhost/Ghostbb/` 测试
