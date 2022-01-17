<?php

namespace App\Presenters\LakaLogs;

use App\Presenters\CoreGridPresenter;

class LakaLogGridPresenter extends CoreGridPresenter
{
    protected $exceptQuery = ['date_log'];

    protected function setColumns()
    {
        return [
            [
                'key' => 'log_level',
                'filtering' => true,
            ], [
                'key' => 'ip',
                'filtering' => true,
            ], [
                'key' => 'date_log',
            ],
            [
                'key' => 'url',
                'filtering' => true,
            ],
        ];
    }
}
