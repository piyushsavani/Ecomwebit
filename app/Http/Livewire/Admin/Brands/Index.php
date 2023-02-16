<?php

namespace App\Http\Livewire\Admin\Brands;

use Livewire\Component;
use App\Models\Admin\Brand;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $pagination = 'bootstrap';
    public $name, $slug, $status;



    public function rule()
    {
        return [           
            'name' => 'required|string',
            'slug' => 'required|string',
        ];
    }

    public function resteInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
    }

    public function saveBrand()
    {
        
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
        ]);
        session()->flash('message','Brand added successfully');
        $this->despatchBrowserEvent('close-modal');
        $this->resteInput();

    }
    public function render()
    {
        $brands= Brand::orderBy('id','DESC')->paginate(5);
        return view('livewire.admin.brands.index', ['brands'=>$brands])
        ->extends('layouts.admin.dashboard')
        ->section('content');
    }
}
