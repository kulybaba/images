<?php
return [
    'adminEmail' => 'admin@example.com',
    
    'maxFileSize' => 1024 * 1024 * 2, // 2 megabites
    'storagePath' => '@frontend/web/uploads/',
    'storageUri' => '/uploads/',
    'profilePicture' => [
        'maxWidth' => 1280,
        'maxHeight' => 1024,
    ],
    'maxCommentLenght' => 200,
    'postPicture' => [
        'maxWidth' => 1024,
        'maxHeight' => 768,
    ],
    'feedPostLimit' => 10,
];
