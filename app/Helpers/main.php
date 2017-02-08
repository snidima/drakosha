<?php

    function css()
    {
        $env = App::environment();

        if ( $env == 'production' ){
            $path = resource_path().'/assets/manifests/css/rev-manifest.json';
            $file = json_decode(File::get($path), true);
            return $file['app.css'];
        } else {
            return 'app.css';
        }

    }

    function js()
    {
        $env = App::environment();

        if ( $env == 'production' ){
            $path = resource_path().'/assets/manifests/js/rev-manifest.json';
            $file = json_decode(File::get($path), true);
            return $file['app.js'];
        } else {
            return 'app.js';
        }

    }



?>