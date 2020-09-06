<?php

declare(strict_types=1);

namespace App\Services\ImageSearch\Cache;

use Illuminate\Support\Facades\Cache;

class LocalCacheSearchResultService implements CacheSearchResultService
{
    private const QUERY_KEY = 'query';
    private const IMAGES_KEY = 'images';

    /**
     * @var bool
     */
    private $enabled;
    /**
     * @var string
     */
    private $cacheDataKey;
    /**
     * @var int
     */
    private $ttl;

    /**
     * @param bool $enabled
     * @param string $dataKey
     * @param int $ttl
     */
    public function __construct(bool $enabled, string $dataKey, int $ttl)
    {
        $this->enabled = $enabled;
        $this->cacheDataKey = $dataKey;
        $this->ttl = $ttl;
    }

    /**
     * Get the cached data
     *
     * @param string $query
     * @return array|null
     */
    public function get(string $query): ?array
    {
        if (!$this->enabled) {
            return null;
        }

        $cachedData = Cache::get($this->cacheDataKey);

        return $cachedData && $cachedData[self::QUERY_KEY] === $query && count($cachedData[self::IMAGES_KEY])
            ? $cachedData[self::IMAGES_KEY]
            : null;
    }

    /**
     * Set the data to cache if it's enabled
     *
     * @param string $query
     * @param array $data
     * @return $this
     */
    public function set(string $query, array $data): CacheSearchResultService
    {
        if (!$this->enabled) {
            return $this;
        }

        Cache::put(
            $this->cacheDataKey,
            [
                self::QUERY_KEY => $query,
                self::IMAGES_KEY => $data,
            ],
            $this->ttl
        );

        return $this;
    }

    /**
     * Enable or disable cache
     *
     * @param bool $enabled
     * @return $this
     */
    public function setEnabled(bool $enabled): CacheSearchResultService
    {
        $this->enabled = $enabled;

        return $this;
    }
}
