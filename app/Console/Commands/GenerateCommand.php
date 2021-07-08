<?php

namespace App\Console\Commands;

use App\Core\Support\Stub;

class GenerateCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:generate {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate files...';

    /**
     * The name of 'name' argument.
     *
     * @var string
     */
    protected $argumentName = 'name';

    protected $config = [
        'controller' => [
            'path' => 'app/Http/Controllers/%s',
            'suffix' => 'Controller'
        ],
        'model' => [
            'path' => 'app/Models/%s',
            'suffix' => ''
        ],
        'repository' => [
            'path' => 'app/Repositories/%s',
            'suffix' => 'Repository'
        ],
        'validator' => [
            'path' => 'app/Validators/%s',
            'suffix' => 'Validator'
        ],
        'permission' => [
            'path'  => 'database/seeders',
            'suffix' => 'Permission'
        ]
    ];

    protected function getTemplateContents()
    {
    }

    protected function getDestinationFilePath()
    {
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->getArgumentName();

        $this->info($this->description);

        foreach ($this->config as $key => $value) {
            $fileName = $name . ucfirst($value['suffix']) . '.php';
            $path = base_path(sprintf($value['path'], "{$name}s"));
            $filePath = $path . DIRECTORY_SEPARATOR . $fileName;

            $this->info('Creating file: ' . $fileName . '');

            $this->makeIsDirectory($filePath);

            if (file_exists($filePath)) {
                continue;
            }

            Stub::setBasePath($this->getStubPath());

            $templateStub = new Stub($this->getFileStub($key), [
                'NAME' => $name,
                'LOWER_NAME' => strtolower($name),
                'TABLENAME' => strtolower($name),
            ]);

            $this->fileGenerate($path, $fileName, $templateStub);
        }
    }
}
