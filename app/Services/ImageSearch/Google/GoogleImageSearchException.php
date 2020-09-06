<?php

declare(strict_types=1);

namespace App\Services\ImageSearch\Google;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class GoogleImageSearchException extends Exception
{
    /**
     * @var array
     */
    private $rawErrorData = [];

    public function __construct(int $code = 0, array $errorData = [], Throwable $previous = null)
    {
        $message = 'Oops! Something went wrong - the search request error.';
        parent::__construct($message, $code, $previous);

        $this->rawErrorData = $errorData;
        $this->writeInLog();
    }

    public function getRawErrorData(): array
    {
        return $this->rawErrorData;
    }

    private function writeInLog(): void
    {
        Log::error(
            'File ' . $this->getFile() . ' on line ' . $this->getLine() . ' with data: ',
            $this->getRawErrorData()
        );
    }
}
