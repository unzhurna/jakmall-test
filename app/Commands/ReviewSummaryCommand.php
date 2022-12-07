<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\DB;

class ReviewSummaryCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'review:summary';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Summary list of review';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Showing total review:');

        $review = DB::table('reviews')
        ->select([
            DB::raw('count(id) as total_reviews'),
            DB::raw('round(avg(rating), 1) as average_ratings'),
            DB::raw("(select count(id) from `reviews` where `rating`=5) as `5_star`"),
            DB::raw("(select count(id) from `reviews` where `rating`=4) as `4_star`"),
            DB::raw("(select count(id) from `reviews` where `rating`=3) as `3_star`"),
            DB::raw("(select count(id) from `reviews` where `rating`=2) as `2_star`"),
            DB::raw("(select count(id) from `reviews` where `rating`=1) as `1_star`")
        ])
        ->first();

        print(json_encode($review, JSON_PRETTY_PRINT).PHP_EOL);
    }
}
