<?php

namespace Modules\Home\Console;

use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CrawlData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'laka:crawl-data';

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
        // $min = $this->argument('min');
        // $max = $this->argument('max');
        $category = 'cua-nhom';

        $url = 'https://phuongtrangwindow.com/%s/';

        $client = new Client();

        $crawler = $client->request('GET', sprintf($url, $category));

        $results = $crawler->filter('.large-columns-1');
        $data = [];
        $results->filter('.post-item')->each(function($item) {
            dd($item->filter('.image-cover img')->attr('srcset'));
            $data[] = [
                'post_title' => $item->filter('.post-title')->text(),
                'post_excerpt' => $item->filter('.from_the_blog_excerpt')->text(),

            ];
        });
        die;

        // for ($i = $min; $i <= $max; $i++) {



            // $res = $crawler->filter('.chapter-content');

            // if ($res->count() == 0) continue;

            // $this->info('Crawlting data '. $i);

            // $content = $res->html();

            // Storage::disk('public')->append('data.txt', '<div class="chapter-content">'.$content.'</div>');
        // }

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
            // ['min', InputArgument::REQUIRED, 'An example argument.'],
            // ['max', InputArgument::REQUIRED, 'An example argument.'],
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
