<?php

namespace Modules\Common\Entities\Menus;

use Laka\Core\Entities\BaseModel;
use Laka\Core\Plugins\Nestedset\NodeTrait;

class Menus extends BaseModel
{
    use NodeTrait;

    protected $table = 'menus';

    protected $fillable = [
        'parent_id',
        'left',
        'right',
        'depth',
        'section_code',
        'group',
        'route_name',
        'link',
        'lang',
        'description'
    ];

    /**
     * Get the lft key name.
     *
     * @return  string
     */
    public function getLftName()
    {
        return 'left';
    }

    /**
     * Get the rgt key name.
     *
     * @return  string
     */
    public function getRgtName()
    {
        return 'right';
    }

    public static function findGroup($code, $columns = ['*'])
    {
        return Menus::where('group', $code)->select($columns)->first();
    }
}
