# module-generator

## 游戏简介

为laravel生成如下的项目结构，方便管理和书写。

## 游戏地图

```
app |
    |- Base |
            |--- Repository
            |--- Transformer
            |--- Job

    |- Module |
              |--- Xxxx   |
                          |--- Conf
                          |--- Model
                          |--- Provider
                          |--- Repository
                          |--- Service      
                          |--- Transformer      
                          |--- XxxInTrait.php      
                          |--- XxxModule.php      
                          |--- XxxModuleInterface.php      
                          |--- XxxOutTrait.php      
```

## 游戏说明

* app为项目目录：
    * Module为模块目录，将项目分成相应的模块；
        * Config为配置目录（对内）
        * Models为数据库Model目录（对内）
        * Provider为注册目录
        * Repository为数据库操作Model的仓库（对内）
        * Service为处理复杂逻辑（对内）
        * Transformer方法来格式化输出数据（对外）
        * Module文件为模块入口（对外）
        * OutTrait为对外暴露Module和Transformer文件出口（对外）
        * InTrait为调用其他模块的入口（对内）

## 游戏规则

```
1.Controller只能通过OutTrait访问模块，OutTrait只能暴露Module和Transformer这两个对外的文件；
2.Model只能被Repository调用；
3.Repository和Service只能被对应模块中的Module调用，不能对外；
4.跨模块调用只能调用模块的Module，不能调用模块里面其他对象
```

## 使用说明

* 引入

```
composer require birjemin/module-generator
```

* 命令使用

```
php artisan birjemin:module-generator moduleName 
```

* 疑问

> laravel version > 5.5

> [https://github.com/Birjemin/laravel-generator](https://github.com/Birjemin/laravel-generator)