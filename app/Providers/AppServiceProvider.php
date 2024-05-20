<?php

namespace App\Providers;

use App\Models\Facility;
use App\Models\FacilityCategory;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale('id');

        View::composer(['users.index', 'users.create', 'users.show', 'users.edit'], function ($view) {
            $view->with('pageTitle', 'User');
        });
        View::composer(['satker_masters.index', 'satker_masters.create', 'satker_masters.show', 'satker_masters.edit'], function ($view) {
            $view->with('pageTitle', 'Satuan Kerja (Eselon I)');
        });
        View::composer(['uker_masters.index', 'uker_masters.create', 'uker_masters.show', 'uker_masters.edit'], function ($view) {
            $view->with('pageTitle', 'Unit Kerja (Eselon II)');
        });
        View::composer(['role_masters.index', 'role_masters.create', 'role_masters.show', 'role_masters.edit'], function ($view) {
            $view->with('pageTitle', 'Role');
        });
        View::composer(['facilities.index', 'facilities.create', 'facilities.show', 'facilities.edit'], function ($view) {
            $view->with('pageTitle', 'Facility');
        });
        View::composer(['facility_categories.index', 'facility_categories.create', 'facility_categories.show', 'facility_categories.edit'], function ($view) {
            $view->with('pageTitle', 'Facility Category');
        });
        View::composer(['reservations.index', 'reservations.create', 'reservations.show', 'reservations.edit','reservations.verify'], function ($view) {
            $view->with('pageTitle', 'Reservation');
        });

        View::composer(['addons.index', 'addons.create', 'addons.show', 'addons.edit'], function ($view) {
            $view->with('pageTitle', 'Addon');
        });

        Paginator::useBootstrap();

        // $navItems = FacilityCategory::all();
        // View::share('navItems', $navItems);

    }
}