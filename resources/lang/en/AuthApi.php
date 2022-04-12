<?php

return [
    'mustBe' => [
        'required' => "This field is required",
        'email' => "Please provide valid email address",
        'passwordLenMin' => "Password must be more than 8 symbols",
        'passwordLenMax' => "Password is too long",
        'imageMax' => "Image size must be maximum 2mb",
        'imageMime' => "Image must be png,jpg or jpeg",
        'videoMax' => "Video size must be maximum 7mb",
        'videoMime' => "Video must be mp4,mov,ogg or qt",
        'passwordConfirmed' => "Passwords must be equal",
    ],
    'msg' => [
        'incorrectCredentials' => 'The provided credentials are incorrect.',
        'loggedOut' => 'Logged out',
        'registerSuccess' => 'User registered successfully.',
        'removed' => 'Deleted successfully.',
        'updated' => 'Updated successfully.',
    ]
];
