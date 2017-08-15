<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceCategoryTableSeeder::class);
    }
}

class ServiceCategoryTableSeeder extends Seeder {

    public function run()
    {

        DB::table('service_category')->insert([
        	['category' => 'teaching', 'subcategory' => 'science'],
        	['category' => 'teaching', 'subcategory' => 'language'],
        	['category' => 'teaching', 'subcategory' => 'other'],
        	/**/
        	['category' => 'repair', 'subcategory' => 'cycle'],
        	['category' => 'repair', 'subcategory' => 'automobile'],
        	['category' => 'repair', 'subcategory' => 'electronics'],
        	['category' => 'repair', 'subcategory' => 'other'],
        	/**/
        	['category' => 'social', 'subcategory' => 'elderly care'],
        	['category' => 'social', 'subcategory' => 'child care'],
        	['category' => 'social', 'subcategory' => 'fundraising'],
        	['category' => 'social', 'subcategory' => 'other'],
        	/**/
        	['category' => 'animal', 'subcategory' => 'pet care'],
        	['category' => 'animal', 'subcategory' => 'pet adoption'],
        	['category' => 'animal', 'subcategory' => 'other']
        	]);
    }

}
