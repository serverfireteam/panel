<?php

namespace Serverfireteam\Panel;

class AdminObserver
{
    public function created(Admin $admin)
    {
        $admin->assignRole('admin');
        $admin->save();
    }
}
