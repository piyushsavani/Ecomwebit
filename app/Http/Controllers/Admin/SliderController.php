<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders =Slider::all();
        return view('layouts.admin.sliders.index', ['sliders' => $sliders]);
    }

    public function create()
    {
        return view('layouts.admin.sliders.create');
    }

    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;        

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time().'.'.$ext;
            $file->move('admin/uploads/slider',$fileName);
            $finalFilePath ='admin/uploads/slider/'.$fileName;    
            $slider->image = $finalFilePath;  
        }

        $slider->save();
        return redirect('admin/sliders')->with('message','Slider saved successfully');
    }

    public function edit($sliderId)
    {
        $slider = Slider::findOrFail($sliderId);
      return view('layouts.admin.sliders.edit', ['slider' => $slider]);
    }

    public function update(Request $request, int $sliderId)
    {

      $slider = Slider::findOrFail($sliderId);

      if($request->hasFile('image')){
        if(File::exists($slider->image)){
          File::delete($slider->image);
        }
      
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $fileName = time().'.'.$ext;
        $file->move('admin/uploads/slider',$fileName);
        $finalFilePath ='admin/uploads/slider/'.$fileName;    
        $slider->image = $finalFilePath;       
      }    
    
        $slider->update([
          'title' => $request->title,
          'description' => $request->description,
          'image' => $slider->image
        ]);
        return redirect('admin/sliders')->with('message','Slider updated successfully');

    }

    public function delete(int $sliderId) 
    {
        $slider = Slider::findOrFail($sliderId);
        if(File::exists($slider->image)){
          File::delete($slider->image);
        }
        $slider->delete();
        return redirect('admin/sliders')->with('message','Slider deleted successfully');
    }

}