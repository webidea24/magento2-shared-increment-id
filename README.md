# Magento 2 Module to enable shared increment ids

## Description

This module enables the functionality to share the increment ids over the stores. So you can use the same number range
and format for all your stores.

You can enable this feature for the following entities:

* order
* invoice
* credit memo
* shipping
* any other entity which inherit from the class `Magento\Sales\Model\ResourceModel\EntityAbstract`

Enable/Disable the module for the entities in your store configuration

```
Shops > Configuration > WEBIDEA > Shared increment id
```
