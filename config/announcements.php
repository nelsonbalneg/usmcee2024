<?php

return [
    // Both applications must have read access to this shared media directory.
    'media_root' => env('ANNOUNCEMENT_MEDIA_ROOT', dirname(base_path()).'/cee-admin/storage/app/private/announcements'),
];
