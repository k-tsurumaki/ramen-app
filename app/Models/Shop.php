<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Menu;

class Shop extends Model
{
    use HasFactory;

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
}
