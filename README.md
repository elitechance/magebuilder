magebuilder
===========

PHP script for prototyping/scaffolding Magento modules, models, controllers, and blocks

FEATURES
--------

1. Supports templating for Magento group types: models, helpers, controllers, and blocks
2. Supports group type templating with custom extends
3. Automates Magento module directory structure: etc, controllers, Model, Block, ...
4. Supports Cache Refresh (No need for admin page)
5. Detects class type file location
6. Supports adding event listener

Getting Started
---------------

#### Setting Magento root path
> $ php magebuidler.php init /var/www/magento

#### Creating module

> Module Name: **Test_MageBuilder**

> Module ID: **mbuilder**

This will create the following:

- app/etc/modules/Test_MageBuilder.xml
- app/code/local/Test/MageBuilder/etc
- app/code/local/Test/MageBuilder/etc/config.xml
- app/code/local/Test/MageBuilder/sql/mbuilder_setup
- app/code/local/Test/MageBuilder/controllers
- app/code/local/Test/MageBuilder/Helper
- app/code/local/Test/MageBuilder/Model
- app/code/local/Test/MageBuilder/Block

>$ php magebuilder.php create-module **test_mageBuilder mbuilder**

By default, code pool is set to **local**.  If you want specify a different code pool:

>$ php magebuilder.php create-module test_mageBuilder mbuilder **community**


#### Creating models

This will create Test/MageBuilder/Model/Model1.php

> $ php magebuilder.php create-model mbuilder/model1

This will create Test/MageBuilder/Model/Ns/Model2.php

> $ php magebuilder.php create-model mbuilder/ns_model2

#### Creating helpers

> $ php magebuilder.php create-helper mbuilder

> $ php magebuilder.php create-helper mbuilder/data2

#### Creating blocks

> $ php magebuilder.php create-blocks mbuilder/header

> $ php magebuilder.php create-blocks mbuilder/home_footer

#### Creating class contollers

This will create Test/MageBuilder/Controller/Abstract.php

> $ php magebuilder.php create-controller mbuilder/abstract

This will create Test/MageBuilder/Controller/Api/Abstract.php

> $ php magebuilder.php create-controller mbuilder/api_abstract

#### Creating MVC contollers

This will create Test/MageBuilder/controllers/IndexController.php

> $ php magebuilder.php create-mvcontroller mbuilder/index

This will create Test/MageBuilder/controllers/Admin/ApiController.php

> $ php magebuilder.php create-mvc-controller mbuilder/admin_api

#### Extending custom class

This will create the same model class

> $ php magebuilder.php create-model mbuilder/model

> $ php magebuilder.php create-model mbuilder/model extends core/abstract

Extending custom class

> $ php magebuilder.php create-model mbuilder/model extends mbuilder/abstract

#### Checking paths

> $ php magebuilder.php check-path model sales/order

> $ php magebuilder.php check-path model sales/order_invoice_api

#### Checking for file location

> $ php magebuilder.php check-class model sales/order


### Creating Project

This is shortcut for:

- $ php magebuilder.php create-module test_project testprj
- $ php magebuilder.php create-model testprj/hello
- $ php magebuilder.php create-helper testprj
- $ php magebuilder.php create-mvc-controller testprj/index

> $ php magebuilder.php create-project test_project testprj
