<?php

// namespace App\ModelFilters;

// use EloquentFilter\ModelFilter;

// class SowingFilter extends ModelFilter
// {
//     /**
//     * Related Models that have ModelFilters as well as the method on the ModelFilter
//     * As [relationMethod => [input_key1, input_key2]].
//     *
//     * @var array
//     */
//     public $relations = [];
//     protected $orderColumn = 'id';
//     protected $orderDestination = 'desc';

//     public function setup()
//     {
//         $this->order();
//     }

//     public function search($value)
//     {
//         $this->where(function ($query) use ($value) {
//             $query->orWhere('employee_id', 'LIKE', "%$value%");
//             $query->orWhere('e_bike_id', 'LIKE', "%$value%");
//             $query->orWhere('date_from', 'LIKE', "%$value%");
//             $query->orWhere('date_to', 'LIKE', "%$value%");
//         });
//     }

//     // public function startDateSearch($value)
//     // {
//     //     // $endDateSearch = $this->input('endDateSearch');
//     //     // $startDateSearch = $this->input('startDateSearch');
//     //     // $this->where(function ($query) use ($value) {
//     //     //     $query->orWhere('date_from', '>=', $value);
//     //     //     $query->Orwhere('date_to', '<=', $endDateSearch);
//     //         // $query->orWhereBetween('date_from', [$startDateSearch, $endDateSearch]);
//     //         // $query->whereBetween('date_to', [$value.from, $value.to]);
//     //     // });
//     // }

//     protected function order()
//     {
//         if ($this->input('sort_field')) {
//             $this->orderColumn = $this->input('sort_field');
//         }
//         if ($this->input('sort_order')) {
//             $this->orderDestination = $this->input('sort_order');
//         }
//         $this->orderBy($this->orderColumn, $this->orderDestination);
//     }
// }

namespace App\ModelFilters;

use Illuminate\Database\Eloquent\Builder;

trait EmployeeEbikeFilter
{
    /**
     * This is a sample custom query
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param                                       $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected $orderColumn = 'id';
    protected $orderDestination = 'desc';
    
    public function sample_like(Builder $builder, $value)
    {
        return $builder->where('date_from', 'like', '%'.$value.'%');
    }
}
