<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Blog\Admin\BaseAdminController;
use Illuminate\Support\Str;
use App\Services\BlogCategoryService;

class CategoryController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $paginator = BlogCategory::paginate(5);
        $paginator = BlogCategoryService::getAllWithPaginate(5);
        
        return view('blog.admin.categories.index', [
            'items' => $paginator,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        dd(__METHOD__);
        $item = new BlogCategory();
//        $categoryList = BlogCategory::all();
        $categoryList = BlogCategoryService::getForComboBox();
        
        return view('blog.admin.categories.edit',
            [
                'item'          => $item,
                'category_list' => $categoryList,
            ]
        );
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        // create object
//        $item = new BlogCategory($data);
//        $item->save();
    
        $item = (new BlogCategory())->create($data);
        
        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Save success!']);
        } else {
            return back()->withErrors(['msg' => 'Save error'])
            ->withInput(); // for old{}
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param   int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param   int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BlogCategoryService::getEdit($id);
        if (empty($item)) {
            abort(404);
        }
        
        $categoryList = BlogCategoryService::getForComboBox();
//        $item = BlogCategory::findOrFail($id);
//
//        $categoryList = BlogCategory::all();
        
        return view('blog.admin.categories.edit', [
            'item'          => $item,
            'category_list' => $categoryList,
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param   \App\Http\Requests\BlogCategoryUpdateRequest  $request
     * @param   int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
//    public function update(Request $request, $id)
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
//                dd(__METHOD__, $request->all(), $id);
//        $rules = [
//          'title' => 'required|min:5|max:200',
//          'slug' => 'max:200',
//          'description' => 'string|max:500|min:3',
//          'parent_id' => 'required|integer|exists:blog_categories,id'
//        ];
        
//        $validatedData = $this->validate($request, $rules);
//        $validatedData = $request->validate($rules);
//        $validator = \Validator::make($request->all(), $rules);
//        $validatedData[] = $validator->passes();
////        $validatedData[] = $validator->validate();
//        $validatedData[] = $validator->valid();
//        $validatedData[] = $validator->failed();
//        $validatedData[] = $validator->errors();
//        $validatedData[] = $validator->fails();
        
        
//        dd($validatedData);
//        $item = BlogCategory::find($id);
        $item = BlogCategoryService::getEdit($id);
        
        if (!$item) {
            return back()
                ->withErrors(['msg' => 'Запись id=[' . $id . '] не найдена'])
                ->withInput();
        }
        
        $data = $request->all();
        
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $result = $item
            ->fill($data)
            ->save();
        
        if (!$result) {
            return back()
                ->withErrors(['msg' => 'Error save'])
                ->withInput();
        }
        return redirect()
            ->route('blog.admin.categories.edit', $item->id)
            ->with(['success' => 'Успешно сохранено']);
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param   int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
