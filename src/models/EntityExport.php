<?php


namespace Serverfireteam\Panel;

use Maatwebsite\Excel\Concerns\FromArray;
use Serverfireteam\Panel\libs\AppHelper;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntityExport implements FromArray, WithHeadings
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
    public function headings(): array
    {
        $appHelper = new libs\AppHelper();
        $className = $appHelper->getModel($this->entity);
        $model     = new $className;
        $tablePrefix = \DB::getTablePrefix();
        $table     = $model->getTable();
        $columns   = \Schema::getColumnListing($table);
        return (array)$columns;
    }
}