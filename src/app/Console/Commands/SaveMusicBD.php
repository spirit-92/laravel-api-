<?php

namespace App\Console\Commands;

use App\Model\AllMusicModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SaveMusicBD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:saveMusic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save music in data base';

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
        $urlMusic = Storage::allFiles('public/uploads/musicAll');
        $fixUrls = str_replace('public', '/storage', $urlMusic);
        $title = str_replace('public/uploads/musicAll/', '', $urlMusic);
        foreach ($fixUrls as $key=>$value) {
            (new AllMusicModel([
                'url' => $value,
                'title'=>$title[$key]
            ]))->save();
        }
    }
}
