<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DiggingDeeperController extends Controller
{
    public static function collections()
    {
        $result = [];
        
        /* @var \Illuminate\Database\Eloquent\Collection $eloquentCollection */
        
        $eloquentCollection = BlogPost::withTrashed()->get();
        
//        dd(__METHOD__, $eloquentCollection,$eloquentCollection->toArray());
        
        /* @var \Illuminate\Support\Collection $collection */
    
        $collection = collect($eloquentCollection->toArray());
        
//        dd(get_class($eloquentCollection), get_class($collection), $collection);
        
        $result['first'] = $collection->first();
        $result['last'] = $collection->last();
        
        $result['where']['data'] = $collection
            ->where('category_id',10)
            ->values() //отставил только values, ключи сгенерил
            ->keyBy('id'); // устанавливает key
        
        $result['where']['count'] = $result['where']['data']->count();
        $result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        $result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();
        
        $result['where_first'] = $collection
            ->firstWhere('created_at', '>', '2022-04-01');
        
        // map // базовая переменная не меняется
        $result['map']['all'] = $collection->map(function (array $item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            
            return $newItem;
        });
    
        $result['map']['not_exist'] = $result['map']['all']
            ->where('exists', '=', false)
            ->values();
        
        // базовая переменная меняется
        $collection->transform(function ($item) {
            $newItem = new \stdClass();
            $newItem->item_id = $item['id'];
            $newItem->item_name = $item['title'];
            $newItem->exists = is_null($item['deleted_at']);
            $newItem->created_at = Carbon::parse($item['created_at']);
    
            return $newItem;
        });
    
        $newItem = new \stdClass();
        $newItem->id = 9999;
        
        $newItem2 = new \stdClass();
        $newItem2->id = 8888;
        
        // Добавить в начало коллекции
//        $newItemFirst = $collection->prepend($newItem)->first();
//        $newItemLast = $collection->push($newItem2)->last();
//        $pulledItem = $collection->pull(1); //вырезать 1й
        
        
        // Filter
        $filtered = $collection->filter(function ($item) {
            $byDay = $item->created_at->isFriday();
            $byDate = $item->created_at->day == 1;
            
            $result = $byDay && $byDate;
            
            return $result;
        });
        
        // Sort
        $sortedSimple = collect([5, 3, 1, 2, 4])->sort()->values();
        $sortAsc = $collection->sortBy('created_at');
        $sortDesc = $collection->sortByDesc('item_id');
        
//        dd($sortDesc);
    }
}
