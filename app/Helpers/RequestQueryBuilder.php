<?php


namespace App\Helpers;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

final class RequestQueryBuilder
{
    public static function buildQuery(Builder $query, Request $request)
    : Builder
    {
        foreach($request->all() as $key => $parameter)
        {
            $query->where($key, $parameter);
        }
        return $query;
    }
}