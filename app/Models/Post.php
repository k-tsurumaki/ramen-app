<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shop;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;

class Post extends Model
{
    use HasFactory;
    // protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function getPaginate(int $limit_count = 6)
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        return $this
            ->select('posts.*', 'users.name AS user_name','shops.name AS shop_name')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('shops', 'shops.id', '=', 'posts.shop_id')
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit_count);
    }

    public function getPaginateUserPosts(int $limit_count = 6, int $user_id)
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        return $this
            ->select('posts.*', 'shops.name AS shop_name')
            ->leftJoin('shops', 'shops.id', '=', 'posts.shop_id')
            ->where('posts.user_id', '=', $user_id)
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit_count);
    }

    public function getPaginateShopPosts(int $limit_count = 6, int $shop_id)
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        return $this
            ->select('posts.*', 'users.name AS user_name')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->where('posts.shop_id', '=', $shop_id)
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit_count);
    }

    public function search_shop_and_keyword($request)
    {
        $search_content = $request->input('search_content');
        $search_shop = $request->input('search_shop');
        $query      = $this->with(['shop']);

        if (isset($search_content)) {
            $query->where('content', 'LIKE', '%' . $search_content . '%');
        }

        if (isset($search_shop)) {
            $query->where('name', 'LIKE', '%' . $search_shop . '%');
        }

        return $query->paginate(6);
    }
}
