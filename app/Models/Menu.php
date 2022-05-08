<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shop;

class Menu extends Model
{
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getKindList()
    {
        return  ['醤油', '塩', '豚骨', '味噌', '鶏白湯', '魚介', '煮干し','つけ麺', 'まぜそば・油そば', '家系', '二郎系', 'その他'];
    }

    public static function getKind($kind_number)
    {
        $kind_array = ['醤油', '塩', '豚骨', '味噌', '鶏白湯', '魚介', '煮干し','つけ麺', 'まぜそば・油そば', '家系', '二郎系', 'その他'];
        return $kind_array[$kind_number];
    }

    public function getKindNumber($kind)
    {
        $kind_array = ['醤油', '塩', '豚骨', '味噌', '鶏白湯', '魚介', '煮干し', 'つけ麺', 'まぜそば・油そば', '家系', '二郎系', 'その他'];

        // kind_arrayの中からkindを見つけてそのインデックスを返す
        return array_search($kind, $kind_array);
    }

    public function getMenuName(int $id)
    {
        $menu = $this->find($id);
        return $menu['name'];
    }
}

