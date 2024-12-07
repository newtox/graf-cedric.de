<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ModifyTablarMenu
{
    public function handle(Request $request, Closure $next)
    {
        $menu = [
            [
                'text' => __('menu.dashboard'),
                'url' => route('home'),
                'icon' => 'ti ti-home',
                'active' => request()->routeIs('home')
            ],
            [
                'text' => __('menu.about'),
                'url' => route('about'),
                'icon' => 'ti ti-user',
                'active' => request()->routeIs('about')
            ],
            [
                'text' => __('menu.public_games'),
                'url' => route('games.index'),
                'icon' => 'ti ti-device-gamepad-2',
                'active' => request()->routeIs('games.*')
            ]
        ];

        if ($request->user()) {
            if ($request->user()->hasRole('Admin')) {
                if ($request->user()->can('view games')) {
                    $menu[] = [
                        'text' => __('menu.games_management'),
                        'url' => route('admin.games.index'),
                        'icon' => 'ti ti-device-gamepad',
                        'active' => request()->routeIs('admin.games.*')
                    ];
                }

                if ($request->user()->can('view tags')) {
                    $menu[] = [
                        'text' => __('menu.tags_management'),
                        'url' => route('admin.tags.index'),
                        'icon' => 'ti ti-tags',
                        'active' => request()->routeIs('admin.tags.*')
                    ];
                }

                if ($request->user()->can('view users')) {
                    $menu[] = [
                        'text' => __('menu.users_management'),
                        'url' => route('admin.users.index'),
                        'icon' => 'ti ti-users',
                        'active' => request()->routeIs('admin.users.*')
                    ];
                }
            }
        }

        Config::set([
            'tablar.bottom_title' => 'Newtox',
            'tablar.current_version' => 'v1.0 beta',
            'tablar.layout' => 'condensed',
            'tablar.menu' => $menu
        ]);

        return $next($request);
    }
}
