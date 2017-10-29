<?php

use App\FoodList;
use Illuminate\Database\Seeder;

class FoodListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foodlist = new FoodList();
        $foodlist->title = 'Koolhydraatarm sport dieet';
        $foodlist->body = 'Koolhydraatarm brood, zoete aardappelen, kip';
        $foodlist->user_id = 3;
        $foodlist->category_id = 1;
        $foodlist->highlighted = 0;
        $foodlist->save();

        $foodlist2 = new FoodList();
        $foodlist2->title = 'Caloriearm dieet';
        $foodlist2->body = 'Rijstwafel, soep, cracker';
        $foodlist2->user_id = 2;
        $foodlist2->category_id = 1;
        $foodlist2->highlighted = 1;
        $foodlist2->save();
    }
}
