<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EnviromentDeployRule implements Rule
{
    protected $data;
    protected $envVersion;
    protected $envConfig = [
        'development' => 'dev',
        'staging' => 'stg'
    ];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data = request()->except('_token');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (starts_with($value, ['v', 'V'])) {
            $environment = $this->data['environment'];
            $this->envVersion = data_get($this->envConfig, $environment, '');
            if (!empty($this->envVersion)) {
                if (preg_replace('/-' . $this->envVersion . '$/', '$0', $value) != "-{$this->envVersion}") {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("deploy.alert_input_environment_{$this->envVersion}");
    }
}
