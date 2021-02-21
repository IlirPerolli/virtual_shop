<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserEditRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    public function show($slug)
    {
        //Show users that current user may know
        $users = UsersYouMayKnowController::users();

        $user = User::findBySlugOrFail($slug);
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::orderBy('id', 'ASC')->take(10)->get();
        $cities = City::orderBy('id', 'ASC')->take(30)->get();
        return view('user.show', compact('user','posts', 'followers', 'followings','user_posts', 'users', 'categories' ,'cities' ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        return view('user.edit', compact('user','followers', 'followings', 'user_posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request)
    {
        $user = auth()->user();
        if ($user->is_business == 1){
            if ($request->business_name == null){
            $request->validate(['business_name'=>'string', 'min:2', 'max:255']);
            }
        }

            $input = $request->all();
        $user->update($input);
        session()->flash('updated_user', 'Profili u ndryshua me sukses.');
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
//        $user = User::findBySlugOrFail($slug);
//        if (auth()->user()->id != $user->id && !auth()->user()->isAdmin()){
//            abort(403, 'Unauthorized action.');
//        }
//        $posts = $user->posts;
//        foreach ($posts as $post){
//        if ($post->photo) {
//            if (strpos($post->photo->photo, ',') !== false) {
//                foreach (explode(',', $post->photo->photo) as $photo) {
//                    if (file_exists(public_path() . "/images/" . $photo)) {//kontrollo nese ekziston foto ne storage para se te fshihet
//                        unlink(public_path() . "/images/" . $photo);
//                    }
//                }
//
//            } else {
//                if (file_exists(public_path() . $post->photo->photo)) {//kontrollo nese ekziston foto ne storage para se te fshihet
//                    unlink(public_path() . $post->photo->photo);
//                }
//            }
//
//        }
//        $post->delete();
//        }
//        $user->delete();
//        if (auth()->user()->slug == $user->slug){
//            return redirect()->route('login');
//        }
//        else{
//            return back();
//        }
//
//

    }
}
