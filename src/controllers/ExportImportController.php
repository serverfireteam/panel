<?php

namespace Serverfireteam\Panel;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportImportController extends Controller {

    protected $failed = false;

    public function export($entity, $fileType) {
        if (strcmp($fileType, "excel") == 0) {
            $export = new EntityExport($entity);
            return Excel::download($export, $entity.'.xlsx');
        }
        return \Redirect::to('panel/' . $entity . '/all')->with('export_message', "File type is not excel");
    }

    public function import($entity) {

        $status = Request::get('status');

        $filePath = null;
        if (Request::hasFile('import_file') && Request::file('import_file')->isValid()) {
            $pathTemp = Request::file('import_file')->store('temp');
            $filePath = storage_path('app').'/'.$pathTemp;
        }

        if ($filePath)
        {
            $import = new EntityImport($entity, $status);
            Excel::import($import, $filePath);
        }

        $importMessage = ($this->failed == true) ? \Lang::get('panel::fields.importDataFailure') : \Lang::get('panel::fields.importDataSuccess');

        return \Redirect::to('panel/' . $entity . '/all')->with('import_message', $importMessage);
    }

    public function importDataToDB($reader, $model, $columns, $key, $status, $notNullColumnNames) {

	$rows        = $reader->toArray();
	$newData     = array();
	$updatedData = array();

	// Check validation of values
	foreach ($rows as $i => $row) {
		foreach ($notNullColumnNames as $notNullColumn) {
			if (!isset($row[$notNullColumn])) {
				unset($rows[$i]);
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
