<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersYouMayKnowController extends Controller
{
    public static function users()
    {
        //Show users that current user may know
        if (auth()->check()) {

            $users = auth()->user()->followings()->pluck('leader_id'); //userat qe i ka follow
            $user = auth()->user()->id; //merr id e perdoruesit te kyqur
            $users->push($user); //fute ne varg
            $suggested_users = array();
            $users_taken = 0;//per te zvogeluar kompleksitetin kohor
            foreach ($users as $user) {
                $user = User::find($user);//gjej userin qe useri i kyqur e ka follow
                $users_user_may_know = $user->followings->whereNotIn('id', $users)->pluck('id');
                if (count($users_user_may_know) > 0) {//merr vetem ata perdorues qe kane followersa qe si ka perdoruesi i kyqur
                    $suggested_users[] = $users_user_may_know;//futi ne varg
                    $users_taken++;
                }
                if ($users_taken == 5){
                    break;
                }
            }
            if (count($suggested_users) >=1 && count($suggested_users)>0) {//nese i ka me pak se 5 po me shume 0
                $users_user_may_know = User::Where(function ($q) use ($suggested_users) {
                    foreach ($suggested_users as $users) {
                        $q->OrwhereIn('id', $users);
                    }

                });//atehere merri dhe perziej me te tjeret qe jane random
                $random_users = User::WhereNotIn('id', $users);
                $users = $users_user_may_know->union($random_users)->take(5)->get();
                return $users;
            }
            else{//nese nuk e ka asnje follow tregoja random
                $users = User::whereNotIn('id',$users)->take(5)->get();
                return $users;
            }
        } else {
            return $users = User::orderBy('name', 'ASC')->take(5)->get();
        }
    }
    public static function discover_users(){
        //Show users that current user may know
        if (auth()->check()) {

            $users = auth()->user()->followings()->pluck('leader_id'); //userat qe i ka follow
            $user = auth()->user()->id; //merr id e perdoruesit te kyqur
            $users->push($user); //fute ne varg
            $suggested_users = array();
            $users_taken = 0;//per te zvogeluar kompleksitetin kohor
            foreach ($users as $user) {
                $user = User::find($user);//gjej userin qe useri i kyqur e ka follow
                $users_user_may_know = $user->followings->whereNotIn('id', $users)->pluck('id');
                if (count($users_user_may_know) > 0) {//merr vetem ata perdorues qe kane followersa qe si ka perdoruesi i kyqur
                    $suggested_users[] = $users_user_may_know;//futi ne varg
                    $users_taken++;
                }
            }
            if (count($suggested_users) >=1 && count($suggested_users)>0) {//nese i ka me pak se 5 po me shume 0
                $users_user_may_know = User::Where(function ($q) use ($suggested_users) {
                    foreach ($suggested_users as $users) {
                        $q->OrwhereIn('id', $users);
                    }

                });//atehere merri dhe perziej me te tjeret qe jane random
                $random_users = User::WhereNotIn('id', $users);
                $users = ($users_user_may_know->where('is_business',0))->union($random_users->where('is_business',0))->paginate(20);
                return $users;
            }
            else{//nese nuk e ka asnje follow tregoja random
                $users = User::whereNotIn('id',$users)->where('is_business',0)->paginate(20);
                return $users;
            }
        } else {
            return $users = User::orderBy('name', 'ASC')->where('is_business',0)->paginate(20);
        }
    }
    public static function discover_companies(){
        //Show users that current user may know
        if (auth()->check()) {

            $users = auth()->user()->followings()->pluck('leader_id'); //userat qe i ka follow
            $user = auth()->user()->id; //merr id e perdoruesit te kyqur
            $users->push($user); //fute ne varg
            $suggested_users = array();
            $users_taken = 0;//per te zvogeluar kompleksitetin kohor
            foreach ($users as $user) {
                $user = User::find($user);//gjej userin qe useri i kyqur e ka follow
                $users_user_may_know = $user->followings->whereNotIn('id', $users)->pluck('id');
                if (count($users_user_may_know) > 0) {//merr vetem ata perdorues qe kane followersa qe si ka perdoruesi i kyqur
                    $suggested_users[] = $users_user_may_know;//futi ne varg
                    $users_taken++;
                }
            }
            if (count($suggested_users) >=1 && count($suggested_users)>0) {//nese i ka me pak se 5 po me shume 0
                $users_user_may_know = User::Where(function ($q) use ($suggested_users) {
                    foreach ($suggested_users as $users) {
                        $q->OrwhereIn('id', $users);
                    }

                });//atehere merri dhe perziej me te tjeret qe jane random
                $random_users = User::WhereNotIn('id', $users);
                $users = ($users_user_may_know->where('is_business',1))->union($random_users->where('is_business',1))->paginate(20);
                return $users;
            }
            else{//nese nuk e ka asnje follow tregoja random
                $users = User::whereNotIn('id',$users)->where('is_business',1)->paginate(20);
                return $users;
            }
        } else {
            return $users = User::orderBy('name', 'ASC')->where('is_business',1)->paginate(20);
        }
    }

}
