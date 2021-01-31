<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
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
    { $categories = Category::orderBy('id', 'ASC')->take(10)->get();
        if(auth()->check()){

            $users_user_may_know = auth()->user()->followings()->pluck('leader_id');
            $user = auth()->user()->id;
            $users_user_may_know->push($user);
            $users_user_may_know = User::whereNotIn('id', $users_user_may_know)->orderBy('name', 'ASC')->take(5)->get();
        }
        else{
            $users_user_may_know = User::orderBy('name', 'ASC')->take(5)->get();
        }
        $input = $request->q;
       // $separated_input = preg_split('/\s+/', $input, -1, PREG_SPLIT_NO_EMPTY);
        $separated_input = preg_split('/(?<=\w)\b\s*[!?.]*/', $input, -1, PREG_SPLIT_NO_EMPTY);

        if ($input!='') {
            if (strlen($input)<=2){
                session()->flash('min_length_input', "Ju lutem jepni nje fjale me te gjate");
                return redirect()->route('search.users');
            }

            //Metoda tani duke i ndare fjalet e fjalise edhe duke kerkuar bazuar ne ato fjale
            $users_by_sentence = User::Where(DB::raw('CONCAT(name, " ", surname)'), 'like', '%' . $input . '%')->orderBy('name','ASC');//kerko me fjali
            $users_by_word = User::where(function ($q) use ($separated_input) {
                foreach ($separated_input as $input) {
                    if (strlen($input)<2){continue;}
                    $q->orWhere('name', 'like', "%{$input}%")
                        ->orWhere('surname', 'like', "%{$input}%")
                        ->orWhere('business_name', 'like', "%{$input}%")
                        ->orWhere('username', 'like', "%{$input}%")
                        ->orWhere('slug', 'like', "%{$input}%")
                        ->orWhere('email', 'like', "%{$input}%")->orderBy('name','ASC');
                }
            });
            $users = $users_by_sentence->union($users_by_word)->paginate(10)->appends(request()->query());
            $users_count = $users->count();

            //Kjo appends per te marrur edhe get requestat tjere ne get metoden
                return view('search.users', compact('users','categories', 'users_user_may_know', 'users_count'));

//                session()->flash('user_not_found', "Nuk u gjet asnjë përdorues");
//                return redirect()->route('search.users');
                return view('search.users', compact('users','categories', 'users_user_may_know', 'users_count'));




        }

        return view('search.users');
    }


    public function posts(Request $request)
    {
        $input = $request->q;
        $city = $request->city;
        $category = $request->category;
        if ($city != ''){
            $city = City::findBySlugOrFail($city);
            $city = $city->id;
        }
        if ($category != ''){
            $category = Category::findBySlugOrFail($category);
            $category = $category->id;
        }




        $allcategories = Category::all();

        $cities = City::orderBy('name','asc')->get();
        $separated_input = preg_split('/(?<=\w)\b\s*[!?.]*/', $input, -1, PREG_SPLIT_NO_EMPTY);
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
          if (strlen($input)<=2){
              session()->flash('min_length_input', "Ju lutem jepni nje fjale me te gjate");
              return redirect()->route('search.posts');
          }
            //METODA E MEPARSHME
//            $posts = Post::where(DB::raw('CONCAT( title, " ", body)'), 'like', '%' . $input . '%')
//                ->orWhere(DB::raw('CONCAT( body, " ", title)'), 'like', '%' . $input . '%')
//                ->orWhere(DB::raw('CONCAT( title, body)'), 'like', '%' . $input . '%')
//                ->orWhere(DB::raw('CONCAT( body, title)'), 'like', '%' . $input . '%')
//                ->orWhere(DB::raw('CONCAT( price)'), 'like', '%' . $input . '%')
//                ->orWhere(DB::raw('CONCAT( mobile_number)'), 'like', '%' . $input . '%')
//                ->orWhere(DB::raw('CONCAT( slug)'), 'like', '%' . $input . '%')
//                ->paginate(10)->appends(request()->query());
            //Metoda tani duke i ndare fjalet e fjalise edhe duke kerkuar bazuar ne ato fjale
            $posts_by_sentence = Post::Where('title', 'like', "%{$input}%")->orderBy('title','ASC');//kerko me fjali
                $posts_by_word = Post::Where(function ($q) use ($separated_input) { //kerko me fjale
                foreach ($separated_input as $input) {
                    if (strlen($input)<2){continue;}
                    $q->orWhere('title', 'like', "%{$input}%")
                        //->orWhere('body', 'like', "%{$input}%")
                        //->orWhere('price', 'like', "%{$input}%")
                        //->orWhere('mobile_number', 'like', "%{$input}%")
                        ->orWhere('slug', 'like', "%{$input}%")->orderBy('title','ASC');

                }
            });
            if ($city !='' && $category != ''){//nese ipet qyteti edhe kategoria atehere kerko
                $posts = $posts_by_sentence->where('city_id', $city)->where('category_id', $category)->union($posts_by_word->where('city_id', $city)->where('category_id', $category))->paginate(10)->appends(request()->query());

            }
            else if ($category != ''){//nese ipet vetem kategoria
                $posts = $posts_by_sentence->where('category_id', $category)->union($posts_by_word->where('category_id', $category))->paginate(10)->appends(request()->query());

            }
            else if ($city != ''){//nese ipet vetem qyteti
                $posts = $posts_by_sentence->where('city_id', $city)->union($posts_by_word->where('city_id', $city))->paginate(10)->appends(request()->query());

            }
            else { //nese ipet veq inputi pa qytet ose kategori
                $posts = $posts_by_sentence->union($posts_by_word)->paginate(10)->appends(request()->query());
            }
            $posts_count = $posts->count();
            //Kjo appends per te marrur edhe get requestat tjere ne get metoden

                return view('search.posts', compact('posts','users', 'categories', 'posts_count', 'cities', 'allcategories'));

        }

        return view('search.posts', compact('users', 'categories', 'cities', 'allcategories'));
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
