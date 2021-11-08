<?php

namespace App\Listeners;

use App\Events\sendConfirmEmail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\at;

class listenSendConfirmEmail
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param sendConfirmEmail $event
     *
     * @return void
     */
    public function handle(sendConfirmEmail $event)
    {
        $userDisabled = data_get($event, 'userDisabled');
        $contentConfirm = data_get($event, 'confirmContent');

        Cache::forget('codeDisableUser');
        $codeDisableUser = Cache::remember('codeDisableUser', config('laka.time_expired_code'), function () {
            return rand(1000, 9999);
        });

        data_set($data, 'user', $userDisabled);
        data_set($data, 'codeDisableUser', $codeDisableUser);
        data_set($data, 'contentConfirm', $contentConfirm);

        Mail::send('emails.reminder', $data, function ($m) {
            $m->to(auth()->user()->email,auth()->user()->name)
                ->subject('Verify to disable user!');
        });
    }
}
