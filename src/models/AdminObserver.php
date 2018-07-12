<?php

namespace Serverfireteam\Panel;

class AdminObserver
{
    public function creating(Admin $admin)
    {
        \Log::info('new admin');
        $admin->assignRole('admin');
    }
}
