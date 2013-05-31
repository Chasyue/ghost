http://php-club.org/


Install
-------

### 下载源代码

    git clone https://github.com/tangwenming/Ghost Ghost

### 配置

    cd app/config
    cp parameters.yml.dist parameters.yml
    # 修改其中的数据库连接参数

### 安装依赖包

- 运行 `php composer.phar install` 安装第三方依赖
- 安装 php sundown 扩展（markdown支持），地址：http://pecl.php.net/package/sundown


### 初始化

    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force
    php app/console ghost:acl:installAces
    
### 导入Session数据表结构
    
    mysql -uroot -proot
    use dbname
    source src/Ghost/PostBundle/Resources/doc/schema.sql
    
### 完成

访问 `http://localhost/Ghost` 测试
