<?php

require_once '/../vendor/autoload.php';

$client = new Elasticsearch\Client([
	'hosts'=>['127.0.0.1:9200']
	]);