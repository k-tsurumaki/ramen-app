<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shop;
use App\Models\Menu;
use App\Models\Like;

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

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getPaginate(int $limit_count = 6)
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        return $this
            ->select()
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit_count);
    }

    public function getPaginateUserPosts(int $limit_count = 6, int $user_id)
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        return $this
            ->select()
            ->where('posts.user_id', '=', $user_id)
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit_count);
    }

    public function getPaginateShopPosts(int $limit_count = 6, int $shop_id)
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        return $this
            ->select()
            ->where('posts.shop_id', '=', $shop_id)
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit_count);
    }

    public function getDetailPost(int $id, Shop $shop, Menu $menu)
    {
        $edit_post = $this->find($id);
        $shop_name = $shop->getShopName($edit_post['shop_id']);
        $menu_name = $menu->getMenuName($edit_post['menu_id']);

        $menu_data = $menu->find($edit_post['menu_id']);
        $menu_kind_number = $menu_data->getKindNumber($menu_data['kind']);
        $menu_kind_list = $menu_data->getKindList();

        return ['edit_post'=>$edit_post, 'shop_name'=>$shop_name, 'menu_name'=>$menu_name, 'menu_kind_number'=>$menu_kind_number, 'menu_kind_list'=>$menu_kind_list];
    }

    public function getPaginateSearchResults($request, $limit_count)
    {
        // 検索フォームで入力された値を取得する
        $search_user_id = $request->input('search_user_id');   // ユーザー名
        $search_shop = $request->input('search_shop');   // 店名
        $search_content = $request->input('search_content');   // キーワード
        $search_kind = $request->input('search_kind');   // 種類
        $intensity = $request->input('intensity');
        $intensity_limit = $request->input('intensity_limit');
        $thickness = $request->input('thickness');
        $thickness_limit = $request->input('thickness_limit');
        $price_value = $request->input('price_value');
        $price_value_limit = $request->input('price_value_limit');
        $look = $request->input('look');
        $look_limit = $request->input('look_limit');
        $all = $request->input('all');
        $all_limit = $request->input('all_limit');
        $atmosphere = $request->input('atmosphere');
        $atmosphere_limit = $request->input('atmosphere_limit');
        $speed = $request->input('speed');
        $speed_limit = $request->input('speed_limit');
        $hospitality = $request->input('hospitality');
        $hospitality_limit = $request->input('hospitality_limit');
        $access = $request->input('access');
        $access_limit = $request->input('access_limit');

        // dd(isset($search_user_id));

        return $this
                ->select('posts.*')
                ->when(isset($search_shop), function($query) use ($search_shop){
                    $query->whereHas('shop', function($query) use($search_shop){
                        $query->where('name', 'LIKE', "%$search_shop%");
                    });
                })
                ->when(($search_kind!=0), function($query) use ($search_kind){
                    $query->whereHas('menu', function($query) use($search_kind){
                        $query->where('kind', '=', Menu::getKind($search_kind-1));
                    });
                })
                ->when(isset($search_content), function($query) use($search_content){
                    return $query->where('content', 'LIKE', "%$search_content%");
                })
                ->when(isset($search_user_id), function($query) use($search_user_id){
                    return $query->where('user_id', '=', $search_user_id);
                })
                ->when(true, function($query) use($intensity, $intensity_limit){
                    if($intensity_limit==='1')
                    {
                        return $query->where('intensity', '>=', $intensity);
                    }
                    else
                    {
                        return $query->where('intensity', '<=', $intensity);
                    }
                })
                ->when(true, function($query) use($thickness, $thickness_limit){
                    if($thickness_limit==='1')
                    {
                        return $query->where('thickness', '>=', $thickness);
                    }
                    else
                    {
                        return $query->where('thickness', '<=', $thickness);
                    }
                })
                ->when(true, function($query) use($price_value, $price_value_limit){
                    if($price_value_limit==='1')
                    {
                        return $query->where('price_value', '>=', $price_value);
                    }
                    else
                    {
                        return $query->where('price_value', '<=', $price_value);
                    }
                })
                ->when(true, function($query) use($look, $look_limit){
                    if($look_limit==='1')
                    {
                        return $query->where('look', '>=', $look);
                    }
                    else
                    {
                        return $query->where('look', '<=', $look);
                    }
                })
                ->when(true, function($query) use($all, $all_limit){
                    if($all_limit==='1')
                    {
                        return $query->where('all', '>=', $all);
                    }
                    else
                    {
                        return $query->where('all', '<=', $all);
                    }
                })
                ->when(true, function($query) use($atmosphere, $atmosphere_limit){
                    if($atmosphere_limit==='1')
                    {
                        return $query->where('atmosphere', '>=', $atmosphere);
                    }
                    else
                    {
                        return $query->where('atmosphere', '<=', $atmosphere);
                    }
                })
                ->when(true, function($query) use($speed, $speed_limit){
                    if($speed_limit==='1')
                    {
                        return $query->where('speed', '>=', $speed);
                    }
                    else
                    {
                        return $query->where('speed', '<=', $speed);
                    }
                })
                ->when(true, function($query) use($hospitality, $hospitality_limit){
                    if($hospitality_limit==='1')
                    {
                        return $query->where('hospitality', '>=', $hospitality);
                    }
                    else
                    {
                        return $query->where('hospitality', '<=', $hospitality);
                    }
                })
                ->when(true, function($query) use($access, $access_limit){
                    if($access_limit==='1')
                    {
                        return $query->where('access', '>=', $access);
                    }
                    else
                    {
                        return $query->where('access', '<=', $access);
                    }
                })
                ->whereNull('posts.deleted_at')
                ->orderBy('created_at', 'DESC')
                ->paginate($limit_count);
    }

    public function getPaginateSearchInShopPageResults($request, $limit_count)
    {
        // 検索フォームで入力された値を取得する
        $search_shop_id = $request->input('search_shop_id');   // お店のid
        $search_menu = $request->input('search_menu');   // メニュー
        $search_content = $request->input('search_content');   // キーワード

        // dd($search_shop_id);

        return $this
                ->select('posts.*')
                ->when(isset($search_shop_id), function($query) use ($search_shop_id){
                    $query->whereHas('shop', function($query) use($search_shop_id){
                        $query->where('id', '=', $search_shop_id);
                    });
                })
                ->when(isset($search_menu), function($query) use ($search_menu){
                    $query->whereHas('menu', function($query) use($search_menu){
                        $query->where('name', 'LIKE', "%$search_menu%");
                    });
                })
                ->when(isset($search_content), function($query) use($search_content){
                    return $query->where('content', 'LIKE', "%$search_content%");
                })
                ->whereNull('posts.deleted_at')
                ->orderBy('created_at', 'DESC')
                ->paginate($limit_count);
    }

    public function getPaginateLikedPosts($user_id, $limit_count)
    {
        return $this
            ->select('posts.*')
            ->whereHas('likes', function($query) use($user_id){
                $query->where('user_id', '=', $user_id);
            })
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit_count);
    }
}
