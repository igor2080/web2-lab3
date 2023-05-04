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
        Country::create(['name' => 'Germany', 'code'=>'DE']);
        Country::create(['name' => 'Italy', 'code'=>'IT']);
        Country::create(['name' => 'France', 'code'=>'FR']);
        Country::create(['name' => 'Spain', 'code'=>'ES']);
        Country::create(['name' => 'Japan', 'code'=>'JP']);
         
        $france = Country::where('name', 'France')->first();
        $spain = Country::where('name','Spain')->first();
        $japan = Country::where('name','Japan')->first();
        $germany = Country::where('name', 'Germany')->first();
        $seat = new Manufacturer();
        $seat->name = 'Seat';
        $toyota = new Manufacturer();
        $toyota->name = 'Toyota';
        $volkswagen = new Manufacturer();
        $volkswagen->name = 'Volkswagen';
        $renault = new Manufacturer();
        $renault->name = 'Renault';
        $audi = new Manufacturer();
        $audi->name = 'Audi';
        $france->manufacturers()->save($renault);
        $spain->manufacturers()->save($seat);
        $japan->manufacturers()->save($toyota);
        $germany->manufacturers()->save($volkswagen);
        $audi->country()->associate($germany);
        $audi->save();
        
        $france->manufacturers()->create(['name' => 'Peugeot']);
        $volkswagen->carmodels()->create(['name'=>'Passat', 'manufacturer_id' => $volkswagen->id]);
        $volkswagen->carmodels()->create(['name'=>'Golf', 'manufacturer_id' => $volkswagen->id]);
        $volkswagen->carmodels()->create(['name'=>'Multivan', 'manufacturer_id' => $volkswagen->id]);
        $audi->carmodels()->create(['name'=>'A4', 'manufacturer_id' => $audi->id]);
        $audi->carmodels()->create(['name'=>'A6', 'manufacturer_id' => $audi->id]);
        $audi->carmodels()->create(['name'=>'Q3', 'manufacturer_id' => $audi->id]);
        $audi->carmodels()->create(['name'=>'Q4', 'manufacturer_id' => $audi->id]);
        $audi->carmodels()->create(['name'=>'Q5', 'manufacturer_id' => $audi->id]);
        $seat->carmodels()->create(['name'=>'Toledo', 'manufacturer_id' => $seat->id]);
        $seat->carmodels()->create(['name'=>'Ibiza', 'manufacturer_id' => $seat->id]);

    }
}
