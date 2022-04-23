<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public static function getKind($kind_number)
    {
        $kind_array = ['醤油', '塩', '豚骨', '味噌', '鶏白湯', 'つけ麺', 'まぜそば・油そば', '家系', '二郎系', 'その他'];
        return $kind_array[$kind_number-1];
    }
}

