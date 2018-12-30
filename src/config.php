<?php
return [
    "appName" => "Simple File Server",
    "baseDir" => dirname( dirname(__FILE__) ),
    "baseUrl" => "http://myserver.dev",
    "background" => "",
    "installed" => "false",
    'files' => [
        "maxUploadSize" => "10", // in mb
        "allowed" =>  [
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png",
            "pdf" => "application/pdf"
        ]
    ],
    "users" => [
        "Admin" => [
            "password" => "password1234",
        ],
        // add other users here
    ]
];