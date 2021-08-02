<?php
namespace App\Http\Services;

use GuzzleHttp\Client;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;

class ShorUrlService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function makeShortUrl($url)
    {
        try{
            $accessToken = '20f07f91f3303b2f66ab6f61698d977d69b83d64';
            $data = [
                'url' => $url,
            ];
            Log::info("postData",['data' => $data]);
            $response = $this->client->request(
                'POST',
                "https://api.pics.ee/v1/links/?access_token=$accessToken",
                [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode($data)
                ]
            );

            $contents = $response->getBody()->getContents();
            Log::channel('url_shorten')->info("responseData",['data' => $contents]);
            $contents = json_decode($contents);
        }catch(\Throwable $th){
            report($th);
            return $url;
        }


        return $contents->data->picseeUrl;
    }
}