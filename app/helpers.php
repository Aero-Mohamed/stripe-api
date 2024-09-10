<?php

if (!function_exists('auth_user')) {
    function auth_user(): ?\App\Models\User
    {
        $user = auth()->user();
        if ($user instanceof \App\Models\User) {
            return $user;
        }
        return null;
    }
}
