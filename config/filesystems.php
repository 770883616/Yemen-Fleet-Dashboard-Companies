<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => public_path(),  // سيتم حفظ الصور في مجلد public مباشرة
            'url' => env('APP_URL') . '/uploads',  // هذا سيكون رابط الصور
            'visibility' => 'public',
            'throw' => false,
        ],
        'categories' => [
            'driver' => 'local',
            'root' => public_path(),  // حفظ الملفات في public/uploads/categories
            'url' => env('APP_URL') . '/uploads/categories',  // رابط الوصول سيكون http://your-domain.com/uploads/categories
            'visibility' => 'public',
            'throw' => false,
        ],
        'products' => [
            'driver' => 'local',
            'root' => public_path(),  // حفظ الملفات في public/uploads/products
            'url' => env('APP_URL') . '/uploads/products',  // رابط الوصول سيكون http://your-domain.com/uploads/products
            'visibility' => 'public',
            'throw' => false,
        ],
        'productimages' => [
            'driver' => 'local',
            'root' => public_path(),  // سيتم حفظ الصور في مجلد public مباشرة
            'url' => env('APP_URL') . '/uploads/products/productimages',  // هذا سيكون رابط الصور
            'visibility' => 'public',
            'throw' => false,
        ],
        'productvariations' => [
            'driver' => 'local',
            'root' => public_path(),  // سيتم حفظ الصور في مجلد public مباشرة
            'url' => env('APP_URL') . '/uploads/products/productvariations',  // هذا سيكون رابط الصور
            'visibility' => 'public',
            'throw' => false,
        ],


        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
