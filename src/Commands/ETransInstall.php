<?php namespace Elicit\ETrans\Commands;

use Elicit\ETrans\Controllers\LanguagesController;
use File;
use Illuminate\Console\Command;

class ETransInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'etrans:install';
    protected $name = 'etrans:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a JS Constants module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function fire() {
        $this->handle();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $languages = config('etrans.languages');

        if(is_null($languages)) {
            $this->info('--> Custom ETrans config not found, use vendor:publish to edit default config. <--');
            $languages = 'sv';
        }

        if(!is_array($languages)) {
            $languages = [$languages];
        }

        foreach($languages as $language) {
            $this->info('Installing language: ' . strtoupper($language));

            $lc = new LanguagesController();
            $lc->install($language);

            $this->info('Language ' . strtoupper($language) . ' successfully installed.');
        }
    }

}
