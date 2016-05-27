<?php

require_once __DIR__ . '/vendor/autoload.php';

// nette\database setup
$connection = new Nette\Database\Connection('sqlite::memory:');
$cache = new Nette\Caching\Storages\FileStorage(__DIR__ . '/files/cache');
$structure = new Nette\Database\Structure($connection, $cache);

// package part
$filerManager = new Zenify\NetteDatabaseFilters\FilterManager();
$filerManager->addFilter(new Zenify\NetteDatabaseFilters\SimpleFilter());

$db = new Zenify\NetteDatabaseFilters\Database\SmartContext($connection, $structure, NULL, NULL, $filerManager);

$pdo = $connection->getPdo();

// 1. create table user + fill some data
$pdo->prepare('CREATE TABLE user (name VARCHAR);')
    ->execute();
$pdo->prepare('INSERT INTO user VALUES ("Tom");')
    ->execute();

// 3. get data
$users = $db->table('user')
    ->fetchAll();

// 4. render data
foreach ($users as $user) {
    echo "My name is: " . $user->name . PHP_EOL;
}
