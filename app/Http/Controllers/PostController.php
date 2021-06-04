<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page, Post $post)
    {
        return view('posts.show', compact('page', 'post'));
    }
}
