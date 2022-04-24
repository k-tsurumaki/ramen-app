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
        return view('create');
    }

    public function edit($id)
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        $posts = Post::select('posts.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();
        $edit_post = Post::find($id);
        $shop = Shop::find($edit_post['shop_id']);
        $shop_name = $shop['name'];
        $menu = Menu::find($edit_post['menu_id']);
        $menu_name = $menu['name'];
        $menu_kind = $menu['kind'];

        return view('edit', compact('posts', 'edit_post', 'shop_name', 'menu_name', 'menu_kind'));
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
            $menu_exist=Shop::where('name', '=', $posts['menu'])->exists();

            // menu_idを取得
            if(!$menu_exist){
                $menu_id = Menu::insertGetId(['shop_id'=>$shop_id, 'name'=>$posts['menu'], 'kind'=>$kind]);
            }else{
                $menu = Menu::select('shops.*')
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
                'thickness'=>(int)$posts['inlineRadioOptions_1'],
                'intensity'=>(int)$posts['inlineRadioOptions_2'], 
                'price_value'=>(int)$posts['inlineRadioOptions_3'],
                'look'=>(int)$posts['inlineRadioOptions_4'],
                'all'=>(int)$posts['inlineRadioOptions_5'],
                'atmosphere'=>(int)$posts['inlineRadioOptions_6'],
                'hospitality'=>(int)$posts['inlineRadioOptions_7'],
                'access'=>(int)$posts['inlineRadioOptions_8']
            ]);
        });

        return redirect(route('home'));
    }

    public function update(Request $request)
    {
        $posts = $request->all();
        $image = $request->file('image');

        $path = \Storage::put('/public', $image);
        $path = explode('/', $path);

        DB::transaction(function() use($posts){
            Post::where('id', $posts['post_id'])->update(['content'=>$posts['content']]);
            MemoTag::where('memo_id', '=', $posts['memo_id'])->delete();

            // 新規タグが入力されているかチェック
            $tag_exist=Tag::where('user_id', '=', \Auth::id())->where('name', '=', $posts['new_tag'])->exists();

            // 新規タグがすでにtagsテーブルに存在するのかチェック
            if(!empty($posts['new_tag']) && !$tag_exist){
                // tagsにインサートしてid取得
                $tag_id = Tag::insertGetId(['user_id'=>\Auth::id(), 'name'=>$posts['new_tag']]);
                // memo_tagsにインサートして紐付け
                MemoTag::insert(['memo_id'=>$posts['memo_id'], 'tag_id'=>$tag_id]);
            }

            if(!empty($posts['tags'][0])){
                foreach($posts['tags'] as $tag){
                    MemoTag::insert(['memo_id'=>$posts['memo_id'], 'tag_id'=>$tag]);
                }
            }
        });
        return redirect(route('home'));

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
            $menu_exist=Shop::where('name', '=', $posts['menu'])->exists();

            // menu_idを取得
            if(!$menu_exist){
                $menu_id = Menu::insertGetId(['shop_id'=>$shop_id, 'name'=>$posts['menu'], 'kind'=>$kind]);
            }else{
                $menu = Menu::select('shops.*')
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
                'thickness'=>(int)$posts['inlineRadioOptions_1'],
                'intensity'=>(int)$posts['inlineRadioOptions_2'], 
                'price_value'=>(int)$posts['inlineRadioOptions_3'],
                'look'=>(int)$posts['inlineRadioOptions_4'],
                'all'=>(int)$posts['inlineRadioOptions_5'],
                'atmosphere'=>(int)$posts['inlineRadioOptions_6'],
                'hospitality'=>(int)$posts['inlineRadioOptions_7'],
                'access'=>(int)$posts['inlineRadioOptions_8']
            ]);
        });

        return redirect(route('home'));
    }
}
