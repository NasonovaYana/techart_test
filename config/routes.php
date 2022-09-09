<?php
return [
    '^news.php$' => 'news/index',
    '^news.php?page=[0-9]+$' => 'news/index',
    '^view\.php\?id=([0-9]+)$' => 'news/view/$1',
];