<?php

namespace Modules\SystemManager\Forms\Users;

use Laka\Core\Forms\Field;
use Modules\Common\Forms\BaseForm;

class UserUpdatePasswordForm extends BaseForm
{
    public function buildForm()
    {
        $this
            ->addRequired('current_password', Field::TEXT)
            ->addRequired('new_password', Field::TEXT)
            ->addRequired('confirm_password', Field::TEXT);

    }
}
