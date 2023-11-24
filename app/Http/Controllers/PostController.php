<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(User $user){

        return view('dashboard',[
            'user' => $user
        ]);
    }
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request) {
        $this -> validate($request, [
            'titulo' => 'required|max:250',
            'descripcion' => 'required|max:250',

        ]);

        dd($request);

        Post::create([
            'titulo' => $request -> titulo,
            'descripcion' => $request -> descripcion,
            'imagen' => $request -> imagen,
            'user_id' => auth()->user()->id,

            
        ]);

        $request -> user()->post()->create([
                'titulo' => $request-> titulo,   
                'descripcion' => $request-> titulo,   
                'imagen' => $request-> imagen,
                'user_id' => auth()->user()->id
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }

}
