<?php

namespace App\Http\Controllers\Api\V1;

use App\Blog;
use App\Filters\BlogFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaveBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Resources\BlogCollection;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * BlogsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }

    /**
     * @param BlogFilter $filter
     * @return BlogCollection
     */
    public function index(BlogFilter $filter)
    {
        $blogs = Blog::filter($filter)->paginate(request('per_page'));

        return new BlogCollection($blogs);
    }

    public function show(Blog $blog)
    {
        return response(compact('blog'));
    }

    /**
     * @param SaveBlogRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(SaveBlogRequest $request)
    {
        $request->merge(['user_id' => auth()->user()->id]);

        $blog = Blog::create($request->all());

        $blog->load('author');

        return response(compact('blog'));
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $request->merge(['user_id' => auth()->user()->id]);

        $blog->update($request->all());

        return response(compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        $blog->delete();
    }

    public function saveImportedBlogs(Request $request)
    {
        foreach ($request->all() as $key => $post) {
            $post['user_id'] = auth()->user()->id;
            $post['created_at'] = $post['publication_date'];

            $post['body'] = json_encode(['ops' => [
                ['insert' => $post['description']],
            ]]);
            Blog::create($post);
        }

        return response(compact('blog'));
    }
}
