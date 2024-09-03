<?php

namespace Modules\Api\Entities\Windmill;

class TemplateSchedule extends WindmillModel
{
    protected $table = 'template_schedule';

    protected $fillable = [
        'template_id',
        'type',
        'cron',
        'cron_display',
        'status'
    ];
}
