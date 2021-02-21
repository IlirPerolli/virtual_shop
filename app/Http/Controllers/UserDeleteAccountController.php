<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDeleteAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDeleteAccountController extends Controller
{
    public function index(){
        $user = auth()->user();
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        return view('user.delete_account', compact('user','followers','followings','user_posts'));
    }
    public function destroy(UserDeleteAccountRequest $request)
    {
        $user = auth()->user();
        $current_password = auth()->user()->password;

        if(Hash::check($request->current_password, $current_password))
        {
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
        else
        {
            session()->flash('invalid-current-password', 'Fjalëkalimi i tanishëm është gabim.');
            return back();
        }




    }
}
