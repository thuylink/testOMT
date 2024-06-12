<?php

defined('PATHDEFAULT') OR exit('Không có quyền truy cập');

global $autoload;

$autoload['libraries'] = [
    'route',
    'database',
    'mail',
    'jwt'
];

$autoload['helper'] = [
    'data',
    'format',
    'prem'
];