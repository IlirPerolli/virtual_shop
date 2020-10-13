<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name','asc')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name','asc')->get();
        return view ('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|min:2|max:255','photo_id'=>'required|image|mimes:jpeg,png,jpg,svg|max:4096']);
        $input = $request->all();
        if ($file = $request->file('photo_id')){

                $name = time() . $file->getClientOriginalName();
            $upload_url = public_path('/images').'/'.$name;
            $filename = $this->compress_image($_FILES["photo_id"]["tmp_name"], $upload_url, 40);
              //  $file->move('images', $name);

            }

            //$upload_url = public_path('/images').'/'.$name;
            //$filename = $this->compress_image($_FILES["photo_id"]["tmp_name"], $upload_url, 40);
            $photo = Photo::create(['photo'=>$name]);
            $input['photo_id']=$photo->id;

        Category::create($input);
        session()->flash('added_category', 'Kategoria u shtua me sukses.');
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
        if(auth()->check()){

            $users = auth()->user()->followings()->pluck('leader_id');
            $user = auth()->user()->id;
            $users->push($user);
            $users = User::whereNotIn('id', $users)->orderBy('name', 'ASC')->take(5)->get();
        }
        else{
            $users = User::orderBy('name', 'ASC')->take(5)->get();
        }

        $category = Category::findBySlugOrFail($slug);
        $posts = $category->posts()->orderBy('created_at','DESC')->paginate(20);
        $categories = Category::orderBy('name', 'ASC')->take(20)->get();
        return view('categories.show', compact('posts', 'category', 'users', 'categories' ));
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
    public function destroy(Category $category)
    {

      $photo = $category->photo->photo;
      unlink(public_path().$photo);

        $category->delete();
        session()->flash('deleted_category', 'Kategoria u fshi me sukses.');
        return back();
    }
        public  function compress_image($source_url, $destination_url, $quality) {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source_url);
        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }
}
