<?php

declare(strict_types=1);

namespace App\Services\ImageSearch\Cache;

interface CacheSearchResultService
{
    /**
     * Get the cached data
     *
     * @param string $query
     * @return array|null
     */
    public function get(string $query): ?array;

    /**
     * Set the data to cache if it's enabled
     *
     * @param string $query
     * @param array $data
     * @return $this
     */
    public function set(string $query, array $data): self;

    /**
     * Enable or disable cache
     *
     * @param bool $enabled
     * @return $this
     */
    public function setEnabled(bool $enabled): self;
}
