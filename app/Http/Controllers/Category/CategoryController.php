<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoriesStoreRequest;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return $this->showAll($categories);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesStoreRequest $request)
    {
        
        $category=Category::create($request->all());
        return $this->showOne($category,201);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->showOne($category);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
       $category->fill($request->only('name','description'));
       if(!$category->isDirty())
       {
            return $this->errorResponse("You need to specify a different value to update",422);
       }
       $category->save();
        return $this->showOne($category,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
