<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;

class PracticeController extends Controller
{

    public function getUsers()
    {
        $users = User::select([
            'id',
            'name',
            'email'
        ])->get();

        return response()->json($users);
    }


    public function collectionIntro()
    {
        $collection = collect(['mridul', 'showrab', null])->map(function(?string $name){
            return strtoupper($name);
        })->reject(function(string $name){
            return empty($name);
        });

        // $my_array   = ['mridul', 'showrab', null];
        // $collection = collect($my_array);
        // $collection = $collection->map(function(?string $name){
        //     return strtoupper($name);
        // });
        // $collection = $collection->reject(function($name){
        //     return empty($name);
        // });

        return response()->json($collection);
    }


    public function collectionMacro()
    {
        $my_array = ['first', 'second'];
        $collection = collect($my_array);

        Collection::macro('myFunction', function(){
            return $this->map(function(string $value){
                return Str::upper($value);
            });
        });

        $strUpper = $collection->myFunction();

        return response()->json([
            'array' => $my_array,
            'collection' => $collection,
            'strUppser' => $strUpper
        ]);
    }


    public function collectionMacroArguments()
    {
        Collection::macro('toLocale', function (string $locale) {
            return $this->map(function (string $value) use ($locale) {
                return Lang::get($value, [], $locale);
            });
        });

        $collection = collect(['first', 'second']);

        $translated = $collection->toLocale('bn');

        return response()->json([
            'translated' => $translated
        ]);
    }


}// End of class
