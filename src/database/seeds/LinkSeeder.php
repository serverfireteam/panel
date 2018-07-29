<?php

namespace Serverfireteam\Panel\Database\Seeders;

use Serverfireteam\Panel\Link;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{

    public function run()
    {
        $links = [
            [
                'display' => 'Links',
                'url' =>  'Link'
            ]
        ];

        if ($this->command->confirm('Include user management in panel?')) {
            $links = array_merge(
                $links,
                [
                    [
                        'display' => 'Roles',
                        'url' => 'Role',
                    ],
                    [
                        'display' => 'Permissions',
                        'url' => 'Permission',
                    ],
                    [
                        'display' => 'Users',
                        'url' => 'User'
                    ]
                ]
            );
        }

        foreach ($links as $linkData) {
            $link = Link::firstOrNew(['url' => $linkData['url']]);
            $link->fill($linkData);
            $link->main = true;
            $link->show_menu = true;
            $link->save();
        }
    }
}
