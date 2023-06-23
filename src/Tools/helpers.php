<?php
if (!function_exists('admin')) {
    function admin(): ?\App\Models\User
    {
        return auth('admin')->user();
    }
}