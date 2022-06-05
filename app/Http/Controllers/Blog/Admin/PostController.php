<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostUpdateRequest;
use App\Services\BlogCategoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\BlogPostService;
use Illuminate\Support\Str;

class PostController extends BaseAdminController
{
    /**
     * @var \App\Services\BlogPostService
     */
    private BlogPostService $postService;
    
    /**
     * PostController constructor.
     *
     * @param   \App\Services\BlogPostService  $postService
     * @param   \App\Services\BlogCategoryService $categoryService
     */
    public function __construct(BlogPostService $postService, BlogCategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $paginator = BlogPostService::getAllWithPaginate(25);
        $paginator = $this->postService->getAllWithPaginate(25);
        
        return view('blog.admin.posts.index', [
            'paginator' => $paginator,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
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
        $item = $this->postService->getEdit($id);
        if (empty($item)) {
            abort(404);
        }
        
        $categoryList = $this->categoryService->getForComboBox();
        
        return view('blog.admin.posts.edit', [
            'item'          => $item,
            'category_list' => $categoryList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
//        dd(__METHOD__, $id, request()->all());
        $item = $this->postService->getEdit($id);
        
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => 'POst id=[{$id}] not found'])
                ->withInput();
        }
        
        $data = $request->all();
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
    
        if (empty($item->published_at) && $data['is_published']) {
            $data['published_at'] = Carbon::now();
        }
        
        $result = $item->update($data);
        
        if ($result) {
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Success save']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save Error'])
                ->withInput();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__, $id, request()->all());
    }
}
