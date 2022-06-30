<?php

namespace Modules\Common\Services\LogActivity;

use Modules\Common\Repositories\LogActivitys\LogActivityRepository;
use Illuminate\Http\Request;

class LogActivityService
{
    private $logActivityRepository;

    public function __construct(LogActivityRepository $logActivityRepository)
    {
        $this->logActivityRepository = $logActivityRepository;
    }

    public function addToLog(Request $request, $subject)
    {
        $data = array_filter($request->except(['_token', 'password']));

        $attributes = [
            'subject'   => $subject,
            'url'       => $request->fullUrl(),
            'method'    => $request->method(),
            'ip'        => $request->ip(),
            'agent'     => $request->header('user-agent'),
            'user_id'   => user_get('id') ?? 0,
            'user_name' => user_get('name') ?? '',
            'input'     => json_encode($data)
        ];
        $this->logActivityRepository->create($attributes);

        return;
    }
}
