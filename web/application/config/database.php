<?php

return array(
    'default-connection' => 'concrete',
    'connections' => array(
        'concrete' => array(
            'driver' => 'c5_pdo_mysql',
            'server' => 'localhost',
            'database' => 'spt_restore',
            'username' => 'spt',
            'password' => 'p@s$w0rd',
            'charset' => 'utf8'
        )
    )
);
