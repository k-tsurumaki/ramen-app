<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;
use App\Models\Menu;

class Shop extends Model
{
    use HasFactory;

    public function user()
    {
        // 店のオーナーを返す
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        // 店に紐づいている投稿を返す
        return $this->hasMany(Post::class);
    }

    public function menus()
    {
        // 店のメニューを返す
        return $this->hasMany(Menu::class);
    }

    public function getShopName(int $id)
    {
        // 店のIDから店の名前を返す
        $shop = $this->find($id);
        return $shop['name'];
    }

    public function getShopId(int $user_id)
    {
        // 店のオーナーIDから店のIDを返す
        $shop = $this            
            ->where('shops.user_id', '=', $user_id)
            ->first();
        return $shop->id;
    }

    public function IsShopExist(int $user_id)
    {
        // 店のオーナーIDから
        $shop = $this            
            ->where('shops.user_id', '=', $user_id)
            ->first();
        return $shop->id;
    }
}
