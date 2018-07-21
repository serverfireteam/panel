<?php
namespace Serverfireteam\Panel;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AdminScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereNotNull('email');
    }
}
