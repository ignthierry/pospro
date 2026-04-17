<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = ['Food', 'Drink', 'Snack'];
        foreach ($categories as $cat) {
            \App\Models\Category::create(['name' => $cat]);
        }

        $food = \App\Models\Category::where('name', 'Food')->first();
        $drink = \App\Models\Category::where('name', 'Drink')->first();
        $snack = \App\Models\Category::where('name', 'Snack')->first();

        \App\Models\Product::create([
            'category_id' => $drink->id,
            'name' => 'Signature Latte',
            'price' => 35000,
            'stock' => 100,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB6q8ytQSwaoB_fMKzEKO2UzWSHMwFQTuMzyAe7-MhBOq8P17Oa9u6SjIobBNEnDuSVqETemiewClA_RLcTemMXYDkd6EQD8NGrBSrI-Snh9D0JhOivddGQ1WhCT9VzRUYIeK-9ItjHNKjmM9dzwJLBYOuCSlD3xXjidEo4RrTwKNMPT8-7ifYCIbA4DPhrlo8zrghvVlVASxqCaOdqZtMJtaqDXpzxN-qBnk-ETkAWwVUc_gdsHgITTOZ313CN6fJkzc0MjX-ow30'
        ]);

        \App\Models\Product::create([
            'category_id' => $drink->id,
            'name' => 'Double Espresso',
            'price' => 28000,
            'stock' => 100,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDVAT9iLcvGy2VDp3eJ_38gNLtjR_BamWi6Moqmn_MRsuk0_ULvNvRy60YGpKiBuZRnQApY429QymuMLQ_yK2wtGJEbKQ6VEANzcox5wuoTPSpK5sghLpxs0y954V5JhFvIV37ty53SK98hoVYuI-K95Rj5scL-IYR7NXfPV8a9c4kEpIT-5EWfKmbuQ03Sr-T4SLc-myQhhmUJcvobxvHIyhrSfXMdGWf-U2KwxeEsze6-T9htV5c05RWWCO1PBqBLtP0nrgKca9k'
        ]);

        \App\Models\Product::create([
            'category_id' => $food->id,
            'name' => 'Artisan Croissant',
            'price' => 32000,
            'stock' => 50,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCMQTtRjY4SvPY76hToNwc8awxOKvEBgwtfIasvOkICjbSPfVu6XiWu_ALLZzoMseIT30j6Zz_6qdurvzuXd7PwCPcI9BhGod7ZLuE5vvxuYx_WFmLdAXl6h6La6LXZH2LBt35Y3SFTsSa8aNjlPqC5UfmSsZF4vSA5lbwYMYRIvlyWtSspPkuXp46mCyUrwarQVbppcuJUcFy8LcFRdXnAUG35qwUjWE12OaRmk52Piq1Y6dQpgb2GzKVrIapU0bhwY_5zclp0k94'
        ]);

        \App\Models\Product::create([
            'category_id' => $snack->id,
            'name' => 'Double Choco Muffin',
            'price' => 25000,
            'stock' => 30,
            'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAqsRcYuxqzIdPV2uPVHXCEhJGkB_wuo5r1aFMAvojOKNrj5OwQu6Iss2A2Jm2kTh94wcIdv7Eg0qbGTnOf0sjTyNB420e51rweYl1YzXPQ6upcinJSfbgybilcHoEpwMCzTHreh_MccTlqkKaNPMlLR-_sug-pEjT_-VZin0Pe6wCNWYAKDTXNcW0VhXwoaCm6XZDAbWtnhB0dKL85xEBbDC6s0tg5XzHdOe2VZ3nZ5Wyuq5lodjTpmcMGFyAQ3TuKLoU1a3RpuFk'
        ]);

        \App\Models\Customer::create([
            'name' => 'Pelanggan Umum',
            'phone' => '0'
        ]);
        
        \App\Models\Customer::create([
            'name' => 'Budi Santoso',
            'phone' => '628123456789'
        ]);
    }
}
