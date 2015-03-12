<?php
ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . dirname(__FILE__) . '/../../src/');
ini_set('memory_limit', '512M');
require_once 'app/Mage.php';
\Mage::app('default');
