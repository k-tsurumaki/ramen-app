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
        // 店を返す
        return $this->belongsTo(Shop::class);
    }

    public function posts()
    {
        // メニューに紐づいた投稿を返す
        return $this->hasMany(Post::class);
    }

    public function getKindList()
    {
        // メニューの全タイプのリストを返す
        return  ['醤油', '塩', '豚骨', '味噌', '鶏白湯', '魚介', '煮干し','つけ麺', 'まぜそば・油そば', '家系', '二郎系', 'その他'];
    }

    public static function getKind($kind_number)
    {
        // kind_numberに対応したタイプを返す
        $kind_array = ['醤油', '塩', '豚骨', '味噌', '鶏白湯', '魚介', '煮干し','つけ麺', 'まぜそば・油そば', '家系', '二郎系', 'その他'];
        return $kind_array[$kind_number];
    }

    public function getKindNumber($kind)
    {
        // kind_arrayの中からkindを見つけてそのインデックスを返す
        $kind_array = ['醤油', '塩', '豚骨', '味噌', '鶏白湯', '魚介', '煮干し', 'つけ麺', 'まぜそば・油そば', '家系', '二郎系', 'その他'];

        return array_search($kind, $kind_array);
    }

    public function getMenuName(int $id)
    {
        // メニューIDからメニュー名を返す
        $menu = $this->find($id);
        return $menu['name'];
    }
}

