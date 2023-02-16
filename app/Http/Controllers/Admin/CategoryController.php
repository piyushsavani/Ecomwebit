<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\CategoryFormValidation;

class CategoryController extends Controller
{
    public function index()
    {     
        $categories = Category::all();  
        return view('layouts.admin.category.index', compact('categories'));
    }
    public function create()
    {       
        return view('layouts.admin.category.create');
    }
    public function insert(CategoryFormValidation $request)
    {
        $req =$request->validated();
        $category = new Category;
        $category->name =$req['name'];
        $category->slug =Str::slug($req['slug']);
        $category->description =$req['description'];
        $category->status =$request->status == true ? '1':'0';
        $category->meta_title =$req['meta_title'];
        $category->meta_keyword =$req['meta_keyword'];
        $category->meta_description =$req['meta_description'];
        if ($request->hasFile('image')) 
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('Admin/uploads/category',$filename);
            $category->image = 'Admin/uploads/category/'.$filename;
        }
        $category->save();
        return redirect('admin/category');

    }
    public function edit(Category $category)
    {
        return view('layouts.admin.category.edit', ['category' => $category]);
    }

    public function update(CategoryFormValidation $request, $category)
    {
        $req =$request->validated();
       
        $category = Category::findOrFail($category);
        $category->name =$req['name'];
        $category->slug =Str::slug($req['slug']);
        $category->description =$req['description'];
        $category->status =$request->status == true ? '1':'0';
        $category->meta_title =$req['meta_title'];
        $category->meta_keyword =$req['meta_keyword'];
        $category->meta_description =$req['meta_description'];
        
        $path = '/admin/uploads/category'.$category->image;
        if(File::exists($path))
        {
            File::delete($path);
        }

        if ($request->hasFile('image')) 

        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('Admin/uploads/category',$filename);
            $category->image = 'Admin/uploads/category/'.$filename;
        }
        $category->update();
        return redirect('admin/category')->with('message','Category updated successfully.');

        return view('layouts.admin.category.update', ['category' => $category]);
    }

}
