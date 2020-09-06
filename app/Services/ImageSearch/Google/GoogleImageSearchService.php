<?php

declare(strict_types=1);

namespace App\Services\ImageSearch\Google;

use App\Services\ImageSearch\Cache\CacheSearchResultService;
use App\Services\ImageSearch\ImageSearchService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

/**
 * Class GoogleImageSearchService
 * @package App\Services\ImageSearch\Google
 */
class GoogleImageSearchService implements ImageSearchService
{
    /**
     * Google Custom Search engine ID
     *
     * @var string
     */
    private $engineId;

    /**
     * Google Custom Search API key
     *
     * @var string
     */
    private $apiKey;

    /**
     * The search url
     *
     * @var string
     */
    private $url;

    /**
     * The search query
     *
     * @var string
     */
    private $query = '';

    /**
     * The list of found images urls
     *
     * @var array
     */
    private $images = [];

    /**
     * The raw searching result from Google
     *
     * @var object
     */
    private $rawResult;

    /**
     * @var CacheSearchResultService
     */
    private $cacheService;

    /**
     * @param string $engineId
     * @param string $apiKey
     * @param string $baseUrl
     * @param CacheSearchResultService $cacheService
     */
    public function __construct(string $engineId, string $apiKey, string $baseUrl, CacheSearchResultService $cacheService)
    {
        $this->setEngineId($engineId);
        $this->setApiKey($apiKey);
        $this->url = "{$baseUrl}&cx={$this->engineId}&key={$this->apiKey}";
        $this->cacheService = $cacheService;
    }

    /**
     * Set the Search engine ID, overrides the value from config
     *
     * @param $engineId
     * @return $this
     */
    public function setEngineId(string $engineId): ImageSearchService
    {
        $this->engineId = $engineId;

        return $this;
    }

    /**
     * Set the API key, overrides the value from config
     *
     * @param $apiKey
     * @return $this
     */
    public function setApiKey(string $apiKey): ImageSearchService
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Set the search query
     *
     * @param string $query
     * @return $this
     */
    public function setQuery(string $query): ImageSearchService
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Set options for the search request
     *
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): ImageSearchService
    {
        $this->setQuery($options['query'] ?? '');
        if ($options['cache'] !== null) {
            $this->cacheService->setEnabled(!!$options['cache']);
        }

        return $this;
    }

    /**
     * Search images on Internet for a given query
     *
     * @param string $query
     * @return $this
     * @throws GoogleImageSearchException
     */
    public function search(string $query = ''): ImageSearchService
    {
        if ($query) {
            $this->setQuery($query);
        }

        if ($dataFromCache = $this->cacheService->get($this->query)) {
            $this->images = $dataFromCache;

            return $this;
        }

        $response = Http::get("{$this->url}&q={$this->query}");
        $this->rawResult = $response->object();

        if ($response->failed()) {
            throw new GoogleImageSearchException($response->status(), $response->json());
        }

        return $this->setImages();
    }

    /**
     * Get found images
     *
     * @return array
     */
    public function get(): array
    {
        return $this->images;
    }

    /**
     * Get the random image url from a list of previously found on Internet
     *
     * @return string|null
     */
    public function getRandom(): ?string
    {
        if (!count($this->images)) {
            return null;
        }
        return Arr::random($this->images);
    }

    private function setImages(): ImageSearchService
    {
        $this->images = Arr::pluck($this->rawResult->items, 'link');
        $this->cacheService->set($this->query, $this->images);

        return $this;
    }
}
