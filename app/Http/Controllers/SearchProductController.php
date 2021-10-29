<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class SearchProductController extends Controller
{
    public function searchProduct(Request $request)
    {
        $uri = $request->query('q');

        return view('c')->with('uri', $uri);
    }

    public function getInfo(Request $request)
    {
        $httpClient = HttpClient::create(['proxy' => 'http://thisismoe:thisismoe1590_country-dz@proxy.iproyal.com:12323']);
        // $httpClient = HttpClient::create();

        $clientForScraping = new Client($httpClient);

        $uri = $request->query('q');
        $locale = $request->query('locale');

        if (!str_contains($uri, 'item')) {
            // Extract link from text
            $uri = $uri.'mohammed';
            $trimmedUri = $this->get_string_between($uri, 'https', 'mohammed');
            $trimmedUri = 'https'.$trimmedUri;

            try {
                $clientForRedirects = new Client();
                $clientForRedirects->request('GET', $trimmedUri);
            } catch (\Throwable $th) {
                throw $th;
            }

            $uri = $clientForRedirects->getHistory()->current()->getUri();
            // // dd($newUri);
            // try {
            //     $itemID = $this->get_string_between($newUri, 'item/', '.html?');
            // } catch (\Throwable $th) {
            //     throw $th;
            // }
            // // if ('ar' == $locale) {
            // //     $workingUri = 'https://ar.aliexpress.com/item/'.$itemID.'.html';
            // // } elseif ('fr' == $locale) {
            // //     $workingUri = 'https://fr.aliexpress.com/item/'.$itemID.'.html';
            // // }

            // $workingUri = 'https://fr.aliexpress.com/item/'.$itemID.'.html';

            // // $newPage = $clientForScraping->request('GET', $workingUri);

            // // $script14 = $newPage->filter('script')->eq(14)->text();

            // // $newPage->filter('script')->each(function ($node, $i = 0) {

            // //     if($i == 14) {
            // //         $shippingCost = $this->get_string_between($node->text(), 'freightAmount":{"currency":"USD","formatedAmount":"US $', '","value":');
            // //         $this->capturedScript = $shippingCost;

            // //         $shippingTime = $this->get_string_between($node->text(), '},"time":"', '","tracking":');
            // //         $this->shippingTime = $shippingTime;
            // //     }
            // //     ++$i;
            // // });

            // // $images = $this->get_string_between($script14, '"imagePathList":[', '],');
            // // $imagesArray = $this->getContents($images, '"', '"');

            // // return response()->json([
            // //     'images' => $imagesArray,
            // //     'script' => $script14,
            // //     // 'script' => $cleanedScript,
            // //     'shippingCost' => $this->capturedScript,
            // //     'shippingTime' => $this->shippingTime,
            // // ]);
            // $uri = $workingUri;
        }

        try {
            $itemID = $this->get_string_between($uri, 'item/', '.html');
        } catch (\Throwable $th) {
            throw $th;
        }

        $workingUri = 'https://fr.aliexpress.com/item/'.$itemID.'.html';

        // $uri = $workingUri;

        //if browser link:
        $page = $clientForScraping->request('GET', $workingUri);

        // $script14 = $page->filter('script')->eq(14)->text(); OLD VErsion
        $script15 = $page->filter('script')->eq(15)->text();

        $page->filter('script')->each(function ($node, $i = 0) {
            if (15 == $i) {
                $shippingCost = $this->get_string_between($node->text(), 'freightAmount":{"currency":"USD","formatedAmount":"US $', '","value":');
                $this->capturedScript = $shippingCost;

                $shippingTime = $this->get_string_between($node->text(), '},"time":"', '","tracking":');
                $this->shippingTime = $shippingTime;
            }
            ++$i;
        });

        //Get images
        $images = $this->get_string_between($script15, '"imagePathList":[', '],');
        $imagesArray = $this->getContents($images, '"', '"');

        return response()->json([
            'images' => $imagesArray,
            'script' => $script15,
            // 'script' => $cleanedScript,
            'shippingCost' => $this->capturedScript,
            'shippingTime' => $this->shippingTime,
            'uri' => $workingUri,
        ]);
    }

    public function scraper_test(Request $request)
    {
        $httpClient = HttpClient::create(['proxy' => 'http://thisismoe:thisismoe1590_country-dz@proxy.iproyal.com:12323']);

        $clientForScraping = new Client($httpClient);

        $uri = $request->query('q');
        $locale = $request->query('locale');

        if (!str_contains($uri, 'item')) {
            $uri = $uri.'mohammed';
            $trimmedUri = $this->get_string_between($uri, 'https', 'mohammed');
            $trimmedUri = 'https'.$trimmedUri;

            try {
                $clientForRedirects = new Client();
                $clientForRedirects->request('GET', $trimmedUri);
            } catch (\Throwable $th) {
                throw $th;
            }

            $newUri = $clientForRedirects->getHistory()->current()->getUri();
            // dd($newUri);
            try {
                $itemID = $this->get_string_between($newUri, 'item/', '.html?');
            } catch (\Throwable $th) {
                throw $th;
            }
            // if ('ar' == $locale) {
            //     $workingUri = 'https://ar.aliexpress.com/item/'.$itemID.'.html';
            // } elseif ('fr' == $locale) {
            //     $workingUri = 'https://fr.aliexpress.com/item/'.$itemID.'.html';
            // }

            $workingUri = 'https://fr.aliexpress.com/item/'.$itemID.'.html';

            // $newPage = $clientForScraping->request('GET', $workingUri);

            // $script14 = $newPage->filter('script')->eq(14)->text();

            // $newPage->filter('script')->each(function ($node, $i = 0) {

            //     if($i == 14) {
            //         $shippingCost = $this->get_string_between($node->text(), 'freightAmount":{"currency":"USD","formatedAmount":"US $', '","value":');
            //         $this->capturedScript = $shippingCost;

            //         $shippingTime = $this->get_string_between($node->text(), '},"time":"', '","tracking":');
            //         $this->shippingTime = $shippingTime;
            //     }
            //     ++$i;
            // });

            // $images = $this->get_string_between($script14, '"imagePathList":[', '],');
            // $imagesArray = $this->getContents($images, '"', '"');

            // return response()->json([
            //     'images' => $imagesArray,
            //     'script' => $script14,
            //     // 'script' => $cleanedScript,
            //     'shippingCost' => $this->capturedScript,
            //     'shippingTime' => $this->shippingTime,
            // ]);
            $uri = $workingUri;
        } else {
            $uri = $uri.'mohammed';
            $trimmedUri = $this->get_string_between($uri, 'aliexpress.com', 'mohammed');
            $uri = 'https://fr.aliexpress.com'.$trimmedUri;
        }

        //if browser link:
        $page = $clientForScraping->request('GET', $uri);

        $script14 = $page->filter('script')->eq(14)->text();

        // Printing all scripts
        echo '<pre>';
        $page->filter('script')->each(function ($node, $i = 0) {
            echo '<pre>';
            echo $i;
            echo '<pre>';
            if (14 == $i) {
                $shippingCost = $this->get_string_between($node->text(), 'layout":[{"text":"Livraison: US $', '","type":"title"},{"text":');
                // $this->setCaptureScript($shippingCost);
                echo '<pre>';
                echo $shippingCost;
                echo '<pre>';
            }
            ++$i;
            echo '<pre>';
            print_r($node->text());
        });

        // $page->filter('script')->each(function ($node, $i = 0) {
        //     if (14 == $i) {
        //         $shippingCost = $this->get_string_between($node->text(), 'freightAmount":{"currency":"USD","formatedAmount":"US $', '","value":');
        //         $this->capturedScript = $shippingCost;

        //         $shippingTime = $this->get_string_between($node->text(), '},"time":"', '","tracking":');
        //         $this->shippingTime = $shippingTime;
        //     }
        //     ++$i;
        // });

        // //Get images
        // $images = $this->get_string_between($script14, '"imagePathList":[', '],');
        // $imagesArray = $this->getContents($images, '"', '"');

        // return response()->json([
        //     'images' => $imagesArray,
        //     'script' => $script14,
        //     // 'script' => $cleanedScript,
        //     'shippingCost' => $this->capturedScript,
        //     'shippingTime' => $this->shippingTime,
        // ]);
    }

    public function get_string_between($string, $start, $end)
    {
        $string = ' '.$string;
        $ini = strpos($string, $start);
        if (0 == $ini) {
            return '';
        }
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }

    public function getContents($str, $startDelimiter, $endDelimiter)
    {
        $contents = [];
        $startDelimiterLength = strlen($startDelimiter);
        $endDelimiterLength = strlen($endDelimiter);
        $startFrom = $contentStart = $contentEnd = 0;
        while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
            $contentStart += $startDelimiterLength;
            $contentEnd = strpos($str, $endDelimiter, $contentStart);
            if (false === $contentEnd) {
                break;
            }
            $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
            $startFrom = $contentEnd + $endDelimiterLength;
        }

        return $contents;
    }
}
