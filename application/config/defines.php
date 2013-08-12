<?php

// public
define('PUBLIC_FOLDER', 'public');

// file folder
define('PUBLIC_FILE_FOLDER', PUBLIC_FOLDER . '/files');

// public theme folder
define('PUBLIC_THEME_FOLDER', PUBLIC_FOLDER . '/themes');

// flat admin theme
define('PUBLIC_THEME_FLAT_FOLDER', PUBLIC_THEME_FOLDER . '/flat');
define('PUBLIC_THEME_FLAT_CSS_FOLDER', PUBLIC_THEME_FLAT_FOLDER . '/css');
define('PUBLIC_THEME_FLAT_IMAGE_FOLDER', PUBLIC_THEME_FLAT_FOLDER . '/img');
define('PUBLIC_THEME_FLAT_JS_FOLDER', PUBLIC_THEME_FLAT_FOLDER . '/js');

// my theme
define('PUBLIC_THEME_MY_FOLDER', PUBLIC_THEME_FOLDER . '/my');
define('PUBLIC_THEME_MY_CSS_FOLDER', PUBLIC_THEME_MY_FOLDER . '/css');
define('PUBLIC_THEME_MY_IMAGE_FOLDER', PUBLIC_THEME_MY_FOLDER . '/images');
define('PUBLIC_THEME_MY_JS_FOLDER', PUBLIC_THEME_MY_FOLDER . '/js');

// 上傳的 folder
define('UPLOAD_FOLDER', 'uploads');

// 上傳的大頭照 folder
define('AVATAR_FOLDER', 'avatars');

// 上傳的照片 folder
define('IMAGE_FOLDER', 'images');

// 上傳的檔案 folder
define('FILE_FOLDER', 'files');

// 使用者大頭照 folder name
define('UPLOAD_AVATAR', UPLOAD_FOLDER . '/' . AVATAR_FOLDER);

// 使用者上傳的照片 folder name
define('UPLOAD_IMAGES', UPLOAD_FOLDER . '/' . IMAGE_FOLDER);

// 使用者上傳的檔案 folder name
define('UPLOAD_FILES', UPLOAD_FOLDER . '/' . FILE_FOLDER);

// 實體的 apppath 路徑 ex: /var/www/xxxx
define('REAL_APPPATH', realpath(APPPATH));


?>