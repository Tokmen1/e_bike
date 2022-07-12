<?php

namespace App\Http\Controllers;

use App\Models\Ebike;
use Illuminate\Http\Request;
use App\Http\Resources\EbikeResource;
use App\Http\Resources\EbikeCollection;
use App\Http\Requests\EbikeRequest;
// use App\Http\Requests\EbikeListRequest;

class EbikeController extends Controller
{
    // public function index(EbikeListRequest $request)
    public function index()
    { 
       $ebike = Ebike::all();
       return new EbikeCollection($ebike);
    }

    public function create()
    {
        return [];
    }

    public function store(EbikeRequest $request)
    {
        $ebike = Ebike::create($request->validated());
        return EbikeResource::make($ebike);
    }

    public function show(Ebike $ebike)
    {
        return EbikeResource::make($ebike->load([]));
    }

    public function edit($id)
    {
        $ebike = Ebike::where('id', $id)->first();
        return [
            'ebike' => EbikeResource::make($ebike->load([]))
        ];
    }

    public function update($id, EbikeRequest $request)
    {
        $ebike = Ebike::where('id', $id)->first();
        $ebike->update($request->validated());
        return EbikeResource::make($ebike);
    }

    public function delete($id)
    {
        $ebike = Ebike::where('id', $id)->first();
        $ebike->delete();
        return ['deleted' => true];
    }
}
