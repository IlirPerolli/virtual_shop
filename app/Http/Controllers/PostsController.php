<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Photo;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class PostsController extends Controller
{
    public function index(){

    }
    public function create()
    {
        $categories = Category::orderBy('id', 'ASC')->get();
        $cities = City::orderBy('name','asc')->get();
        return view('posts.create', compact('categories', 'cities'));
    }
    public function store(Request $request)
    {

        $user = Auth::user();

        $input = $request->all();
        $request->validate(['photo_id'=>'required','photo_id.*' => 'image|mimes:jpeg,png,jpg,svg|max:4096',
            'title'=>'required|max:255|min:2',
            'body'=>'required|max:2000|min:2',
            'mobile_number'=>'required|numeric|min:0',
            'price'=>'required|numeric|min:0',
            'category_id' => 'required|integer',
            'city_id' => 'required|integer',
            ]);
        $category = Category::find($request->category_id);
        $city = City::find($request->city_id);
        if (!$category){
            session()->flash('category_error', 'Oops... Kategoria nuk u gjet.');
            return back();
        }
        if (!$city){
            session()->flash('city_error', 'Oops... Qyteti nuk u gjet.');
            return back();
        }

        $images = array();
        $iteration = 0;
        if ($files = $request->file('photo_id')){

            foreach ($files as $file) {
                $iteration++;//per mi bo resize veq foton e par
                if (strpos($file->getClientOriginalName(),'chat') !== false) {
                    $file_name = $file->getClientOriginalName();
                    $name = time().str_replace("chat",$user->username,$file_name); //Per shkak te serverit qe se perkrah fjalen chat
                }
                else{
                    $name = time() . $file->getClientOriginalName();
                }

                if($iteration == 1){
                    $image_resize = Image::make($file->getRealPath());
                    // resize the image so that the largest side fits within the limit; the smaller
// side will be scaled to maintain the original aspect ratio
                    $image_resize->resize(250, 250, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $image_resize->save('images/'.$name);  //ME RESIZE
                    $images[] = $name;  //ME RESIZE
                }

                $name = '1_'.$name; //Ndrysho emrin e files

                $file->move('images', $name);
                $images[] = $name;
            }
            if (count($images)>6){//6 se 1 foto shkon per resize
                session()->flash('max_photos', 'Nuk lejohen më shumë se 5 foto.');
                return back();
            }

            //$upload_url = public_path('/images').'/'.$name;
            //$filename = $this->compress_image($_FILES["photo_id"]["tmp_name"], $upload_url, 40);
            $photo = Photo::create(['photo'=>implode(",", $images)]);
            $input['photo_id']=$photo->id;
        }
        if($request->body == null){
            $input['slug']= time().Str::random(30);
        }

        $input['user_id']=$user->id;
        $user->posts()->create($input);
        session()->flash('added_post', 'Postimi u krijua me sukses.');
        return back();
    }

    public function show($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        $user = $post->user;
        $followers = $user->followers->count();
        $followings = $user->followings->count();
        $user_posts = $user->posts->count();
        $likes = $post->likes->count();
        $views = $post->views+1;
        $post->update(['views'=>$views]);
        $comments = $post->comments;
        $category = $post->category;
        $posts = Post::where('category_id',$post->category_id)->where('id','<>',$post->id)->take(5)->get();
        return view('posts.show', compact('post','followers' , 'followings','user_posts', 'likes','views', 'comments', 'category', 'posts'));
    }
    public function edit($slug)
    {
        $post = Post::findBySlugOrFail($slug);
        if (auth()->user()->id != $post->user->id){
            abort(403, 'Unauthorized action.');
        }
        $categories = Category::orderBy('id', 'ASC')->get();
        $cities = City::orderBy('name','asc')->get();
        return view('posts.edit', compact('post','categories', 'cities'));
    }
    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id != $post->user->id){
            abort(403, 'Unauthorized action.');
        }
        $category = Category::find($request->category_id);
        $city = City::find($request->city_id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->mobile_number = $request->mobile_number;
        $post->price = $request->price;
        $post->category_id = $request->category_id;
        $post->city_id = $request->city_id;
        $slug = $post->slug;
        $request->validate([ 'title'=>'required|max:255|min:2',
            'body'=>'required|max:2000|min:2',
            'mobile_number'=>'required|numeric|min:0',
            'price'=>'required|numeric|min:0',
            'category_id' => 'required|integer',
            'city_id' => 'required|integer'
            ]);
        if (!$category){
            session()->flash('category_error', 'Oops... Kategoria nuk u gjet.');
            return back();
        }
        if (!$city){
            session()->flash('city_error', 'Oops... Qyteti nuk u gjet.');
            return back();
        }
        if($post->isDirty('title') || $post->isDirty('body') || $post->isDirty('price') || $post->isDirty('category_id') || $post->isDirty('city_id') || $post->isDirty('mobile_number') ){
            if($request->title == null){
               $slug = $post->slug = time().Str::random(30);
            }
            else if ($post->isDirty('title')){
                $slug = SlugService::createSlug(Post::class, 'slug', $post->title);
            }

            session()->flash('post_updated', 'Postimi u ndryshua me sukses');
            $post->save();
            return redirect()->route('post.edit',$slug);
        }
        else{
            session()->flash('nothing_updated', 'Asgjë nuk u ndryshua.');

        }
        return back();

    }
    public function destroy(Post $post)
    {
        if (auth()->user()->id != $post->user_id){
            abort(403, 'Unauthorized action.');
        }
        if ($post->photo){
            if (strpos($post->photo->photo,',') !== false){
                foreach(explode(',',$post->photo->photo) as $photo){
                    if (file_exists(public_path()."/images/".$photo)){//kontrollo nese ekziston foto ne storage para se te fshihet
                    unlink(public_path()."/images/".$photo);
                }
                }

            }
            else {
                if (file_exists(public_path() . "/images/" . $post->photo->photo)) {//kontrollo nese ekziston foto ne storage para se te fshihet
                    unlink(public_path() . $post->photo->photo);
                }
            }


        }
        $post->delete();
        session()->flash('deleted_post', 'Postimi u fshi me sukses.');
        return redirect()->route('user.show',auth()->user()->slug);
    }
//    public  function compress_image($source_url, $destination_url, $quality) {
//        $info = getimagesize($source_url);
//        if ($info['mime'] == 'image/jpeg')
//            $image = imagecreatefromjpeg($source_url);
//        elseif ($info['mime'] == 'image/gif')
//            $image = imagecreatefromgif($source_url);
//        elseif ($info['mime'] == 'image/png')
//            $image = imagecreatefrompng($source_url);
//        imagejpeg($image, $destination_url, $quality);
//        return $destination_url;
//    }
        //Nese deshirojme te kompresojme filet e kemi kete mundesi prej ketij funksioni



//$image_resize = Image::make($file->getRealPath());
//$image_resize->resize(300, 300);
//$image_resize->save('images/'.$name);
//$images[] = $name; ME RESIZE
}
