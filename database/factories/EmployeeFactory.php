<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
      'firstName' => $faker->firstNameMale,
      'lastName' => $faker->lastName,
      'email' => $faker->unique()->safeEmail,
      'phone' => $faker->phoneNumber
    ];
});
