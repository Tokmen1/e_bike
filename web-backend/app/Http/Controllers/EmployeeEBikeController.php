<?php

namespace App\Http\Controllers;

use App\Models\EmployeeEbike;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeListRequest;

class EmployeeEBikeController extends Controller
{
   public function index()
   { 
      $employeeEbike = EmployeeEbike::all();
      return new EmployeeEbikeCollection($employeeEbike);
   }

   public function create()
   {
      return [];
   }

   public function store(EmployeeEbikeRequest $request)
   {
      $employeeEbike = EmployeeEbike::create($request->validated());
      return EmployeeEbikeResource::make($employeeEbike);
   }

   public function show(EmployeeEbike $employeeEbike)
   {
      return EmployeeEbikeResource::make($employeeEbike->load([]));
   }

   public function edit($id)
   {
      $employeeEbike = EmployeeEbike::where('id', $id)->first();
      return [
         'employeeEbike' => EmployeeEbikeResource::make($employeeEbike->load([]))
      ];
   }

   public function update($id, EmployeeEbikeRequest $request)
   {
      $employeeEbike = EmployeeEbike::where('id', $id)->first();
      $employeeEbike->update($request->validated());
      return EmployeeEbikeResource::make($employeeEbike);
   }

   public function delete($id)
   {
      $employeeEbike = EmployeeEbike::where('id', $id)->first();
      $employeeEbike->delete();
      return ['deleted' => true];
   }
}
