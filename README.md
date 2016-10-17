# DigitalPianism_BugFixes

Bug fixes for the following Magento 1.9.3.0 bugs while Magento is working on the new version:

* Every product is displayed while searching in full text mode: http://magento.stackexchange.com/a/140708/2380
* Argument 1 passed to Mage_Api_Model_Server_Handler_Abstract::processingMethodResult() must be of the type array, string given, called in app/code/core/Mage/Api/Model/Server/Handler/Abstract.php: http://magento.stackexchange.com/q/140761/2380
* Auto generated password does not work for some customers (@see: https://gist.github.com/p3mbo/224f01996ff5b4849d189c38325c0bbd)
* Clone price is not updated for bundle products when changing selection: http://magento.stackexchange.com/a/141151/2380
* Store specific labels disappears under certain conditions: https://github.com/digitalpianism/bugfixes/pull/1 (Thanks Arjen Miedema for the PR)

I'm trying to keep an updated list of all bugs here: http://magento.stackexchange.com/a/140826/2380
