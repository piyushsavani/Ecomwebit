<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use App\Models\Admin\Brand;
use App\Models\admin\Color;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Validator;
use App\Http\Requests\Admin\ProductFormValidation;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();        
        return view('layouts.admin.product.index', compact('products'));
    }
    public function create()
    {
        $cagtegories = Category::all();
        $colors = Color::all();
        $brands = Brand::all();
        return view('layouts.admin.product.create', compact('cagtegories','colors','brands'));
    }
    public function insert(ProductFormValidation $request)
    {
        $req =$request->validated();       

         // we have to use this method due to relationship betwin category and product

        $category = Category::findOrFail($req['category_id']);       
        $product = $category->products()->create([
            'category_id' => $req['category_id'],
            'product_name' => $req['product_name'],  
            'brand' => $req['brand'],         
            'selling_price' => $req['selling_price'],
            'qauntity' => $req['qauntity'],
            'product_slug' =>Str::slug($req['product_slug']),
            'description' =>$req['description'],
            'meta_title' =>$req['meta_title'],
            'meta_keyword' =>$req['meta_keyword'],
            'meta_description' =>$req['meta_description'],
            'status' =>$request->status == true ? '1':'0',
            'trending' =>$request->trending == true ? '1':'0',
            'image' =>$request['image']

        ]);   
        
        if ($request->hasFile('image')) 
        {  
            $path = 'admin/uploads/product/';
            $i = 1;
            foreach($request->file('image') as $imageFile)
            {         
            $ext = $imageFile->getClientOriginalExtension();
            $filename = time().$i++.'.'.$ext;
            $imageFile->move($path,$filename);
            $finalImageNamePath = $path.$filename;

            $product->productImages()->create([
                'product_id' => '$product->id',
                'image' => $finalImageNamePath
            ]);
    
            $product->save();
            
        }
                
        }  
        
        if($request->colors){
            
            foreach($request->colors as $key => $color) {
                $product->ProductColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
                
            }
        }
        return redirect('admin/products')->with('message','Product added successfully');
}
      public function removeImage($img_id)
{
    $proImg = ProductImage::findOrFail($img_id);
    if (File::exists($proImg->image)) {
        File::delete($proImg->image);
    }
    $proImg->delete();
    return redirect()->back()->with('message','Product image deleted successfully');

}

public function destroy($id)
{
    $product = Product::findOrFail($id);
    if($product->productImages()){
        foreach($product->productImages() as $image){
            if(File::exists($image->image)){
                File::delete($image->image);
            }
        }
    }
    $product->delete();

    return redirect()->back();

}

      public function edit(int $product_id)      
{
    $categories = Category::all();
    $product = Product::findOrFail($product_id);
    $brands = Brand::all();    
    $prod_colors = $product->productColors->pluck('color_id')->toArray();
    // So $prod_colors is array of color_id of productColors() or table
    $colors = Color::whereNotIn('id',$prod_colors)->get();
    return view('layouts.admin.product.edit', compact('product','categories','colors','brands'));
}

public function update(ProductFormValidation $request, $product_id)
{
    $req =$request->validated();   
    $product = Category::findOrFail($req['category_id'])
                ->products()->where('id',$product_id)->first();
                
        $product->update([
            'category_id' => $req['category_id'],
            'product_name' => $req['product_name'], 
            'brand' => $req['brand'],         
            'selling_price' => $req['selling_price'],
            'qauntity' => $req['qauntity'],
            'product_slug' =>Str::slug($req['product_slug']),
            'description' =>$req['description'],
            'meta_title' =>$req['meta_title'],
            'meta_keyword' =>$req['meta_keyword'],
            'meta_description' =>$req['meta_description'],
            'status' =>$request->status == true ? '1':'0',
            'trending' =>$request->trending == true ? '1':'0',
            'image' =>$request['image']

        ]);  

        if ($request->hasFile('image')) 
        {  
            $path = 'admin/uploads/product/';
            $i = 1;
            foreach($request->file('image') as $imageFile)
            {         
            $ext = $imageFile->getClientOriginalExtension();
            $filename = time().$i++.'.'.$ext;
            $imageFile->move($path,$filename);
            $finalImageNamePath = $path.$filename;

            $product->productImages()->create([
                'product_id' => '$product->id',
                'image' => $finalImageNamePath
            ]);            
        }         
                
        }    

        if($request->colors){
            
            foreach($request->colors as $key => $color) {
                $product->ProductColors()->update([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0
                ]);
                
            }
        }

        return redirect('admin/products')->with('message','Product updated successfully');
       
}

public function updateProduColorQuantity(Request $req, $prod_color_id)
{
    $prod_color_qty = Product::findOrFail($req->product_id)->productColors()->where('id',$prod_color_id);
    $prod_color_qty->update([
        'quantity' => $req->qty
    ]);

    return response()->json(['message','Quantity updated successfully']);
}
}