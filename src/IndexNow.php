<?php

declare(strict_types=1);

namespace  LaravelFreelancerNL\LaravelIndexNow;

use Exception;
use Illuminate\Foundation\Bus\PendingDispatch;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use LaravelFreelancerNL\LaravelIndexNow\Exceptions\KeyFileDirectoryMissing;
use LaravelFreelancerNL\LaravelIndexNow\Exceptions\TooManyUrlsException;
use LaravelFreelancerNL\LaravelIndexNow\Jobs\IndexNowSubmitJob;

class IndexNow
{
    /**
     * @throws KeyFileDirectoryMissing
     */
    public function generateKey(): string
    {
        $prefix = config('index-now.key-location');

        $key = Str::uuid()->toString();

        $filename = $prefix . $key . '.txt';

        if (! file_exists(public_path(dirname($filename)))) {
            throw new KeyFileDirectoryMissing();
        }


        File::put(public_path() . "/" . $filename, $key);

        return $key;
    }

    /**
     * @param string|string[] $url
     * @throws Exception
     */
    public function submit(string|array $url): Response
    {
        if (is_string($url)) {
            return $this->submitUrl($url);
        }

        return $this->submitUrls($url);
    }

    /**
     * @param string|string[] $url
     * @throws Exception
     */
    public function delaySubmission(string|array $url, int $delayInSeconds = null): PendingDispatch
    {
        $delayInSeconds ??= (int) config('index-now.delay');

        return IndexNowSubmitJob::dispatch($url)->delay(now()->addSeconds($delayInSeconds));
    }

    /**
     * @throws Exception
     */
    protected function submitUrl(string $url): Response
    {
        $targetUrl = $this->generateTargetUrl();
        $queryData = $this->getQueryData();
        $queryData['url'] = $url;

        return Http::get($targetUrl, $queryData);
    }

    /**
     * @param string[] $urls
     * @throws TooManyUrlsException
     */
    protected function submitUrls(array $urls): Response
    {
        $targetUrl = $this->generateTargetUrl();
        $queryData = $this->getQueryData();
        $queryData['host'] = config('index-now.host');
        $queryData['urlList'] = $this->prepareUrls($urls);

        return Http::post($targetUrl, $queryData);
    }

    protected function generateTargetUrl(): string
    {
        $searchEngineDomain = config('index-now.search-engine');

        return 'https://' . $searchEngineDomain . '/indexnow';
    }

    /**
     * @return array<string, string>
     */
    protected function getQueryData(): array
    {
        $keyLocation = config('index-now.key-location');

        $queryParameters['key'] = config('index-now.key');
        if (isset($keyLocation) && $keyLocation !== '') {
            $queryParameters['keyLocation'] = $keyLocation;
        }

        return $queryParameters;
    }

    /**
     * @param string[] $urls
     * @throws TooManyUrlsException
     */
    protected function prepareUrls(array $urls): array
    {
        if (count($urls) > 10000) {
            throw new TooManyUrlsException();
        }

        foreach ($urls as $key => $url) {
            $urls[$key] = urlencode($url);
        }

        return $urls;
    }
}
