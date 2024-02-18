<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Subscription::create(
            [
                'title' => 'Basic',
                'package_amount' => 0,
                'interval' => 'Unlimited',
                'user_limit' => 5,
                'document_limit' => 5,
                'enabled_document_history' => 1 ,
                'enabled_logged_history' => 1 ,
            ]
        );
    }
}
