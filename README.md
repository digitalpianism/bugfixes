Update: Magento has released a new version 1.9.3.1 which addresses all the bugs listed below so please upgrade to the last version and if you have installed that BugFixes module, please uninstall it.

List of files added by the module:

* `app/code/community/DigitalPianism/BugFixes`
* `app/etc/modules/DigitalPianism_BugFixes.xml`
* `app/code/local/Mage/Api/Model/Server/Handler/Abstract.php`
* `app/code/local/Mage/Catalog/Helper/Product/Type/Composite.php`
* `app/code/local/Mage/CatalogSearch/Model/Resource/Fulltext.php`
* `app/code/local/Mage/CatalogSearch/Model/Resource/Fulltext/Collection.php`
* `app/code/local/Mage/Core/Model/Session/Abstract/Varien.php`

# Magento 1.9.3.0 Bug Fixes

Bug fixes for the following Magento 1.9.3.0 bugs while Magento is working on the new version:

* Every product is displayed while searching in full text mode: http://magento.stackexchange.com/a/140708/2380
* Argument 1 passed to Mage_Api_Model_Server_Handler_Abstract::processingMethodResult() must be of the type array, string given, called in app/code/core/Mage/Api/Model/Server/Handler/Abstract.php: http://magento.stackexchange.com/q/140761/2380
* Auto generated password does not work for some customers (@see: https://gist.github.com/p3mbo/224f01996ff5b4849d189c38325c0bbd)
* Clone price is not updated for bundle products when changing selection: http://magento.stackexchange.com/a/141151/2380
* Store specific labels disappears under certain conditions: https://github.com/digitalpianism/bugfixes/pull/1 (Thanks Arjen Miedema for the PR)
* Undefined index: session_expire_timestamp: https://tomlankhorst.nl/fix-magento-undefined-index-session_expire_timestamp/
* Freeshipping salesrule calculated based on price excluding tax: https://github.com/digitalpianism/bugfixes/issues/4 (Thanks Andy Smart for the fix and procedure)
* Password Flow Cron Job does not work: https://github.com/digitalpianism/bugfixes/issues/6
* Every page redirects to the homepage when session cookie lifetime is set to 0: https://github.com/digitalpianism/bugfixes/pull/7

I'm trying to keep an updated list of all bugs here: http://magento.stackexchange.com/a/140826/2380

# Backward incompatibility with modules using the gallery uploader

There is a BC with modules using the gallery uploader. I've investigated the issue and a "simple" fix is unfortunately not possible for a few reasons:

* the uploader config has been split into two different models (uploader and button config)
* the js constructor has been modified from 3 to 2 parameters

Thus I have written a small documentation to make your modules backward/forward compatible between version: http://magento.stackexchange.com/a/142013/2380
