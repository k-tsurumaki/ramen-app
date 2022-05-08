<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Shop;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use phpDocumentor\Reflection\PseudoTypes\False_;

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

    public function getPaginateSearchResults($request, bool $isAll = false, int $limit_count = 6, )
    {
        // 検索フォームで入力された値を取得する
        $search_user_id = $request->input('search_user_id');   // ユーザー名
        $search_shop = $request->input('search_shop');   // 店名
        $search_content = $request->input('search_content');   // キーワード

        $search_results = $this
                ->select('posts.*')
                ->when(isset($search_shop), function($query) use ($search_shop){
                    $query->whereHas('shop', function($query) use($search_shop){
                        $query->where('name', 'LIKE', "%$search_shop%");
                    });
                })
                ->when(isset($search_content), function($query) use($search_content){
                    return $query->where('content', 'LIKE', "%$search_content%");
                })
                ->when(!$isAll, function($query) use($search_user_id){
                    return $query->where('user_id', '=', $search_user_id);
                })
                ->whereNull('posts.deleted_at')
                ->orderBy('updated_at', 'DESC')
                ->paginate($limit_count);

        return $search_results;
    }
}
