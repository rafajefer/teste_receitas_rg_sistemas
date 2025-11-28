<?php

namespace App\Providers;

use App\Application\UseCases\ListRecipesUseCase;
use App\Application\UseCases\ListRecipesUseCaseInterface;
use App\Domain\Repositories\RecipeRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Services\Hash\HashServiceInterface;
use App\Domain\Services\Token\TokenServiceInterface;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentUserRepository;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentRecipeRepository;
use App\Infrastructure\Services\Hash\LaravelHashService;
use App\Infrastructure\Services\Token\SanctumTokenService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(RecipeRepositoryInterface::class, EloquentRecipeRepository::class);
        $this->app->bind(ListRecipesUseCaseInterface::class, ListRecipesUseCase::class);
        $this->app->bind(HashServiceInterface::class, LaravelHashService::class);
        $this->app->bind(TokenServiceInterface::class, SanctumTokenService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
