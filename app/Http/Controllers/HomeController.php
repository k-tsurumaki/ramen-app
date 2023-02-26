<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Shop;
use App\Models\Menu;
use Storage;
use Carbon\Carbon;
use DB;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

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

    public function index(Post $post)
    {                
        return view('home')->with(['posts' => $post->getPaginateUserPosts(6, \Auth::id())]);
    }

    public function others(Post $post, $id)
    {         
        return view('others')->with(['posts' => $post->getPaginateUserPosts(6, $id), 'user' => User::find($id)]);
    }

    public function friend_posts(Post $post)
    {
        return view('friend_posts')->with(['posts' => $post->getPaginateFriendPosts(6)]);
    }

    public function timeline(Post $post)
    {
        return view('timeline')->with(['posts' => $post->getPaginate(6)]);
    }

    public function shop(Post $post, $id)
    {
        return view('shop')->with(['posts' => $post->getPaginateShopPosts(6, $id), 'shop' => Shop::find($id)]);
    }

    public function create(Menu $menu)
    {
        return view('create')->with(['menu_kind_list' => $menu->getKindList()]);
    }

    public function register_shop_profile()
    {
        return view('register_shop_profile');
    }
    
    public function detail_post(Post $post, Shop $shop, Menu $menu, $id)
    {
        return view('detail_post')->with(['detail' => $post->getDetailPost($id, $shop, $menu)]);
    }

    public function edit(Post $post, Shop $shop, Menu $menu, $id)
    {
        return view('edit')->with(['detail' => $post->getDetailPost($id, $shop, $menu)]);
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
            'speed'=>'required',
            'hospitality'=>'required',
            'access'=>'required'
        ]);
        $image = $request->file('image');

        // ローカル環境（保存場所は storage/app/public）
        $path = \Storage::put('/public', $image);
        $path = explode('/', $path);
        // dd($path);

        // 2023/2/26 s3のバケットを削除
        //バケットに「test」フォルダを作っているとき
        // $path = Storage::disk('s3')->putFile('/test',$image, 'public');

        DB::transaction(function() use($posts, $path) {
            // 存在確認
            $shop_exist=Shop::where('name', '=', $posts['shop'])->exists();

            // shop_idを取得
            if(!$shop_exist){
                $shop_id = Shop::insertGetId(['name'=>$posts['shop'], 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
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
                $menu_id = Menu::insertGetId(['shop_id'=>$shop_id, 'name'=>$posts['menu'], 'kind'=>$kind, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now(),]);
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
                // 2023/2/26 s3のバケットを削除
                // 'image'=>Storage::disk('s3')->url($path), 
                'price'=>(int)$posts['price'],
                'thickness'=>(int)$posts['thickness'],
                'intensity'=>(int)$posts['intensity'], 
                'price_value'=>(int)$posts['price_value'],
                'look'=>(int)$posts['look'],
                'all'=>(int)$posts['all'],
                'atmosphere'=>(int)$posts['atmosphere'],
                'speed'=>(int)$posts['speed'],
                'hospitality'=>(int)$posts['hospitality'],
                'access'=>(int)$posts['access'],
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        });

        return redirect(route('home'));
    }

    public function store_shop(Request $request)
    {
        $posts = $request->all();
        $request->validate([
            'image'=>'required',
            'shop'=>'required',
            'address'=>'required',
        ]);
        $image = $request->file('image');

        $path = \Storage::put('/public', $image);
        $path = explode('/', $path);

        // 2023/2/26 s3のバケットを削除
        //バケットに「test」フォルダを作っているとき
        // $path = Storage::disk('s3')->putFile('/test',$image, 'public');

        DB::transaction(function() use($posts, $path) {
            // 存在確認
            $shop_name_exist=Shop::where('name', '=', $posts['shop'])->whereNull('user_id')->exists();
            $shop_address_exist=Shop::where('address', '=', $posts['address'])->whereNull('user_id')->exists();

            if($shop_name_exist && $shop_address_exist){
                Shop::where('name', '=', $posts['shop'])->where('address', '=', $posts['address'])->update([
                    'image'=>$path[1],        
                    // 2023/2/26 s3のバケットを削除
                    // 'image'=>Storage::disk('s3')->url($path),
                    'user_id'=>\Auth::id()
                ]);
            }
            elseif($shop_name_exist && !($shop_address_exist)){
                Shop::where('name', '=', $posts['shop'])->update([
                    'address'=>$posts['address'],
                    'image'=>$path[1],        
                    // 2023/2/26 s3のバケットを削除
                    // 'image'=>Storage::disk('s3')->url($path),
                    'user_id'=>\Auth::id()
                ]);
            }
            else{
                Shop::insert(['name'=>$posts['shop'], 
                            'address'=>$posts['address'],
                            'image'=>$path[1],  
                            // 2023/2/26 s3のバケットを削除 
                            // 'image'=>Storage::disk('s3')->url($path),
                            'user_id'=>\Auth::id(),
                            'created_at'=>Carbon::now(),
                            'updated_at'=>Carbon::now(),]);
            }
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
            'speed'=>'required',
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
                'speed'=>(int)$posts['speed'],
                'hospitality'=>(int)$posts['hospitality'],
                'access'=>(int)$posts['access']
            ]);


        });
        return redirect(route('home'));
    }

    public function update_profile(Request $request)
    {
        $user = $request->all();

        $request->validate([
            'name'=>'required',
            'image'=>'required'
        ]);

        $image = $request->file('image');

        $path = \Storage::put('/public', $image);
        $path = explode('/', $path);
        // dd($path);
       
        // 2023/2/26 s3のバケットを削除
        //バケットに「test」フォルダを作っているとき
        // $path = Storage::disk('s3')->putFile('/test',$image, 'public');

        DB::transaction(function() use($user, $path){
            User::where('id', \Auth::id())->update([
                'name'=>$user['name'],
                'image'=>$path[1],        
                // 2023/2/26 s3のバケットを削除
                // 'image'=>Storage::disk('s3')->url($path),
            ]);
        });
        return redirect(route('home'));
    }

    public function update_shop_profile(Request $request)
    {
        $shop = $request->all();
        // dd($shop['id']);

        $request->validate([
            'shop'=>'required',
            'address'=>'required',
        ]);

        $image = $request->file('image');
        if(isset($image)){
            $path = \Storage::put('/public', $image);
            $path = explode('/', $path);
            // 2023/2/26 s3のバケットを削除
            // $path = Storage::disk('s3')->putFile('/test',$image, 'public');

            DB::transaction(function() use($shop, $path){
                Shop::where('id', $shop['id'])->update([
                    'name'=>$shop['shop'],
                    'image'=>$path[1],        
                    // 2023/2/26 s3のバケットを削除
                    // 'image'=>Storage::disk('s3')->url($path),
                    'address'=>$shop['address'],
                    'station'=>$shop['station']
                ]);
            });
        }
        else{
            DB::transaction(function() use($shop){
                Shop::where('id', $shop['id'])->update([
                    'name'=>$shop['shop'],
                    'address'=>$shop['address'],
                    'station'=>$shop['station']
                ]);
            });
        }
        return redirect('shop/'.$shop['id']);
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

    
    public function search(Post $post, Request $request) // 検索
    {
        return view('search')->with(['search_results' => $post->getPaginateSearchResults($request, 6)]);
    }

    public function search_in_shop_page(Post $post, Request $request) // お店のページでの検索
    {
        return view('search')->with(['search_results' => $post->getPaginateSearchInShopPageResults($request, 6)]);
    }

    public function like_ranking(Post $post, $id)
    {
        return view('search')->with(['search_results' => $post->getPaginateLikedRankingInShopPage($id, 6)]);
    }

    public function edit_profile()
    {
        return view('edit_profile');
    }

    public function edit_shop_profile($id)
    {
        return view('edit_shop_profile')->with(['shop' => Shop::find($id)]);
    }

    public function liked_posts(Post $post)
    {
        return view('liked_posts')->with(['liked_posts' => $post->getPaginateLikedPosts( \Auth::id(), 6)]);
    }
}
