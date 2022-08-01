<?php

use App\Http\Controllers\Api\ProductFeedController;

$this->route->get('/api/feed/{receiver}', [ProductFeedController::class, 'export']);
