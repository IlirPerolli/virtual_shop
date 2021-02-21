<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {

            $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        $users = UsersYouMayKnowController::users();
            $categories = Category::orderBy('name', 'ASC')->take(20)->get();
        $cities = City::orderBy('id', 'ASC')->take(30)->get();
            return view('admin.posts', compact('posts', 'users','cities', 'categories'));

    }
    public function users(){

        $users = User::orderBy('name', 'ASC')->take(5)->paginate(20);
        return view('admin.users', compact( 'users'));
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
    public function store(Request $request)
    {
        //
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
    public function destroyPosts(Post $post)
    {

        if ($post->photo){
            if (strpos($post->photo->photo,',') !== false){
                foreach(explode(',',$post->photo->photo) as $photo) {
                    if (file_exists(public_path() . "/images/" . $photo)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                        unlink(public_path() . "/images/" . $photo);
                    }
                }

            }
            else{
                if (file_exists(public_path() .  $post->photo->photo)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                    unlink(public_path().$post->photo->photo);
            }
            }


        }
        $post->delete();
        session()->flash('deleted_post', 'Postimi u fshi me sukses.');
        return redirect()->route('admin.posts');
    }
    public function destroyUsers($slug){
        $user = User::findBySlugOrFail($slug);
        if (auth()->user()->id != $user->id && !auth()->user()->isAdmin()){
            abort(403, 'Unauthorized action.');
        }
        $posts = $user->posts;
        foreach ($posts as $post){
            if ($post->photo) {
                if (strpos($post->photo->photo, ',') !== false) {
                    foreach (explode(',', $post->photo->photo) as $photo) {
                        if (file_exists(public_path() . "/images/" . $photo)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                            unlink(public_path() . "/images/" . $photo);
                        }
                    }

                } else {
                    if (file_exists(public_path() . $post->photo->photo)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                        unlink(public_path() . $post->photo->photo);
                    }
                }

            }
            $post->delete();
        }
        $user->delete();
        if (auth()->user()->slug == $user->slug){
            return redirect()->route('login');
        }
        else{
            return back();
        }


    }
}
