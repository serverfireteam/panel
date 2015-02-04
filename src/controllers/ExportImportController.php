<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Serverfireteam\Panel;

class ExportImportController extends \Controller {

    public function export($entity, $fileType) {

	$data = $entity::get();
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

	$model   = new $entity;
	$table   = $model->getTable();
	$columns = \Schema::getColumnListing($table);
	$key	 = $model->getKeyName();

	$status = \Input::get('status');

	$filePath = null;
	if (\Input::hasFile('import_file') && \Input::file('import_file')->isValid()) {
		$filePath = \Input::file('import_file')->getRealPath();
	}

	if ($filePath) {

		if ($status == 1) {
			$model->truncate();
		}

		\Excel::load($filePath, function($reader) use ($model, $columns, $key, $status) {
			$rows        = $reader->toArray();
			$newData     = array();
			$updatedData = array();
			foreach ($rows as $row) {
				if (!empty($row[$key])) {
					$exists = $model->where($key, '=', $row[$key])->count();
					if ($status != 2 && !$exists) {
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
		});
	}

	return \Redirect::to('panel/' . $entity . '/all')->with('import_message', \Lang::get('panel::fields.importDataSuccess'));
    }
}
