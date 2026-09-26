<?php

namespace App\Middleware;

/** Dibuat otomatis oleh RoleController -- hanya role "owner" yang boleh lewat. */
class OwnerOnly extends EnsureRole
{
    protected function roles(): array
    {
        return ['owner'];
    }
}
