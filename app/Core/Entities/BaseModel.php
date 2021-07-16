<?php

namespace App\Core\Entities;

use App\Core\Observers\BaseModelObserver;
use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\FullTextSearch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class BaseModel extends Model
{
    use FullTextSearch;

    const CREATED_USER = 'created_user_id';
    const UPDATED_USER = 'updated_user_id';

    /**
     * @var array
     *
     * get column foreign table:
     * column name alias:foreignTable, foreignKeyPrimaryTable, columnNameForeignTable
     */
    protected $fillableColumns = ['*'];
    protected $auth_user = null;

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $this->registerObserver(BaseModelObserver::class);
        $this->auth_user = 0;
    }

    public function setCreatedUpdatedUsers()
    {
        if ($this->exists) {
            $this->setAttributeValue(static::UPDATED_USER, $this->auth_user);
        } else {
            $this->setAttributeValue(static::CREATED_USER, $this->auth_user);
            $this->setAttributeValue(static::UPDATED_USER, $this->auth_user);
        }
    }

    public static function getCreatedUser()
    {
        return static::CREATED_USER;
    }

    public static function getUpdatedUser()
    {
        return static::UPDATED_USER;
    }

    public function getFillableColumns()
    {
        return $this->fillableColumns;
    }

    public function setAttributeValue($key, $value)
    {
        if (Schema::hasColumn($this->getTable(), $key)) {
            return parent::setAttribute($key, $value);
        }
    }
}
