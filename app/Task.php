<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


// Command: php artisan make:model Task
class Task extends Model
{
    /*
     *
     * 不必明確告知 Eloquent 模型要對應哪張資料表，
     * 因為它會假設資料表是模型名稱的複數型態。
     * 所以，在這個範例中，
     * Task 模型會假設要對應至 tasks 資料表。
     *
     */
}
