<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Shop;
use App\Models\Menu;

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
        $posts=Post::select('posts.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'DESC')
            ->get();
        
        return view('home', compact('posts'));
    }

    public function timeline()
    {
        // 過去の投稿を取得 deleted_atがNullのものを降順で取ってくる
        $posts=Post::select('posts.*')
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

    public function store(Request $request)
    {
        $posts = $request->all();
        $image = $request->file('image');

        $path = \Storage::put('/public', $image);
        $path = explode('/', $path);

        // dd((int)$posts['inlineRadioOptions_6']);

        // Shop::insert(['name'=>$posts['shop']]);
        // Menu::insert(['name'=>$posts['menu'], 'kind'=>$posts['kind']]);
        Post::insert([
            'user_id'=>\Auth::id(),
            'shop_id'=>1,
            'menu_id'=>1,
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

        return redirect(route('home'));
    }
}
