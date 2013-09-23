CLI TIPS
========

Set the correct path for magebuilder.php inside **mbd.sh** and include or move shortcut scripts in your executable path.

##### Changing directory.

Note that cd is a built-in command that's why we can't use it in pipes

> $ cd `mbcp.sh model sales/order`

##### Editing Magento file with **vim**

> $ mbvim.sh model sales/order
