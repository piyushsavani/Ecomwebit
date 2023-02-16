<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ColorFormRequest;

class ColorController extends Controller
{
   public function index()
   {
        $colors = Color::all();
        return view('layouts.admin.color.index', compact('colors'));
   }

   public function create()
   {
        return view('layouts.admin.color.create');
   }

   public function insert(ColorFormRequest $request)
   {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1':'0';
        Color::create($validatedData);
        return redirect('admin/colors');
   }
   public function edit($color_id)
   {
        $colors = Color::findOrFail($color_id);
        return view('layouts.admin.color.edit', compact('colors'));
   }
   public function update(ColorFormRequest $request, $color_id)
   {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ? '1':'0';
        Color::findOrFail($color_id)->update($validatedData);
        return redirect('admin/colors')->with('message','Color updated successfully');
   }
   public function destroy($color_id)
   {
        $colors = Color::findOrFail($color_id);
        $colors->delete();
        return redirect('/admin/colors')->with('message','Color deleted successfully');
   }
}
