<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'coach' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/coach'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'facility' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/facility'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'files' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/files'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'food' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/food'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'logo' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/logo'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'participant' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/participant'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'plan' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/plan'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'profile' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/profile'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        'program' => [
            'driver' => 'local',
            'root' => public_path('/../../public_html/DoshtuDashboard/images/program'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
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
