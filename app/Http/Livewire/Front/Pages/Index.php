<?php

namespace App\Http\Livewire\Front\Pages;

use App\Admin\Category;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    // public function mount()
    // {
    //     alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
    // }

    // protected $listeners = [
    //     'cartOverload',

    // ];


    public function render()
    {
        return view('livewire.front.pages.index', [
            'categorys' => Category::with('image', 'products', 'products.image', 'products.shop')
                ->where('popular', true)->get(),
            'dealCategory' => Category::with(['products' => function ($query) {
                $query->whereHas('adons', function (Builder $query) {
                    $query->where('today_offer', true);
                })->get();
            }])->get()
        ]);
    }

    public function addToCart($productId)
    {
        $this->emit('addToCart', $productId);
    }

    // public function cartOverload()
    // {
    //     $this->alart();
    // }
    // public function alart()
    // {
    //     alert()->success('SuccessAlert', 'Lorem ipsum dolor sit amet.');
    // }
}
