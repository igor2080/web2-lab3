<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Carmodel;
use App\Models\Country;
use App\Models\Manufacturer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Country::create(['name' => 'Germany', 'code' => 'DE']);
        Country::create(['name' => 'Italy', 'code' => 'IT']);
        Country::create(['name' => 'France', 'code' => 'FR']);
        Country::create(['name' => 'Spain', 'code' => 'ES']);
        Country::create(['name' => 'Japan', 'code' => 'JP']);

        $france = Country::where('name', 'France')->first();
        $spain = Country::where('name', 'Spain')->first();
        $japan = Country::where('name', 'Japan')->first();
        $germany = Country::where('name', 'Germany')->first();
        $seat = new Manufacturer();
        $seat->name = 'Seat';
        $seat->founded = 1901;
        $seat->website = "www.seat.com";
        $toyota = new Manufacturer();
        $toyota->name = 'Toyota';
        $toyota->founded = 1903;
        $toyota->website = "www.toyota.com";
        $volkswagen = new Manufacturer();
        $volkswagen->name = 'Volkswagen';
        $volkswagen->founded = 1905;
        $volkswagen->website = "www.volkswagen.com";
        $renault = new Manufacturer();
        $renault->name = 'Renault';
        $renault->founded = 1909;
        $renault->website = "www.renault.com";
        $audi = new Manufacturer();
        $audi->name = 'Audi';
        $audi->founded = 1902;
        $audi->website = 'www.audi.com';
        $france->manufacturers()->save($renault);
        $spain->manufacturers()->save($seat);
        $japan->manufacturers()->save($toyota);
        $germany->manufacturers()->save($volkswagen);
        $audi->country()->associate($germany);
        $audi->save();

        $france->manufacturers()->create(['name' => 'Peugeot', 'founded' => '1907', 'website' => 'www.peugeot.com']);
        $volkswagen->carmodels()->create(['min_price' => '10000.00', 'production_started' => '1910', 'name' => 'Passat', 'manufacturer_id' => $volkswagen->id]);
        $volkswagen->carmodels()->create(['min_price' => '11000.00', 'production_started' => '1911', 'name' => 'Golf', 'manufacturer_id' => $volkswagen->id]);
        $volkswagen->carmodels()->create(['min_price' => '12000.00', 'production_started' => '1912', 'name' => 'Multivan', 'manufacturer_id' => $volkswagen->id]);
        $audi->carmodels()->create(['min_price' => '13000.00', 'production_started' => '1913', 'name' => 'A4', 'manufacturer_id' => $audi->id]);
        $audi->carmodels()->create(['min_price' => '14000.00', 'production_started' => '1914', 'name' => 'A6', 'manufacturer_id' => $audi->id]);
        $audi->carmodels()->create(['min_price' => '15000.00', 'production_started' => '1915', 'name' => 'Q3', 'manufacturer_id' => $audi->id]);
        $audi->carmodels()->create(['min_price' => '16000.00', 'production_started' => '1916', 'name' => 'Q4', 'manufacturer_id' => $audi->id]);
        $audi->carmodels()->create(['min_price' => '17000.00', 'production_started' => '1917', 'name' => 'Q5', 'manufacturer_id' => $audi->id]);
        $seat->carmodels()->create(['min_price' => '18000.00', 'production_started' => '1918', 'name' => 'Toledo', 'manufacturer_id' => $seat->id]);
        $seat->carmodels()->create(['min_price' => '19000.00', 'production_started' => '1919', 'name' => 'Ibiza', 'manufacturer_id' => $seat->id]);
    }
}
