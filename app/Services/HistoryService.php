<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

trait HistoryService
{
    /**
     * Get transaction history from table
     * 
     * @param  \Illuminate\Database\Eloquent\Model  $model  An instance of the table model e.g Game()
     * @param  array $possibleFields  Associative Array of all sort parameters
     * @param  int  $page  Page number from the request body
     * @param  int  $limit  Number of items per page
     * @return array
     */
    public static function fetchHistory(Model $model, array $searchParams, $page, $limit = 10)
    {
        $page = $page == '' ? 1 : $page;

        $skip = ($page - 1) * $limit;
        $skip = $skip < 0 ? 0 : $skip;

        $searchableColumns = self::getSearchableColumns($searchParams, $model->getTable());
        $conditions = [];

        foreach ($searchParams as $key => $value) {
            if (in_array($key, $searchableColumns) && $value != '') {
                array_push($conditions, [$key, '=', $value]);
            }
        }

        $queryModel = $model->query();

        // Search the current table
        $queryModel->when(!empty($conditions), function ($q) use ($conditions) {
            return $q->where($conditions);
        });

        if (isset($searchParams['start_date'])) {
            $queryModel->when($searchParams['start_date'] != '', function ($q) use ($searchParams) {
                return $q->whereDate('created_at', '>=', date($searchParams['start_date']));
            });
        }

        if (isset($searchParams['end_date'])) {
            $queryModel->when($searchParams['end_date'] != '', function ($q) use ($searchParams) {
                return $q->whereDate('created_at', '<=', date($searchParams['end_date']));
            });
        }

        // Count the total record before applying offset and limit
        $total = $queryModel->count();

        $history = $queryModel->orderBy('updated_at', 'DESC')->offset($skip)->take($limit)->get();

        $skip = $skip + $limit;

        return [
            "total"        => $total,
            "load_more"    => ($total - ($skip)) <= 0 ? false : true,
            "items"        => $history,
        ];
    }

    /**
     * Allow ONLY columns that exists on the table to be used as search parameters
     * 
     * @param  array  $possibleFields
     * @param  string  $tableName
     * @return array
     */
    private static function getSearchableColumns($possibleFields, $tableName)
    {
        $tableColumns = DB::getSchemaBuilder()->getColumnListing($tableName);

        $allowedColumns = [];

        foreach ($tableColumns as $column) {
            if (isset($possibleFields[$column])) {
                array_push($allowedColumns, $column);
            }
        }

        return $allowedColumns;
    }
}
