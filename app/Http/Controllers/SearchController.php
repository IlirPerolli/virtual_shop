<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    public function users(Request $request)
    {
        $input = $request->q;

        if ($input!='') {
            $users = User::where(DB::raw('CONCAT( name, " ", surname)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( surname, " ", name)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( name, surname)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( surname, name)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( business_name)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( username)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( slug)'), 'like', '%' . $input . '%')
                ->orWhere('email', 'like', '%' . $input . '%')
                ->paginate(10)->appends(request()->query());
            //Kjo appends per te marrur edhe get requestat tjere ne get metoden
            if(count($users)>0){
                return view('search.users', compact('users'));
            }
            else{
                session()->flash('user_not_found', "Nuk u gjet asnjë përdorues");
                return redirect()->route('search.users');

            }
        }

        return view('search.users');
    }


    public function posts(Request $request)
    {
        $input = $request->q;
        $categories = Category::orderBy('id', 'ASC')->take(10)->get();
        //Show users that current user may know
        if(auth()->check()){

            $users = auth()->user()->followings()->pluck('leader_id');
            $user = auth()->user()->id;
            $users->push($user);
            $users = User::whereNotIn('id', $users)->orderBy('name', 'ASC')->take(5)->get();
        }
        else{
            $users = User::orderBy('name', 'ASC')->take(5)->get();
        }

        if ($input!='') {
            $posts = Post::where(DB::raw('CONCAT( title, " ", body)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( body, " ", title)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( title, body)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( body, title)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( price)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( mobile_number)'), 'like', '%' . $input . '%')
                ->orWhere(DB::raw('CONCAT( slug)'), 'like', '%' . $input . '%')
                ->paginate(10)->appends(request()->query());
            //Kjo appends per te marrur edhe get requestat tjere ne get metoden
            if(count($posts)>0){
                return view('search.posts', compact('posts','users', 'categories'));
            }
            else{
                session()->flash('post_not_found', "Nuk u gjet asnjë postim.");
                return redirect()->route('search.posts');

            }
        }

        return view('search.posts', compact('users', 'categories'));
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
