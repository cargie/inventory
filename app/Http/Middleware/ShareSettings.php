<?php

namespace App\Http\Middleware;

use App\Classes\ViewSettingsBag;
use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ShareSettings
{

    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;
    protected $settingsRepository;

    /**
     * Create a new error binder instance.
     *
     * @param  \Illuminate\Contracts\View\Factory  $view
     * @return void
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->view->share(
            'settings', new ViewSettingsBag
        );

        return $next($request);
    }
}
