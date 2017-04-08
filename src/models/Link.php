<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {

    protected $fillable = ['url', 'display', 'show_menu'];

    protected $table = 'links';
}