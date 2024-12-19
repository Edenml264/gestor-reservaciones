<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    |
    | This value sets the root namespace for Livewire component classes in
    | your application. This value affects component auto-discovery and
    | any Livewire file helper commands, like `artisan make:livewire`.
    |
    | After changing this item, run: `php artisan livewire:discover`.
    |
    */

    'class_namespace' => 'App\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This value sets the path for Livewire component views. This affects
    | file manipulation helper commands like `artisan make:livewire`.
    |
    */

    'view_path' => resource_path('views/livewire'),

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    | The default layout view that will be used when rendering a component via
    | Route::get('/some-endpoint', SomeComponent::class);
    |
    */

    'layout' => 'layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing uploads in a temporary directory
    | before the file is validated and stored permanently. All file uploads
    | are directed to a global endpoint for temporary storage.
    |
    */

    'temporary_file_upload' => [
        'disk' => null,        // Example: 'local', 's3'...
        'rules' => null,       // Example: ['file', 'mimes:png,jpg']
        'directory' => null,   // Example: 'tmp'
        'middleware' => null,  // Example: 'throttle:5,1'
        'preview_mimes' => [   // Supported file types for temporary pre-signed file URLs.
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5, // Max duration (in minutes) before an upload gets invalidated.
    ],

    /*
    |--------------------------------------------------------------------------
    | Manifest File Path
    |--------------------------------------------------------------------------
    |
    | This value sets the path to the Livewire manifest file.
    | The default should work for most cases (which is
    | "<app_root>/bootstrap/cache/livewire-components.php"), but for specific
    | cases like when hosting on Laravel Vapor, it could be set to a different value.
    |
    | Example: for Laravel Vapor, it would be "/tmp/storage/bootstrap/cache/livewire-components.php".
    |
    */

    'manifest_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Back Button Cache
    |--------------------------------------------------------------------------
    |
    | This value determines whether the back button cache will be used on pages
    | that contain Livewire. By disabling back button cache, it ensures that
    | the back button shows the correct state of components, instead of
    | potentially stale, cached data.
    |
    | Setting it to "false" (default) will disable back button cache.
    |
    */

    'back_button_cache' => false,
];
