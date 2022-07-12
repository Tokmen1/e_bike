<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\EmployeeListRequest;


class EmployeeController extends Controller
{
    // public function index(EmployeeListRequest $request)
    public function index()
    { 
        $employee = Employee::all();//filter($request->validated())->paginate(5);
        return new EmployeeCollection($employee);
    }

    public function create()
    {
        return [];
    }

    public function store(EmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        return EmployeeResource::make($employee);
    }

    public function show(Employee $employee)
    {
        return EmployeeResource::make($employee->load([]));
    }

    public function edit($id)
    {
        $employee = Employee::where('id', $id)->first();
        return [
            'employee' => EmployeeResource::make($employee->load([]))
        ];
    }

    public function update($id, EmployeeRequest $request)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->update($request->validated());
        return EmployeeResource::make($employee);
    }

    public function delete($id)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->delete();
        return ['deleted' => true];
    }
}
