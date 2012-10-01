<?php

/**
 * simple script to purge the cache
 */

$app = require __DIR__ . '/../bootstrap.php';

$app['statement_cache_handler']->purge();

