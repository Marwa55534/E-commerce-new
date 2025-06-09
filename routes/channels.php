<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('admins.{id}', function ($admin, $id) {
    return (int) $admin->id === (int) $id;
} , ['guards'=>['admin'],]);

// Broadcast::channel('admins.{adminId}', function ($user, $adminId) {
//     return (int) $user->id === (int) $adminId && $user instanceof \App\Models\Admin;
// });

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
