<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Shop;
use App\Models\Menu;
use DB;
use Mockery\Generator\StringManipulation\Pass\Pass;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        $posts = Post::select('posts.*', 'shops.name AS shop')
            ->leftJoin('shops', 'shops.id', '=', 'posts.shop_id')
            ->where('posts.user_id', '=', \Auth::id())
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
                
        return view('home', compact('posts'));
    }

    public function timeline()
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        $posts = Post::select('posts.*', 'shops.name AS shop')
            ->leftJoin('shops', 'shops.id', '=', 'posts.shop_id')
            ->whereNull('posts.deleted_at')
            ->orderBy('created_at', 'DESC')
            ->get();
                
        return view('timeline', compact('posts'));
    }

    public function create()
    {
        $menu_kind_list = Menu::getKindList();
        return view('create', compact('menu_kind_list'));
    }

    public function detailPost($id)
    {
        $edit_post = Post::find($id);
        $shop = Shop::find($edit_post['shop_id']);
        $shop_name = $shop['name'];
        $menu = Menu::find($edit_post['menu_id']);
        $menu_name = $menu['name'];

        $menu_kind_number = Menu::getKindNumber($menu['kind']);
        $menu_kind_list = Menu::getKindList();

        return view('detail_post', compact('edit_post', 'shop_name', 'menu_name', 'menu_kind_number', 'menu_kind_list'));
    }

    public function edit($id)
    {
        $edit_post = Post::find($id);
        $shop = Shop::find($edit_post['shop_id']);
        $shop_name = $shop['name'];
        $menu = Menu::find($edit_post['menu_id']);
        $menu_name = $menu['name'];

        $menu_kind_number = Menu::getKindNumber($menu['kind']);
        $menu_kind_list = Menu::getKindList();

        return view('edit', compact('edit_post', 'shop_name', 'menu_name', 'menu_kind_number', 'menu_kind_list'));
    }

    public function store(Request $request)
    {
        $posts = $request->all();
        $request->validate([
            'image'=>'required',
            'shop'=>'required',
            'menu'=>'required',
            'price'=>'required',
            'content'=>'required',
            'kind'=>'required',
            'intensity'=>'required',
            'thickness'=>'required',
            'price_value'=>'required',
            'look'=>'required',
            'all'=>'required',
            'atmosphere'=>'required',
            'hospitality'=>'required',
            'access'=>'required'
        ]);
        $image = $request->file('image');

        $path = \Storage::put('/public', $image);
        $path = explode('/', $path);

        DB::transaction(function() use($posts, $path) {
            // 存在確認
            $shop_exist=Shop::where('name', '=', $posts['shop'])->exists();

            // shop_idを取得
            if(!$shop_exist){
                $shop_id = Shop::insertGetId(['name'=>$posts['shop']]);
            }else{
                $shop = Shop::select('shops.*')
                    ->where('name', '=', $posts['shop'])
                    ->get();
                $shop_id = $shop[0]['id'];
            }

            $kind = Menu::getKind($posts['kind']);

            // 存在確認
            $menu_exist=Menu::where('name', '=', $posts['menu'])->where('shop_id', '=', $shop_id)->where('kind', '=', $kind)->exists();

            // menu_idを取得
            if(!$menu_exist){
                $menu_id = Menu::insertGetId(['shop_id'=>$shop_id, 'name'=>$posts['menu'], 'kind'=>$kind]);
            }else{
                $menu = Menu::select('menus.*')
                    ->where('name', '=', $posts['menu'])
                    ->where('shop_id', '=', $shop_id)
                    ->where('kind', '=', $kind)
                    ->get();
                $menu_id = $menu[0]['id'];
            }
    
            Post::insert([
                'user_id'=>\Auth::id(),
                'shop_id'=>$shop_id,
                'menu_id'=>$menu_id,
                'content'=>$posts['content'],
                'image'=>$path[1], 
                'price'=>(int)$posts['price'],
                'thickness'=>(int)$posts['thickness'],
                'intensity'=>(int)$posts['intensity'], 
                'price_value'=>(int)$posts['price_value'],
                'look'=>(int)$posts['look'],
                'all'=>(int)$posts['all'],
                'atmosphere'=>(int)$posts['atmosphere'],
                'hospitality'=>(int)$posts['hospitality'],
                'access'=>(int)$posts['access']
            ]);
        });

        return redirect(route('home'));
    }

    public function update(Request $request)
    {
        $posts = $request->all();
        $request->validate([
            'shop'=>'required',
            'menu'=>'required',
            'price'=>'required',
            'content'=>'required',
            'kind'=>'required',
            'intensity'=>'required',
            'thickness'=>'required',
            'price_value'=>'required',
            'look'=>'required',
            'all'=>'required',
            'atmosphere'=>'required',
            'hospitality'=>'required',
            'access'=>'required'
        ]);
        DB::transaction(function() use($posts){
            // 存在確認
            $shop_exist=Shop::where('name', '=', $posts['shop'])->exists();

            // shop_idを取得
            if(!$shop_exist){
                $shop_id = Shop::insertGetId(['name'=>$posts['shop']]);
            }else{
                $shop = Shop::select('shops.*')
                    ->where('name', '=', $posts['shop'])
                    ->get();
                $shop_id = $shop[0]['id'];
            }

            $kind = Menu::getKind($posts['kind']);

            // 存在確認
            $menu_exist=Menu::where('name', '=', $posts['menu'])->where('shop_id', '=', $shop_id)->where('kind', '=', $kind)->exists();

            // menu_idを取得
            if(!$menu_exist){
                $menu_id = Menu::insertGetId(['shop_id'=>$shop_id, 'name'=>$posts['menu'], 'kind'=>$kind]);
            }else{
                $menu = Menu::select('menus.*')
                    ->where('name', '=', $posts['menu'])
                    ->where('shop_id', '=', $shop_id)
                    ->where('kind', '=', $kind)
                    ->get();
                $menu_id = $menu[0]['id'];
            }

            Post::where('id', $posts['post_id'])->update([
                'shop_id'=>$shop_id,
                'menu_id'=>$menu_id,
                'content'=>$posts['content'],
                'price'=>(int)$posts['price'],
                'thickness'=>(int)$posts['thickness'],
                'intensity'=>(int)$posts['intensity'], 
                'price_value'=>(int)$posts['price_value'],
                'look'=>(int)$posts['look'],
                'all'=>(int)$posts['all'],
                'atmosphere'=>(int)$posts['atmosphere'],
                'hospitality'=>(int)$posts['hospitality'],
                'access'=>(int)$posts['access']
            ]);


        });
        return redirect(route('home'));
    }


    public function destroy(Request $request)
    {
        $posts = $request->all();

        DB::transaction(function() use($posts){
            Post::where('id', $posts['post_id'])->update([
                'deleted_at' => date("Y-m-d H:i:s", time())
            ]);
        });
        return redirect(route('home'));
    }

    public function searchByUserId(Request $request)
    {
        // 検索フォームで入力された値を取得する
        $search_user_id = $request->input('search_user_id');
        $search_shop = $request->input('search_shop');   // 店名
        $search_content = $request->input('search_content');   // キーワード

        $query_shops = Shop::query();

        // まず店名で検索
        if(isset($search_shop)){
            $query_shops->where('name', 'LIKE',"%$search_shop%");
        }

        // 検索結果を取得
        $search_shop_results = $query_shops->whereNull('deleted_at')->orderBy('updated_at', 'DESC')->get();

        $search_results = array();

        foreach($search_shop_results as $search_shop_result){
            // もしキーワードが入力されていたら
            if(isset($search_content)){
                $search_content_results = $search_shop_result
                    ->posts()
                    ->select('posts.*', 'shops.name AS shop')
                    ->leftJoin('shops', 'shops.id', '=', 'posts.shop_id')
                    ->where('posts.user_id', '=', $search_user_id)
                    ->where('content', 'LIKE',"%$search_content%")
                    ->whereNull('posts.deleted_at')
                    ->orderBy('updated_at', 'DESC')
                    ->get();
            } 
            // キーワードが入力されていなければ
            else{
                $search_content_results = $search_shop_result
                    ->posts()
                    ->select('posts.*', 'shops.name AS shop')
                    ->leftJoin('shops', 'shops.id', '=', 'posts.shop_id')
                    ->where('posts.user_id', '=', $search_user_id)
                    ->whereNull('posts.deleted_at')
                    ->orderBy('updated_at', 'DESC')
                    ->get();
            } 

            if(!empty($search_content_results)){
                foreach($search_content_results as $search_content_result)
                {
                    array_push($search_results, $search_content_result);
                }
            } 
        }

        return view('search', compact('search_results'));
    }

    public function search(Request $request)
    {
        // 検索フォームで入力された値を取得する
        $search_shop = $request->input('search_shop');   // 店名
        $search_content = $request->input('search_content');   // キーワード

        $query_shops = Shop::query();

        // まず店名で検索
        if(isset($search_shop)){
            $query_shops->where('name', 'LIKE',"%$search_shop%");
        }

        // 検索結果を取得
        $search_shop_results = $query_shops->whereNull('deleted_at')->orderBy('updated_at', 'DESC')->get();

        $search_results = array();

        foreach($search_shop_results as $search_shop_result){
            // もしキーワードが入力されていたら
            if(isset($search_content)){
                $search_content_results = $search_shop_result
                    ->posts()
                    ->select('posts.*', 'shops.name AS shop')
                    ->leftJoin('shops', 'shops.id', '=', 'posts.shop_id')
                    ->where('content', 'LIKE',"%$search_content%")
                    ->whereNull('posts.deleted_at')
                    ->orderBy('updated_at', 'DESC')
                    ->get();
            } 
            // キーワードが入力されていなければ
            else{
                $search_content_results = $search_shop_result
                    ->posts()
                    ->select('posts.*', 'shops.name AS shop')
                    ->leftJoin('shops', 'shops.id', '=', 'posts.shop_id')
                    ->whereNull('posts.deleted_at')
                    ->orderBy('updated_at', 'DESC')
                    ->get();
            } 

            if(!empty($search_content_results)){
                foreach($search_content_results as $search_content_result)
                {
                    array_push($search_results, $search_content_result);
                }
            } 
        }

        return view('search', compact('search_results'));
    }
}
