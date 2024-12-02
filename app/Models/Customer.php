<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class customer extends Model
{
    public static function add()
    {
        $sql = "INSERT INTO customers DEFAULT VALUES RETURNING id";

        try {
            $result = DB::select($sql);
            $customerId = $result[0]->id ?? null;
        } catch (\Illuminate\Database\QueryException $e) {
            $customerId = null;
        }

        return $customerId;
    }

    public static function get($customer_id)
    {
        $sql = "SELECT * FROM customers WHERE id = ?";

        try {
            $result = DB::select($sql, [$customer_id]);
        } catch (\Illuminate\Database\QueryException $e) {
            $result = [];
        }

        return $result;
    }
}
