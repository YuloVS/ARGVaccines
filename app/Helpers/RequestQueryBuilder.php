<?php


namespace App\Helpers;


use Illuminate\Database\Eloquent\Collection;
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

    public static function buildCollection(Collection $collection, Request $request)
    : Collection
    {
        foreach($request->all() as $key => $parameter)
        {
            $collection = $collection->filter(function ($item) use ($key, $parameter) {
                return strtolower(stripAccents(str_replace(" ", "_", $item[$key]))) == strtolower(stripAccents($parameter));
            });
        }
        return $collection;
    }
}