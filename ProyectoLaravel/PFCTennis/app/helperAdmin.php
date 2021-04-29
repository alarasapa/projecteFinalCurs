<?php

    use Illuminate\Pagination\Paginator;
    use Illuminate\Support\Collection;
    use Illuminate\Pagination\LengthAwarePaginator;

    function rutaActual($ruta){
    return request()->is($ruta) ? 'active' : '';
    }

    function isAdmin(){
        return Auth::user()->rol == 'A';
    }

    function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }