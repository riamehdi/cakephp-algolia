# Algolia plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require be-mohand/cakephp-algolia
```

## Configuration

In your configuration file (for instance app_local.php), add the Algolia key configuration:

```
<?php

return [
    'Algolia' => [
        'appId' => 'xxxx',
        'apiKey' => [
            'backend' => 'xxxxxxxxxxxx',
            'search' => 'xxxxxxxxxxxx',
        ],
        'index' => 'your_index_name',
    ]
];
```

You can create your Algolia account at at https://www.algolia.com.

Load the Algolia.Algolia behavior in the Table you want to index and add a virtual field in the corresponding entity:
```
    protected $_virtual = ['objectID'];

    public function _getObjectID()
    {
        return $this->id;
    }
```

## Import your data in Algolia

Before starting to use the Algolia powerful search engine, you have to sync your data with Algolia database.

For the purpose, you can use the ImportToAlgoliaShell like this:
```
bin/cake Algolia.ImportToAlgolia --url your_public_url
```

your_public_url should point to a json file. You can create this json file on the fly with an action like this:
```

```

Warning: an objectID key is required. Use the primary key

## Implementing search in front

Algolia provides an out of box solution for building a search engine. It is named instantsearch.js.

Start to load the needed js and css files in your template:
```
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.css" />
<script src="//cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.js"></script>
```

You need a dummy action with a template where Algolia files are loaded. You can use an example of a working template in Algolia/src/Template/example.ctp.

## Auto-Update entities when modified/deleted


## Known issues

When the DebugKit is loaded, we have this error:
```toolbar.js:62 Refused to get unsafe header "X-DEBUGKIT-ID"```



## Thanks

The starting point of the plugin is the excellent article from [startutorial](https://www.startutorial.com/articles/view/building-custom-search-engine-with-algolia-and-cakephp-3).

Thanks to the author.

TODO
----
* Manage conditions of the entities we want to index
* Manage the query to reindex when creating/updating from the AlgoliaBehavior
* indicate a custom ranking
* manage the searchableAttributes
* manage synonyms