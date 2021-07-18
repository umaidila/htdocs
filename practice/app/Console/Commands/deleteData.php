<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
class deleteData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deleteData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deletes all data';

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
     * @return int
     */
    public function handle()
    {
      foreach (Item::all() as $items){
        $items->delete();
      }
        return 0;
    }
}
