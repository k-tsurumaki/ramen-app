<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Shop;
use App\Models\Menu;
use DB;

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
        $posts = Post::select('posts.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();
        
        return view('home', compact('posts'));
    }

    public function timeline()
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        $posts = Post::select('posts.*')
        ->where('user_id', '=', \Auth::id())
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();
        
        return view('timeline', compact('posts'));
    }

    public function create()
    {
        $menu_kind_list = Menu::getKindList();
        return view('create', compact('menu_kind_list'));
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
            $menu_exist=Menu::where('name', '=', $posts['menu'])->where('shop_id', '=', $shop_id)->exists();

            // menu_idを取得
            if(!$menu_exist){
                $menu_id = Menu::insertGetId(['shop_id'=>$shop_id, 'name'=>$posts['menu'], 'kind'=>$kind]);
            }else{
                $menu = Menu::select('menus.*')
                ->where('name', '=', $posts['menu'])
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
            $menu_exist=Menu::where('name', '=', $posts['menu'])->where('shop_id', '=', $shop_id)->exists();

            // menu_idを取得
            if(!$menu_exist){
                $menu_id = Menu::insertGetId(['shop_id'=>$shop_id, 'name'=>$posts['menu'], 'kind'=>$kind]);
            }else{
                $menu = Menu::select('menus.*')
                ->where('name', '=', $posts['menu'])
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
}
