<?php

require_once __DIR__ . '/vendor/autoload.php';

$connection = new Nette\Database\Connection('sqlite::memory:');
$cache = new Nette\Caching\Storages\FileStorage(__DIR__ . '/files/cache');
$structure = new Nette\Database\Structure($connection, $cache);
$db = new Nette\Database\Context($connection, $structure);

$pdo = $connection->getPdo();

// 1. create table user
$pdo->prepare('CREATE TABLE user (name VARCHAR);')->execute();

// 2. fill some data
$pdo->prepare('INSERT INTO user VALUES ("Tom");')->execute();

// TODO x. add filter to skip records: where 'name="Tom"'


// 3. get data
$users = $db->table('user')
    ->fetchAll();

// 4. render data
foreach ($users as $user) {
    echo "My name is: " . $user->name . PHP_EOL;
}
