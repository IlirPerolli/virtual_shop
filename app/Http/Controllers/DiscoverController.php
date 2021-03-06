<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }
    public function posts(){
        $allcategories = Category::all();
        $all_cities = City::orderBy('name','asc')->get();
        if(auth()->check()){
            // $users = auth()->user()->followings;
//
//                $users = auth()->user()->followings()->paginate(2);
            $users = auth()->user()->followings()->pluck('leader_id');
            $user = auth()->user()->id;
            $users->push($user);

            $posts = Post::whereNotIn('user_id', $users)->orderBy('created_at', 'DESC')->paginate(20);

            //Show users that current user may know
            $users = UsersYouMayKnowController::users();

            $categories = Category::orderBy('id', 'ASC')->take(10)->get();
            $cities = City::orderBy('id', 'ASC')->take(30)->get();
            return view('discover.posts', compact('posts', 'users', 'cities','categories', 'all_cities','allcategories'));
        }
        else{
            $posts = Post::orderBy('created_at', 'desc')->paginate(20);
            //Show users that current user may know
            $users = UsersYouMayKnowController::users();
            $categories = Category::orderBy('id', 'ASC')->take(10)->get();
            $cities = City::orderBy('id', 'ASC')->take(30)->get();
            return view('discover.posts', compact('posts', 'users','cities', 'categories', 'all_cities', 'allcategories'));
        }
    }
    public function users(){
//        if(auth()->check()){
//
//            $users = auth()->user()->followings()->pluck('leader_id');
//            $user = auth()->user()->id;
//            $users->push($user);
//
//            $users = User::whereNotIn('id', $users)->where('is_business',0)->orderBy('name', 'ASC')->paginate(20);
//
//            return view('discover.users', compact('users'));
//        }
//        else{
//            $users = User::orderBy('name', 'ASC')->where('is_business',0)->paginate(20);
//            return view('discover.users', compact('users'));
//        }
        $users = UsersYouMayKnowController::discover_users();
        return view('discover.users', compact('users'));
    }

    public function companies(){
//        if(auth()->check()){
//
//            $users = auth()->user()->followings()->pluck('leader_id');
//            $user = auth()->user()->id;
//            $users->push($user);
//
//            $users = User::whereNotIn('id', $users)->where('is_business',1)->orderBy('name', 'ASC')->paginate(20);
//
//            return view('discover.companies', compact('users'));
//        }
//        else{
//            $users = User::orderBy('name', 'ASC')->where('is_business',1)->paginate(20);
//            return view('discover.companies', compact('users'));
//        }
        $users = UsersYouMayKnowController::discover_companies();
        return view('discover.companies', compact('users'));
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
    public function destroy($id)
    {
        //
    }
}
