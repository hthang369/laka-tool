<?php

namespace Modules\Home\Console;

use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CrawlDataTruyen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'laka:crawl-data-truyen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $min = $this->argument('min');
        $max = $this->argument('max');

        $url = 'https://truyen3.one/truyen-con-re-quyen-quy-truong-thac-lam-ngu-lam-full/chuong-%d.html/';

        $client = new Client();

        for ($i = $min; $i <= $max; $i++) {

            $crawler = $client->request('GET', sprintf($url, $i));

            $res = $crawler->filter('.chapter-content');

            if ($res->count() == 0) continue;

            $this->info('Crawlting data '. $i);

            $content = $res->html();

            // Storage::disk('public')->append('data.txt', '<div class="chapter-content">'.$content.'</div>');
        }

        $this->info('Crawl data successfull');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['min', InputArgument::REQUIRED, 'An example argument.'],
            ['max', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
