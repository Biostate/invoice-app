<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

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
        Response::macro('apiResponse', function (string $message = '', $error = [], $data = null, bool $status = true, int $code = 200) {
            return response()->json([
                'message' => $message,
                'data' => $data,
                'errors' => $error,
                'status' => $status,
            ], $code);
        });

        $this->app->bind(\App\Services\InvoiceServiceInterface::class, \App\Services\InvoiceService::class);
    }
}
