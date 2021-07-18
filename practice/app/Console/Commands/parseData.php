<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;

class parseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parseData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'parsing data from website';

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
      $opts = array(
        'http'=>array(
          'method'=>"GET",
          'header'=>"Accept-language: ru\r\n" .
                    "Cookie: foo=bar\r\n"
        )
      );

      $context = stream_context_create($opts);

      $urlcontent = file_get_contents('https://www.pizza-vl.ru/', false, $context);
while(true){
      $n1 = strpos($urlcontent,'<div class="vendor-menu__section">
     <section>
	   <h2 class="vendor-menu__category-title">');
      if ($n1 === false) break;

     $n2 = substr($urlcontent,$n1);
      $categoryInfo = strip_tags(substr($n2,0,strpos($n2,'</h2>')));

        $urlcontent = substr($n2,strpos($n2,'</h2>'));
        $tempurl = substr($urlcontent,0,strpos($n2,'</section>'));
        while (true){
            $item = new Item();
            $n1 = strpos($tempurl,'<div class="product-description base-view">');
            if ($n1 === false) break;
            $n2 = substr($tempurl,$n1);
            $item->description = strip_tags(substr($n2,0,strpos($n2,'</div>')));
            $tempurl = substr($n2,strpos($n2,'</div>'));

            $n1 = strpos($tempurl,'<div class="product-title">');
            $n2 = substr($tempurl,$n1);
            $item->name = strip_tags(substr($n2,0,strpos($n2,'</div>')));
            $tempurl = substr($n2,strpos($n2,'</div>'));

            $n1 = strpos($tempurl,'data-weight="');
            $n2 = substr($tempurl,$n1+strlen('data-weight="'));
            $item->weight = strip_tags(substr($n2,0,strpos($n2,'"')));
            $tempurl = substr($n2,strpos($n2,'"'));

            $n1 = strpos($tempurl,'<span class="current-price"><span>');
            $n2 = substr($tempurl,$n1);
            $item->price = strip_tags(substr($n2,0,strpos($n2,'</span><span class="currency">')));
            $tempurl = substr($n2,strpos($n2,'</span><span class="currency">'));

            $item->category = $categoryInfo;
            $item->save();
        }
          $urlcontent = substr($urlcontent,strpos($urlcontent,'</section>'));

}



        return 0;
    }
}
