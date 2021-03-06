<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreCitiesRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $all_cities = City::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('id', 'ASC')->take(10)->get();
        $cities = City::orderBy('id', 'ASC')->take(30)->get();

        return view('cities.index', compact('users','categories','cities', 'all_cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderBy('name', 'asc')->get();
        return view ('cities.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreCitiesRequest $request)
    {

        $input = $request->all();
        City::create($input);
        session()->flash('added_city', 'Qyteti u shtua me sukses.');
        return back();
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

        $city = City::findBySlugOrFail($slug);
        $categories = Category::orderBy('id', 'ASC')->take(10)->get();
        $cities = City::orderBy('id', 'ASC')->take(30)->get();
        $posts = $city->posts()->orderBy('created_at','DESC')->paginate(20);
        return view('cities.show', compact('posts', 'city',  'users', 'categories', 'cities'));
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
    public function destroy(City $city)
    {


        $city->delete();
        session()->flash('deleted_city', 'Qyteti u fshi me sukses.');
        return back();
    }
}
