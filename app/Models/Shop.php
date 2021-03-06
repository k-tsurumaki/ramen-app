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
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function getShopName(int $id)
    {
        $shop = $this->find($id);
        return $shop['name'];
    }

    public function getShopId(int $user_id)
    {
        $shop = $this            
            ->where('shops.user_id', '=', $user_id)
            ->first();
        return $shop->id;
    }

    public function IsShopExist(int $user_id)
    {
        $shop = $this            
            ->where('shops.user_id', '=', $user_id)
            ->first();
        return $shop->id;
    }
}
