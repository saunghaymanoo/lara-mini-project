<?php

namespace App\Providers;

use App\Models\SubCategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Blade::if('admin',function(){
            return Auth::user()->role == 'admin';
        });
        Blade::if('author',function(){
            return Auth::user()->role == 'author';
        });
        Paginator::useBootstrapFive();
        View::composer([
            'index','detail','post.create','post.edit'
        ],function($view){
            $view->with('subcategories',SubCategory::latest('id')->get());
        });
    }
}
