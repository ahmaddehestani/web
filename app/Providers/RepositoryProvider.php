<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Cycle\CycleRepository;
use App\Repositories\Cycle\CycleRepositoryInterface;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Plan\PlanRepository;
use App\Repositories\Plan\PlanRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\Service\ServiceRepository;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Ticket\TicketRepository;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Video\VideoRepository;
use App\Repositories\Video\VideoRepositoryInterface;
use Illuminate\Support\ServiceProvider;
class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $repos = [
            TicketRepositoryInterface::class   => TicketRepository::class,
            MessageRepositoryInterface::class  => MessageRepository::class,
            CategoryRepositoryInterface::class => CategoryRepository::class,
            UserRepositoryInterface::class     => UserRepository::class,
            ProductRepositoryInterface::class  => ProductRepository::class,
            PlanRepositoryInterface::class     => PlanRepository::class,
            CycleRepositoryInterface::class    => CycleRepository::class,
            ServiceRepositoryInterface::class  => ServiceRepository::class,
            VideoRepositoryInterface::class    => VideoRepository::class,
            RoleRepositoryInterface::class     => RoleRepository::class,
        ];
        foreach ($repos as $index => $repo) {
            $this->app->bind($index, $repo);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
