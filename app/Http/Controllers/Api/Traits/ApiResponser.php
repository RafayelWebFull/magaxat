<?php

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{

    /**
     * Return a success JSON response.
     *
     * @param array $response
     * @param int|null $status
     * @return JsonResponse
     */
    protected function successResponse(array $response = [], ?int $status = 200):JsonResponse
	{
		return response()->json(array_merge(['success' => true],$response), $status);
	}


    /**
     * Return an error JSON response.
     *
     * @param string $errorMessage
     * @param int $status
     * @return JsonResponse
     */
	protected function errorResponse(string $errorMessage = 'labels.api.notFound', int $status = 404):JsonResponse
	{
		return response()->json(
            __($errorMessage),
            $status
        );
	}
}