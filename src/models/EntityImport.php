<?php


namespace Serverfireteam\Panel;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Serverfireteam\Panel\libs\AppHelper;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EntityImport implements OnEachRow, WithHeadingRow
{
    protected $entity;
    protected $notNullColumnNames;
    protected $model;
    protected $columns;
    protected $key;
    protected $status;

    public function __construct($entity, $status)
    {
        $this->entity = $entity;
        $appHelper = new libs\AppHelper();

        $className = $appHelper->getModel($entity);
        $model     = new $className;
        $tablePrefix = \DB::getTablePrefix();
        $table     = $model->getTable();
        $columns   = \Schema::getColumnListing($table);
        $key	   = $model->getKeyName();

        $notNullColumnNames = array();
        $notNullColumnsList = \DB::select(\DB::raw("SHOW COLUMNS FROM `" . $tablePrefix.$table . "` where `Null` = 'no'"));
        if (!empty($notNullColumnsList)) {
            foreach ($notNullColumnsList as $notNullColumn) {
                $notNullColumnNames[] = $notNullColumn->Field;
            }
        }
        $this->notNullColumnNames = $notNullColumnNames;
        $this->model = $model;
        $this->columns = $columns;
        $this->key = $key;
        $this->status = $status;

        if ($this->status == 1) {
            $this->model->truncate();
        }
    }

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $newData     = array();
        $updatedData = array();

        foreach ($this->notNullColumnNames as $notNullColumn) {
            if (!isset($row[$notNullColumn])) {
                unset($row);
            }
        }

        if (!empty($row[$this->key])) {
            $exists = $this->model->where($this->key, '=', $row[$this->key])->count();
            if (!$exists) {
                $values = array();
                foreach ($this->columns as $col) {
                    if ($col != $this->key && array_key_exists($col, $row)) {
                        $values[$col] = $row[$col];
                    }
                }
                $newData[] = $values;
            } else if ($this->status == 2 && $exists) {
                $values = array();
                foreach ($this->columns as $col) {
                    if (array_key_exists($col, $row))
                        $values[$col] = $row[$col];
                }
                $updatedData[] = $values;
            }
        }

        // insert data into table
        if (!empty($newData)) {
            $this->model->insert($newData);
        }

        // update available data
        if (!empty($updatedData)) {
            foreach ($updatedData as $data) {
                $keyValue = $data[$this->key];
                unset($data[$this->key]);
                $this->model->where($this->key, $keyValue)->update($data);
            }
        }
    }
}