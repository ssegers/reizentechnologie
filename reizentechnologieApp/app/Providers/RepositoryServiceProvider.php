<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\EloquentUser;

use App\Repositories\Contracts\TravellerRepository;
use App\Repositories\Eloquent\EloquentTraveller;

use App\Repositories\Contracts\TripRepository;
use App\Repositories\Eloquent\EloquentTrip;

use App\Repositories\Contracts\StudieRepository;
use App\Repositories\Eloquent\EloquentStudie;

use App\Repositories\Contracts\CityRepository;
use App\Repositories\Eloquent\EloquentCity;

use App\Repositories\Contracts\PageRepository;
use App\Repositories\Eloquent\EloquentPage;

use App\Repositories\Contracts\PaymentRepository;
use App\Repositories\Eloquent\EloquentPayment;

use App\Repositories\Contracts\AccomodationRepository;
use App\Repositories\Eloquent\EloquentAccomodation;
/**
 * Description of RepositoryServiceProvider
 *
 * @author u0067341
 */

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(TravellerRepository::class, EloquentTraveller::class);
        $this->app->singleton(TripRepository::class, EloquentTrip::class);
        $this->app->singleton(StudieRepository::class, EloquentStudie::class);
        $this->app->singleton(CityRepository::class, EloquentCity::class);
        $this->app->singleton(PageRepository::class, EloquentPage::class);
        $this->app->singleton(PaymentRepository::class, EloquentPayment::class);
        $this->app->singleton(AccomodationRepository::class, EloquentAccomodation::class);        
    }
}