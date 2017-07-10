<?php
use Cake\Core\Configure;

?>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.css" />
<script src="//cdn.jsdelivr.net/instantsearch.js/1/instantsearch.min.js"></script>


<div class="container">

    <div class="col-md-3">
        <div id="search-input"></div>
        <div id="search-input-icon"></div>
    </div>

    <div class="col-md-9">
        <div id="hits"></div>
    </div>
</div>


<script type="text/html" id="hit-template">
    <div class="hit">
        <div class="hit-content">
            <h3 class="hit-title">{{title}}</h3>
            <p class="hit-description">{{{_highlightResult.description.value}}}</p>
        </div>
    </div>
</script>

<script type="text/html" id="no-results-template">
    <div id="no-results-message">
        <p>We didn't find any results for the search <em>"{{query}}"</em>.</p>
        <a href="?" class='clear-all'>Clear search</a>
    </div>
</script>

<script>
    function getTemplate(templateName) {
        return document.querySelector('#' + templateName + '-template').innerHTML;
    }

    var search = instantsearch({
        appId: '<?= Configure::read('Algolia.appId');?>',
        apiKey: '<?= Configure::read('Algolia.apiKey.search');?>',
        indexName: '<?= Configure::read('Algolia.index');?>',
        urlSync: { // optionnal, activate url sync if defined
            useHash: false
        }
    });

    // add a searchBox widget
    search.addWidget(
        instantsearch.widgets.searchBox({
            container: '#search-input',
            placeholder: 'Search for tutorials in Star Tutorial...'
        })
    );

    // add a hits widget
    search.addWidget(
        instantsearch.widgets.hits({
            container: '#hits',
            hitsPerPage: 10,
            templates: {
                item: getTemplate('hit'),
                empty: getTemplate('no-results')
            },
            autoHideContainer: true
        })
    );

    // start
    search.start();
</script>