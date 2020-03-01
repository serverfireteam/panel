<?php


namespace Serverfireteam\Panel;

use Maatwebsite\Excel\Concerns\FromArray;
use Serverfireteam\Panel\libs\AppHelper;

class EntityExport implements FromArray
{
    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function array(): array
    {
        $appHelper = new libs\AppHelper();
        $className = $appHelper->getModel($this->entity);
        $data      = $className::all()->ToArray();
        $data= json_decode( json_encode($data), true);
        return $data;
    }
}