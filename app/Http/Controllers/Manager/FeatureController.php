<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Models\Manager\Feature;
use App\Repository\Manager\featureRepo;
use App\Service\JsonResponse;

class FeatureController extends Controller
{
    public function __construct(public featureRepo $featureRepo)
    {
    }

    public function index()
    {
        return $this->featureRepo->index();
    }

    public function store(StoreFeatureRequest $request)
    {
        $this->featureRepo->create($request->only('title', 'body', 'link'));
        return JsonResponse::SuccessResponse('create feature ', 'success');
    }


    public function show($feature)
    {
        return $this->featureRepo->getFindId($feature);
    }

    public function update(UpdateFeatureRequest $request, $feature)
    {
        $this->featureRepo->update($request->only('title', 'body', 'link'), $feature);
        return JsonResponse::SuccessResponse('create feature ', 'success');
    }


    public function destroy($feature)
    {
        $this->featureRepo->delete($feature);
        return JsonResponse::SuccessResponse('create feature ', 'success');
    }

    public function success($id)
    {
        $this->featureRepo->status($id, Feature::STATUS_SUCCESS);
        return JsonResponse::SuccessResponse('success change status', 'success');
    }

    public function reject($id)
    {
        $this->featureRepo->status($id, Feature::STATUS_REJECT);
        return JsonResponse::SuccessResponse('success change status', 'success');
    }

    public function pending($id)
    {
        $this->featureRepo->status($id, Feature::STATUS_PENDING);
        return JsonResponse::SuccessResponse('success change status', 'success');
    }
}
