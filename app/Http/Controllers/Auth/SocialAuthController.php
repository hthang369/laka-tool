<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laka\Core\Plugins\SocialAuth\Traits\HasSocialAuthentication;

class SocialAuthController extends Controller
{
    use HasSocialAuthentication;

    protected $redirectTo = '/version';
}
