# CC Plugin

[![Circle CI](https://circleci.com/gh/Ippey/cc-plugin/tree/master.svg?style=svg)](https://circleci.com/gh/Ippey/cc-plugin/tree/master)

WordBench京都 2016/03用デモプロジェクト

## メモ

### Install VCCW
```
vagrant box add miya0001/vccw
wget https://github.com/vccw-team/vccw/archive/2.19.0.zip
unzip tunzip 2.19.0.zip
cd vccw-2.19.0
vagrant up
```

### Install wp-cli（local）
```
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp
```

### Setup Mysql (local)
```
mysql -uroot -p*** mysql
create database wordpress;
CREATE USER wordpress IDENTIFIED BY 'wordpress';
CREATE USER wordpress@localhost IDENTIFIED BY 'wordpress';
GRANT ALL PRIVILEGES ON *.* TO wordpress@localhost;
GRANT ALL PRIVILEGES ON *.* TO wordpress;
```

### Create plugin scaffold
```
cd ***/www/wordpress/wp-content/plugins
wp scaffold plugin cc-plugin

```

### Install Selenium-server
```
wget http://goo.gl/qTy1IB
java -jar selenium-server-standalone-*.jar
```

### Install Codeception
```
cd ***/www/wordpress/wp-content/plugins/cc-plugin
wget http://codeception.com/codecept.phar
php codecept.phar bootstrap
```
```
cd tests
cp bootstrap.php _bootstrap.php
```

### Setup test
```
cd ***/www/wordpress/wp-content/plugins/cc-plugin
./bin/install-wp-tests.sh wordpress_test wordpress wordpress localhost
or
./bin/install-wp-tests.sh wordpress_test wordpress wordpress vccw.dev
```

### Create Unit Test
```
cd ***/www/wordpress/wp-content/plugins/cc-plugin
php codecept.phar generate:test unit AkiyoshiShopManager
```

### Setup AcceptanceTest
``` acceptance.suite.yml
class_name: AcceptanceTester
modules:
    enabled:
        - PhpBrowser:
            url: http://vccw.dev
        - \Helper\Acceptance

env:
  firefox:
    modules:
      enabled:
        - WebDriver:
            url: http://vccw.dev
            browser: firefox
        - \Helper\Acceptance

```

### Create Acceptance Test
```
php codecept.phar generate:cest acceptance CcPlugin
```

### Run Test
```
php codecept.phar run unit
php codecept.phar run acceptance
php codecept.phar run acceptance --env firefox
```
