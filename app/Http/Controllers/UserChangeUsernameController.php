<?php

namespace App\Http\Controllers;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class UserChangeUsernameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        return view('user.change_username', compact('user', 'followers', 'followings', 'user_posts'));
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
    public function update(Request $request)
    {
        if (auth()->user()->username_changed == 1){
            session()->flash('username_exceeded','Username mund të ndryshohet vetëm një herë');
            return back();
        }
        if (auth()->user()->username == $request->username){
            session()->flash('current_username','Username i ri nuk mund të jetë i njejtë me usernamin e vjetër');
            return back();
        }

        $request->validate([
            'username' => ['required', 'string','min:3', 'max:255','regex:/^[A-Za-z0-9]+$/', 'unique:users'],
        ]);
        $request['username_changed']=1;

        $user = auth()->user();
        $user->update($request->all());
        session()->flash('username_changed','Username u ndryshua me sukses.');
        return redirect()->route('user.edit', auth()->user()->slug);
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
