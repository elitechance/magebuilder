magebuilder
===========

PHP script for prototyping/scaffolding Magento modules, models, controllers, and blocks

Setting your Magento document root path
---
- $ php magebuidler.php init /you/magento/root/path


Creating module
---
> *Module Name:* Test_MageBuilder

> *Alias:* mbuilder

- $ php magebuilder.php create-project test_mageBuilder mbuilder


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
