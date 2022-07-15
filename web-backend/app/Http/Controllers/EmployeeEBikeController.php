<?php

namespace App\Http\Controllers;

use App\Models\EmployeeEbike;
use App\Models\Ebike;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeEbikeResource;
use App\Http\Resources\EmployeeEbikeCollection;
use App\Http\Requests\EmployeeEbikeRequest;
use App\Http\Requests\EmployeeEbikeListRequest;

class EmployeeEBikeController extends Controller
{
   public function index(EmployeeEbikeListRequest $request)
   { 
      $search_date_from = $request['search_date_from'] ? $request['search_date_from'] : '2000-01-01';
      $search_date_to = $request['search_date_to'] ? $request['search_date_to'] : '3000-12-12';
      // dd($search_date_from);
      $employeeEbike = EmployeeEbike::where('date_to', '>=', $search_date_from)
         ->Where('date_from', '<=', $search_date_to)
         ->join('e_bike', 'e_bike.id', '=', 'employee_e_bike.e_bike_id')
         ->join('employee', 'employee.id', '=', 'employee_e_bike.employee_id')
         ->get();

      return ['data' => $employeeEbike];
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
