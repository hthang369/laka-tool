<?php

namespace App\Presenters\LakaLogs;

use App\Presenters\CoreGridPresenter;

class LakaLogGridPresenter extends CoreGridPresenter
{
    protected $exceptQuery = ['date_log'];

    protected function setColumns()
    {
        return [
            'log_level',
            'ip',
            'date_log',
            'url'
        ];
    }
}
