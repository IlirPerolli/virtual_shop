<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function followUser(User $user)
    {

        if(!$user) {

            session()->flash('user_error','Përdoruesi nuk ekziston.' );
            return back();
        }
        if(auth()->user()->id == $user->id){
            session()->flash('user_error','Nuk mund të ndiqni veten.' );
            return back();
        }
        if (!$user->followers->contains(auth()->user()->id)) {//per mes mi bo "2her" follow nese 2 her preket follow te personi i njejte ne faqe te ndryshme
            $user->followers()->attach(auth()->user()->id);
        }
        session()->flash('success_follow','Përdoruesi u ndoq me sukses.' );
        return back();
    }
    public function unFollowUser(User $user)
    {

        if(!$user) {
            session()->flash('user_error','Përdoruesi nuk ekziston' );
            return back();

        }
        if(auth()->user()->id == $user->id){
            session()->flash('user_error','Nuk mund të ndiqni veten.' );
            return back();
        }

        $user->followers()->detach(auth()->user()->id);
        session()->flash('success_unfollow','Ndjekja u hoq me sukses.' );
        return back();
    }
    public function posts(){
        if(auth()->check()){
            // $users = auth()->user()->followings;
//
//                $users = auth()->user()->followings()->paginate(2);



            $categories = Category::orderBy('id', 'ASC')->take(10)->get();
            $cities = City::orderBy('id', 'ASC')->take(30)->get();
            $allcategories = Category::all();
            $all_cities = City::orderBy('name','asc')->get();
            //Per te marrur perdoruesit qe mund t'i njeh perdoruesi i kyqur
            $users = auth()->user()->followings()->pluck('leader_id');
            $posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->paginate(20);

            //Show users that current user may know
            $users = UsersYouMayKnowController::users();
            return view('index', compact('posts', 'users','cities', 'categories', 'allcategories','all_cities'));
        }
        else{
            return redirect()->route('discover.posts');
        }
    }
//    public function users(){
//        if(auth()->check()){
//
//            $users = auth()->user()->followings()->pluck('leader_id');
//            $posts = User::whereIn('id', $users)->orderBy('name', 'ASC')->paginate(20);
//
//            return view('discover.users', compact('posts'));
//        }
//        else{
//            return view('index');
//        }
//    }
    public function followings($slug){
        $user = User::findBySlugOrFail($slug);
        $followings = $user->followings()->pluck('leader_id');
        $followings = User::whereIn('id', $followings)->orderBy('name', 'ASC')->paginate(20);
        return view('user.followings',compact('followings', 'user'));
    }
    public function followers($slug){
        $user = User::findBySlugOrFail($slug);
        $followers = $user->followers()->pluck('follower_id');
        $followers = User::whereIn('id', $followers)->orderBy('name', 'ASC')->paginate(20);
        return view('user.followers',compact('followers', 'user'));
    }
}
