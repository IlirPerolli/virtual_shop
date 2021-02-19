<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $posts = $user->wishlist()->paginate(20);
        $users = UsersYouMayKnowController::users();
        $categories = Category::orderBy('name', 'ASC')->take(20)->get();
        $cities = City::orderBy('id', 'ASC')->take(30)->get();
        return view('wishlist.index', compact('posts', 'users','cities', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $user = auth()->user();
        if (!$user->wishlist->contains($post->id)) {//per mes mi bo "2her" follow nese 2 her preket follow te personi i njejte ne faqe te ndryshme
            $user->wishlist()->attach($post->id);
            session()->flash('success_wishlist','Postimi u vendos në listën e dëshirave me sukses.');
        }
        else{
            session()->flash('wishlist_failure','Ky postim tashmë ekziston në listen e dëshirave.');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $user = auth()->user();
        if ($user->wishlist->contains($post->id)) {
            $user->wishlist()->detach($post->id);
            session()->flash('wishlist_item_deleted','Postimi u fshi nga lista e dëshirave me sukses.');
        }
        return back();
    }
}
