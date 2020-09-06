<?php

declare(strict_types=1);

namespace App\Services\ImageSearch;

interface ImageSearchService
{
    /**
     * Set options for the search request
     *
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options): self;

    /**
     * Search images on Internet for a given query
     *
     * @param string $query
     * @return $this
     * @throws \Exception
     */
    public function search(string $query = ''): self;

    /**
     * Get found images
     *
     * @return array
     */
    public function get(): array;

    /**
     * Get a random image from a list of previously found on Internet
     *
     * @return string|null
     */
    public function getRandom(): ?string;
}
