<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;        
    }

    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        $path = 'admin/uploads/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $category::delete();
        session()->flash('message','CAtegory Deleted successfully.');

    }
    
    public function render()
    {
        
        $categories = Category::orderBy('id','DESC')->paginate(4);
        return view('livewire.admin.category.index', ['categories'=>$categories]);
    }

    
}
