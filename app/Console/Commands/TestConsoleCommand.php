<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class TestConsoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-console-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::query()->where('status', 0)->update(
            ['status' => 1]
        );

    }
}
