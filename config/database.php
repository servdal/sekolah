<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for database operations. This is
    | the connection which will be utilized unless another connection
    | is explicitly specified when you execute a query / statement.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Below are all of the database connections defined for your application.
    | An example configuration is provided for each database system which
    | is supported by Laravel. You're free to add / remove connections.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DB_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
            'busy_timeout' => null,
            'journal_mode' => null,
            'synchronous' => null,
            'transaction_mode' => 'DEFERRED',
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                (PHP_VERSION_ID >= 80500 ? \Pdo\Mysql::ATTR_SSL_CA : \PDO::MYSQL_ATTR_SSL_CA) => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        'sqlbumnuma' => [
            'driver'        => 'mysql',
            'host'	        => env('DB_HOST_SQLBUMNUMA'),
            'port'          => env('DB_PORT_SQLBUMNUMA'),
            'database'      => env('DB_DATABASE_SQLBUMNUMA'),
            'username'      => env('DB_USERNAME_SQLBUMNUMA'),
            'password'      => env('DB_PASSWORD_SQLBUMNUMA'),
        ],
        'sqldestana' => [
            'driver'        => 'mysql',
            'host'	        => env('DB_HOST_SQLDESTANA'),
            'port'          => env('DB_PORT_SQLDESTANA'),
            'database'      => env('DB_DATABASE_SQLDESTANA'),
            'username'      => env('DB_USERNAME_SQLDESTANA'),
            'password'      => env('DB_PASSWORD_SQLDESTANA'),
        ],
        'sqlmasjid' => [
            'driver'        => 'mysql',
            'host'	        => env('DB_HOST_SQLMASJID'),
            'port'          => env('DB_PORT_SQLMASJID'),
            'database'      => env('DB_DATABASE_SQLMASJID'),
            'username'      => env('DB_USERNAME_SQLMASJID'),
            'password'      => env('DB_PASSWORD_SQLMASJID'),
        ],
        'nuswim' => [
            'driver'        => 'mysql',
            'host'	        => env('DB_HOST_SQLNUSWIM'),
            'port'          => env('DB_PORT_SQLNUSWIM'),
            'database'      => env('DB_DATABASE_SQLNUSWIM'),
            'username'      => env('DB_USERNAME_SQLNUSWIM'),
            'password'      => env('DB_PASSWORD_SQLNUSWIM'),
        ],
        'simaster' => [
            'driver'        => 'mysql',
            'url'           => env('DB_URL_SQLSIMASTER'),
            'host'	        => env('DB_HOST_SQLSIMASTER'),
            'port'          => env('DB_PORT_SQLSIMASTER'),
            'database'      => env('DB_DATABASE_SQLSIMASTER'),
            'username'      => env('DB_USERNAME_SQLSIMASTER'),
            'password'      => env('DB_PASSWORD_SQLSIMASTER'),
            'unix_socket'   => env('DB_SOCKET_SQLSIMASTER', ''),
            'charset'       => env('DB_CHARSET_SQLSIMASTER', env('DB_CHARSET', 'utf8mb4')),
            'collation'     => env('DB_COLLATION_SQLSIMASTER', env('DB_COLLATION', 'utf8mb4_unicode_ci')),
            'prefix'        => '',
            'prefix_indexes'=> true,
            'strict'        => true,
            'engine'        => null,
            'options'       => extension_loaded('pdo_mysql') ? array_filter([
                (PHP_VERSION_ID >= 80500 ? \Pdo\Mysql::ATTR_SSL_CA : \PDO::MYSQL_ATTR_SSL_CA) => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
        'simadu' => [
            'driver'        => 'mysql',
            'host'          => env('DB_HOST_SQLSIMADU'),
            'port'          => env('DB_PORT_SQLSIMADU'),
            'database'      => env('DB_DATABASE_SQLSIMADU'),
            'username'      => env('DB_USERNAME_SQLSIMADU'),
            'password'      => env('DB_PASSWORD_SQLSIMADU'),
        ],
        'smartsea' => [
            'driver'        => 'mysql',
            'host'          => env('DB_HOST_SQLSMARTSEA'),
            'port'          => env('DB_PORT_SQLSMARTSEA'),
            'database'      => env('DB_DATABASE_SQLSMARTSEA'),
            'username'      => env('DB_USERNAME_SQLSMARTSEA'),
            'password'      => env('DB_PASSWORD_SQLSMARTSEA'),
        ],
        'wakepen' => [
            'driver'        => 'mysql',
            'host'	        => env('DB_HOST_SQLWAKEPEN'),
            'port'          => env('DB_PORT_SQLWAKEPEN'),
            'database'      => env('DB_DATABASE_SQLWAKEPEN'),
            'username'      => env('DB_USERNAME_SQLWAKEPEN'),
            'password'      => env('DB_PASSWORD_SQLWAKEPEN'),
            'strict'        => false,
        ],
        'mariadb' => [
            'driver' => 'mariadb',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                (PHP_VERSION_ID >= 80500 ? \Pdo\Mysql::ATTR_SSL_CA : \PDO::MYSQL_ATTR_SSL_CA) => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            // 'encrypt' => env('DB_ENCRYPT', 'yes'),
            // 'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'false'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run on the database.
    |
    */

    'migrations' => [
        'table' => 'migrations',
        'update_date_on_publish' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as Memcached. You may define your connection settings here.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug((string) env('APP_NAME', 'laravel')).'-database-'),
            'persistent' => env('REDIS_PERSISTENT', false),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
            'max_retries' => env('REDIS_MAX_RETRIES', 3),
            'backoff_algorithm' => env('REDIS_BACKOFF_ALGORITHM', 'decorrelated_jitter'),
            'backoff_base' => env('REDIS_BACKOFF_BASE', 100),
            'backoff_cap' => env('REDIS_BACKOFF_CAP', 1000),
        ],

    ],

];
