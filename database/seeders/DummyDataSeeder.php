<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\Tenant;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $categories_data = [
            [
                'slug' => 'fnb',
                'name' => 'Foods & Beverages'
            ],
            [
                'slug' => 'beauty',
                'name' => 'Beauty'
            ],
            [
                'slug' => 'electronic',
                'name' => 'Electronic'
            ],
            [
                'slug' => 'fashion',
                'name' => 'Fashion'
            ],
            [
                'slug' => 'travel-hole',
                'name' => 'Travel & Hotel'
            ],
            [
                'slug' => 'home-furniture',
                'name' => 'Home & Furniture'
            ],
            [
                'slug' => 'entertaiment',
                'name' => 'Entertaiment'
            ],
            [
                'slug' => 'events',
                'name' => 'Events'
            ],
            [
                'slug' => 'kids-toys',
                'name' => 'Kids & Toys'
            ],
            [
                'slug' => 'sport-outdoor',
                'name' => 'Sport & Outdoor'
            ],
        ];

        $categories = [];
        foreach ($categories_data as $category_data) {
            $categories[$category_data['slug']] = Category::updateOrCreate($category_data);
        }
        $categories = collect($categories);

        $payment_methods_data = [
            [
                'slug' => 'bca',
                'name' => 'Bank BCA'
            ],
            [
                'slug' => 'bca-cc',
                'name' => 'BCA Credit Card'
            ],
            [
                'slug' => 'ocbc',
                'name' => 'Bank OCBC'
            ],
            [
                'slug' => 'seabank',
                'name' => 'SeaBank'
            ],
            [
                'slug' => 'bank-jago',
                'name' => 'Bank Jago'
            ],
            [
                'slug' => 'bri',
                'name' => 'Bank BRI'
            ],
            [
                'slug' => 'bri-cc',
                'name' => 'BRI Credit Card'
            ],
            [
                'slug' => 'sinarmas',
                'name' => 'Bank Sinarmas'
            ],
        ];

        $payment_methods = [];
        foreach ($payment_methods_data as $payment_method) {
            $payment_methods[$payment_method['slug']] = PaymentMethod::updateOrCreate($payment_method);
        }
        $payment_methods = collect($payment_methods);


        $tenants_data = [
            [
                'name' => 'Tamper Coffee BSD',
                'lat' => -6.3020833,
                'lng' => 106.6511522,
                'categories' => ['fnb'],
                'promos' => [
                    [
                        'name' => 'Promo Member Bank Sinarmas',
                        // 'description' => '',
                        // 'start_at',
                        // 'end_at',
                        // 'original_price',
                        'type' => 'discount',
                        // 'min_amount',
                        // 'max_amount',
                        'percentage' => 10,
                        // 'min_purchase_amount',
                        // 'quota',
                        'tnc' => $faker->text,
                        'files' => [
                            [
                                'type' => 'banner',
                                'file_url' => 'https://www.banksinarmas.com/id/public/upload/thumb/62ff758c46c83_thumb-kk-hut-Week-4.jpg'
                            ]
                        ],
                        'payment_methods' => ['sinarmas']
                    ]
                ], 
                'files' => [
                    [
                        'type' => 'banner',
                        'file_url' => 'https://lh5.googleusercontent.com/p/AF1QipNxjiT7Xm06IvGYHJhYGD54jP25GN3-hGrTkdRb=w203-h270-k-no'
                    ]
                ]
            ],
        ];

        foreach ($tenants_data as $tenant_data) {
            $newTenant = Tenant::updateOrCreate([
                'name' => $tenant_data['name']
            ], collect($tenant_data)->only(['name', 'lat', 'lng'])->toArray());

            // Tenant File
            foreach ($tenant_data['files'] as $tenant_file_data) {
                $newTenant->files()->create([
                    'type' => $tenant_file_data['type'],
                    'path' => $tenant_file_data['file_url'],
                ]);
            }

            // Tenant Category
            foreach ($tenant_data['categories'] as $category_slug) {
                $newTenant->categories()->attach($categories[$category_slug]);
            }

            foreach ($tenant_data['promos'] as $promo_data) {
                $newPromo = $newTenant->promos()->create(collect($promo_data)->only(['name', 
                'tenant_id',
                'description',
                'start_at',
                'end_at',
                'original_price',
                'type',
                'min_amount',
                'max_amount',
                'percentage',
                'min_purchase_amount',
                'quota',
                'tnc'])->toArray());

                // Tenant File
                foreach ($promo_data['files'] as $promo_file_data) {
                    $newPromo->files()->create([
                        'type' => $promo_file_data['type'],
                        'path' => $promo_file_data['file_url'],
                    ]);
                }
            }
        }


    }
}
