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
      /*
      $position1 =0;
      $position2 = 0;
      while(true){

      $n1 = strpos($urlcontent,'<div class="vendor-menu__section">
     <section>
	   <h2 class="vendor-menu__category-title">',$position2);
      if ($n1 === false) break;
      $position2 = $position2 + $n1 + strlen('<div class="vendor-menu__section">
     <section>
	   <h2 class="vendor-menu__category-title">');

      $n2 = substr($urlcontent,$n1);
      $categoryInfo = strip_tags(substr($n2,0,strpos($n2,'</h2>')));
      $position2 = $position2 + strpos($n2,'</h2>') + strlen('</h2>');
      while (true){
        $n1 = strpos($urlcontent,'<div class="product-description base-view">',$position2);
        if ($n1 === false) break;
        $position2 = $position2 + $n1 + strlen('<div class="product-description base-view">');

        $n2 = substr($urlcontent,$n1);
        $descriptionInfo = strip_tags(substr($n2,0,strpos($n2,'</div>')));
        $position2 = $position2 + strpos($n2,'</h2>') + strlen('</div>');

        $item = new Item();
        $item->name = $descriptionInfo;
        $item->price = '10';
        $item->description = 'description';
        $item->weight = '12';
        $item->category = $categoryInfo;
        $item->save();
      }
        $position2 = $position2 + strpos($n2,'</section>
   </div>') + strlen('</section>
   </div>');
 } */
       preg_match_all('#<div[^>]+?class\s*?=\s*?"vendor-menu__category-title"[^>]*?>(.+?)</div>#su',$urlcontent,$matches);
      $item = new Item();
      $item->name = $matches[1];

        return 0;
    }
}
