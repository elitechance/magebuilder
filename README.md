magebuilder
===========

PHP script for prototyping/scaffolding Magento modules, models, controllers, and blocks

Setting your Magento document root path
---
- $ php magebuidler.php init /var/www/magento


Creating module
---
> *Module Name:* Test_MageBuilder

> *Alias:* mbuilder

*This will create the following:*
- app/etc/modules/Test_MageBuilder.xml
- app/code/local/Test/MageBuilder/etc
- app/code/local/Test/MageBuilder/etc/config.xml
- app/code/local/Test/MageBuilder/sql/mbuilder_setup
- app/code/local/Test/MageBuilder/controllers
- app/code/local/Test/MageBuilder/Helper
- app/code/local/Test/MageBuilder/Model
- app/code/local/Test/MageBuilder/Block

>$ php magebuilder.php create-module test_mageBuilder mbuilder

*If you want a different code pool*

>$ php magebuilder.php create-module test_mageBuilder mbuilder *community*


Creating models
---
- $ php magebuilder.php create-model mbuilder/model1
- $ php magebuilder.php create-model mbuilder/ns_model2

Creating helper
---
- $ php magebuilder.php create-helper mbuilder
- $ php magebuilder.php create-helper mbuilder/data2

Creating contollers
---
- $ php magebuilder.php create-controllers mbuilder/index
- $ php magebuilder.php create-controllers mbuilder/admin
- $ php magebuilder.php create-controllers mbuilder/admin_api

Creating blocks
---
- $ php magebuilder.php create-blocks mbuilder/header
- $ php magebuilder.php create-blocks mbuilder/home_footer


Creating Project
====
*This is a shortcut of:*
- $ php magebuilder.php create-module test_project testprj
- $ php magebuilder.php create-model testprj/hello
- $ php magebuilder.php create-helper testprj
- $ php magebuilder.php create-controller testprj/index

> $ php magebuilder.php create-prject test_project testprj
