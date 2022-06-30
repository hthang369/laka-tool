<?php
namespace Modules\LakaManager\Enums;

use Laka\Core\Enums\BaseEnum;

final class RepairStatus extends BaseEnum
{
    const NONE = 0;
    const DOWNLOAD = 1;
    const RESTORE = 2;

    protected $translate = [
        'NONE' => 'repair_data.status.none',
        'DOWNLOAD' => 'repair_data.status.download',
        'RESTORE' => 'repair_data.status.restore'
    ];
}
