<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser{
	protected function successResponse($data,$code)
	{
		return response()->json($data,$code);
	}

	protected function errorResponse($message,$code)
	{
		return response()->json(["error"=>$message,"code"=>$code]);
	}

	//return a list of elements of a model
	protected function showAll(Collection $collection,$code=200)
	{
		if($collection->isEmpty())
		{
			return $this->successResponse(["data"=>$collection],$code);
		}
		
		$transformer=$collection->first()->transformer;
		$collection=$this->filterData($collection,$transformer);
		$collection=$this->sortData($collection,$transformer);
		$collection=$this->transformData($collection,$transformer);
		return $this->successResponse(["data"=>$collection],$code);
	}

	//return a single element of a model
	protected function showOne(Model $model,$code=200)
	{
		$transformer=$model->transformer;
		$model=$this->transformData($model,$transformer);
		return $this->successResponse(["data"=>$model],$code);
	}

	protected function sortData(Collection $collection,$transformer)
	{
		if(request()->has('sort_by'))
		{
			$attribute=$transformer::originalAttribute(request()->sort_by);
			$collection=$collection->sortBy($attribute);
		}
		return $collection;
	}

	protected function filterData(Collection $collection,$transformer)
	{
		foreach(request()->query() as $query=>$value )
		{
			$attribute=$transformer::originalAttribute($query);
			if(isset($attribute,$value)){
				$collection=$collection->where($attribute,$value);
			}
		}
		return $collection;
	}

	protected function transformData($data,$transformer)
	{
		return fractal($data, new $transformer)->toArray();
	
	}
}
?>