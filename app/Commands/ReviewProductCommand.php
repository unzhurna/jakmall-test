<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\DB;

class ReviewProductCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:product {productId : Id for product}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List review of product';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $productId =  $this->argument('productId');

        $product = DB::table('products')
        ->select('name')
        ->where('id', $productId)
        ->value('name');

        $this->info('Showing review for, '.$product.':');

        $review = DB::table('reviews')
        ->select([
            DB::raw('count(id) as total_reviews'),
            DB::raw('round(avg(rating), 1) as average_ratings'),
            DB::raw("(select count(id) from `reviews` where `product_id`=$productId and `rating`=5) as `5_star`"),
            DB::raw("(select count(id) from `reviews` where `product_id`=$productId and `rating`=4) as `4_star`"),
            DB::raw("(select count(id) from `reviews` where `product_id`=$productId and `rating`=3) as `3_star`"),
            DB::raw("(select count(id) from `reviews` where `product_id`=$productId and `rating`=2) as `2_star`"),
            DB::raw("(select count(id) from `reviews` where `product_id`=$productId and `rating`=1) as `1_star`")
        ])
        ->where('product_id', $productId)
        ->first();

        print(json_encode($review, JSON_PRETTY_PRINT).PHP_EOL);
    }
}
