<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

trait RestfulApiServiceControllerTrait
{
    use ResponseTrait;

    public function __construct()
    {
        $this->apiService;
    }

    public function index(Request $request)
    {
        try {
            return $this->apiService->index($request->all());
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        try {
            return $this->apiService->store($request->all());
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            return $this->apiService->update($request->all(), $id);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        try {
            return $this->apiService->delete($id);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function restore($id)
    {
        try {
            return $this->apiService->restore($id);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function onlyTrashed(Request $request)
    {
        try {
            return $this->apiService->onlyTrashed($request->all());
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function forceDelete($id)
    {
        try {
            return $this->apiService->forceDelete($id);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}