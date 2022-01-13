<?php

namespace App\Http\Controllers\LogActivitys;

use Laka\Core\Http\Controllers\BaseController;
use App\Repositories\LogActivitys\LogActivityRepository;
use App\Validators\LogActivitys\LogActivityValidator;

/**
 * Class LogActivityController
 * @package App\Http\Controllers\LogActivitys
 * @property LogActivityRepository logactivityRepository
 */
class LogActivityController extends BaseController
{
    public function __construct(LogActivityRepository $repository, LogActivityValidator $validator) {
        parent::__construct($repository, $validator);
    }


}
