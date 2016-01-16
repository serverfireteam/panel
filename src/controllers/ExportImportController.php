<?php

namespace Serverfireteam\Panel;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class ExportImportController extends Controller {

    protected $failed = false;

    public function export($entity, $fileType) {

        $appHelper = new libs\AppHelper();
        
	$className = $appHelper->getNameSpace() . $entity;
	$data      = $className::get();
	if (strcmp($fileType, "excel") == 0) {
		$excel = \App::make('Excel');
		\Excel::create($entity, function($excel) use ($data) {
			$excel->sheet('Sheet1', function($sheet) use ($data) {
				$sheet->fromModel($data);
			});
		})->export('xls');
	}
    }

    public function import($entity) {

        $appHelper = new libs\AppHelper();
        
	$className = $appHelper->getNameSpace() . $entity;
	$model     = new $className;
	$table     = $model->getTable();
	$columns   = \Schema::getColumnListing($table);
	$key	   = $model->getKeyName();

	$notNullColumnNames = array();
	$notNullColumnsList = \DB::select(\DB::raw("SHOW COLUMNS FROM `" . $table . "` where `Null` = 'no'"));
	if (!empty($notNullColumnsList)) {
		foreach ($notNullColumnsList as $notNullColumn) {
			$notNullColumnNames[] = $notNullColumn->Field;
		}
	}

	$status = Input::get('status');

	$filePath = null;
	if (Input::hasFile('import_file') && Input::file('import_file')->isValid()) {
		$filePath = Input::file('import_file')->getRealPath();
	}

	if ($filePath) {

		\Excel::load($filePath, function($reader) use ($model, $columns, $key, $status, $notNullColumnNames) {
			$this->importDataToDB($reader, $model, $columns, $key, $status, $notNullColumnNames);
		});
	}

	$importMessage = ($this->failed == true) ? \Lang::get('panel::fields.importDataFailure') : \Lang::get('panel::fields.importDataSuccess');

	return \Redirect::to('panel/' . $entity . '/all')->with('import_message', $importMessage);
    }

    public function importDataToDB($reader, $model, $columns, $key, $status, $notNullColumnNames) {

	$rows        = $reader->toArray();
	$newData     = array();
	$updatedData = array();

	// Check validation of values
	foreach ($rows as $row) {
		foreach ($notNullColumnNames as $notNullColumn) {
			if (!isset($row[$notNullColumn])) {
				$this->failed = true;
				break;
			}
		}
	}

	if (!$this->failed) {
		if ($status == 1) {
			$model->truncate();
		}
		foreach ($rows as $row) {
			if (!empty($row[$key])) {
				$exists = $model->where($key, '=', $row[$key])->count();
				if (!$exists) {
					$values = array();
					foreach ($columns as $col) {
						if ($col != $key) {
							$values[$col] = $row[$col];
						}
					}
					$newData[] = $values;
				} else if ($status == 2 && $exists) {
					$values = array();
					foreach ($columns as $col) {
						$values[$col] = $row[$col];
					}
					$updatedData[] = $values;
				}
			}
		}
	}

	// insert data into table
	if (!empty($newData)) {
		$model->insert($newData);
	}

	// update available data
	if (!empty($updatedData)) {
		foreach ($updatedData as $data) {
			$keyValue = $data[$key];
			unset($data[$key]);
			$model->where($key, $keyValue)->update($data);
		}
	}
    }
}
