<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Services\ImageSearch\ImageSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageSearchController extends Controller
{
    /**
     * @var ImageSearchService
     */
    private $service;

    /**
     * @param ImageSearchService $service
     */
    public function __construct(ImageSearchService $service)
    {
        $this->service = $service;
    }

    /**
     * Search images on Internet for a given query
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $cacheEnabled = $request->get('cache', null);

        if (!$query) {
            return response()->json(['imageSrc' => null, 'imageRender' => null]);
        }

        try {
            $imageSrc = $this->service->setOptions(['query' => $query, 'cache' => $cacheEnabled])
                ->search()
                ->getRandom();

            $imageRender = $this->getImageRender($imageSrc);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }

        return response()->json(['imageSrc' => $imageSrc, 'imageRender' => $imageRender]);
    }

    /**
     * Get the render of the found image
     *
     * @param string $imageSrc
     * @return string
     * @throws \Throwable
     */
    private function getImageRender(string $imageSrc): string
    {
        return view('blog.partials.content-image', ['imageSrc' => $imageSrc])->render();
    }
}
