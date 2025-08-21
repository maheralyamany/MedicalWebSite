<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\Navbar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Paginator::defaultView('pagination.bootstrap-4');
        //Paginator::useBootstrap();
       Schema::defaultStringLength(191);
        //
        View::composer('*', function($view)
        {
            // $navbars = Navbar::orderBy('ordering')->select('id','name', DB::raw("CONCAT('". url(app()->getLocale()) ."/', route) AS route"),'icon')->get();
           // $navbars = Navbar::orderBy('ordering')->get();
            $view->with('navbars', sidebar_list());
        });
    }
}
