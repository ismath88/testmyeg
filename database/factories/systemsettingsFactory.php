<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\systemsettings;
use Faker\Generator as Faker;

$factory->define(systemsettings::class, function (Faker $faker) {

    return [
        'gold_user_limit' => $faker->word,
        'platinum_user_limit' => $faker->word,
        'topagent_limit' => $faker->word,
        'topagent_limit_days' => $faker->word,
        'commission' => $faker->word,
        'gst' => $faker->word,
        'cutoff_date_invoice' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
