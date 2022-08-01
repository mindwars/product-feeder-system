<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\NotAcceptableException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Services\FeedService;

class ProductFeedController extends Controller
{
    /**
     * @param $params
     * @throws NotFoundException|NotAcceptableException
     */
    public function export($params)
    {
        $receiverServiceClass = 'App\\Factories\\' . ucfirst($params->receiver) . 'ExporterFactory';
        if (!class_exists($receiverServiceClass)) {
            throw new NotFoundException('Receiver Service Class not found', 404);
        }

        $feedService = new FeedService();
        $result = $feedService->export(new $receiverServiceClass());

        $this->responseSuccess($result);
    }
}