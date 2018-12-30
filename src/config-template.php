<?php
return [
    "appName" => "{app-name}",
    "baseDir" => dirname(__FILE__) . DIRECTORY_SEPARATOR. '../',
    "baseUrl" => "{base-url}",
    "background" => "",
    "installed" => "{installed}",
    'files' => [
        "maxUploadSize" => "{max-file-size}", // in mb
        "allowed" =>  [
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png",
            "pdf" => "application/pdf"
        ]
    ],
    "users" => [
        "{primary-user}" => [
            "password" => "{primary-user-password}",
        ],
        // add other users here
    ]
];