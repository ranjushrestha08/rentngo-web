<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use App\Models\VehicleCategory;

class VehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define categories
        $categories = [
            ['name' => 'SUV'],
            ['name' => 'Sedan'],
            ['name' => 'Truck'],
            // Add more categories as needed
        ];

        // Insert categories into the database
        foreach ($categories as $category) {
            VehicleCategory::create($category);
        }


        $vehicles = [
            [
                'vehicle_name' => 'Toyota RAV4',
                'fuel_type' => 'Petrol',
                'model' => '2022',
                'cost_per_hour' => '25',
                'image_url' => 'toyota_rav4.jpg',
                'vehicle_description' => 'Spacious and reliable SUV.',
                'vehicle_category_id' => VehicleCategory::where('name', 'SUV')->first()->id,
            ],
            [
                'vehicle_name' => 'Honda Civic',
                'fuel_type' => 'Petrol',
                'model' => '2023',
                'cost_per_hour' => '20',
                'image_url' => 'honda_civic.jpg',
                'vehicle_description' => 'Stylish and fuel-efficient sedan.',
                'vehicle_category_id' => VehicleCategory::where('name', 'Sedan')->first()->id,
            ],
            // Add more vehicles as needed
        ];

        // Insert vehicles into the database
        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
