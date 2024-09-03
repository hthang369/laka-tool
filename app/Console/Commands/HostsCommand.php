<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DemoNotifycation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laka-tool:list-host';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all list hosts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $read = file('/etc/hosts');
        $data = array_filter($read, fn($line) => !starts_with($line, ['#', PHP_EOL]));
        $display = array_map(function($line) {
            list($ip, $domain) = preg_split("/[\s\t\n,]+/", $line);
            return [
                'ip' => $ip,
                'domain' => $domain
            ];
        }, $data);
        $this->output->table(['ip', 'domain'], $display);
    }
}
