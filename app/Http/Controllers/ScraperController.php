<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    private $results = [];

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

    //get all occurences between two strings
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

    public function scraper()
    {
        $client = new Client();
        $uri = 'https://fr.aliexpress.com/item/1005003190838984.html?spm=a2g0o.productlist.0.0.be3f1991wAu8Ko&algo_pvid=9fe4665c-f731-4bda-8da9-842e40675974&algo_exp_id=9fe4665c-f731-4bda-8da9-842e40675974-0&pdp_ext_f=%7B%22sku_id%22%3A%2212000024582844555%22%7D';
        $page = $client->request('GET', $uri);
        // echo $page->filter('.product-price-value')->text();

        //Refactored //Return this
        $script14 = $page->filter('script')->eq(14)->text();

        //Get Product ID //Can be transfered to front end
        $product_id = $this->get_string_between($script14, 'product_id=', '&');
        echo '<pre>';
        print_r('Produt id: '.$product_id);
        echo '<pre>';

        // Get main photo link
        $script = $page->filter('script')->eq(0)->text();
        // print_r($script);
        echo '<pre>';
        $parsedStrings = $this->get_string_between($script, "window.__f_image__ = '", "';");
        echo $parsedStrings; // (result = image_link)

        //Get Product description //Can be transfered to front end
        $descriptionScript = $script14; //"description":"
        echo '<pre>';
        $parsedStrings = $this->get_string_between($descriptionScript, '"description":"', '",');
        echo $parsedStrings; // (result = description)

        //Get all packs //Can be transfered to front end
        $packsScript = $script14; //"description":"
        echo '<pre>';
        print_r($this->getContents($packsScript, 'propertyValueDisplayName":"', '",'));

        //Get Color codes "skuColorValue":"
        echo '<pre>';
        print_r($this->getContents($packsScript, '"skuColorValue":"', '",'));

        //Get all images links "imagePathList" //Can be transfered to front end
        echo '<pre>';
        $imagesArray = $this->get_string_between($script14, '"imagePathList":[', '],');
        print_r($imagesArray);
        print_r($this->getContents($imagesArray, '"', '"'));

        //get productproperties productSKUPropertyList to "skuPriceList"
        echo '<pre>';
        $productSKUPropertyList = $this->get_string_between($script14, 'productSKUPropertyList":', ',"skuPriceList"');
        // print_r($productSKUPropertyList);

        ////GOLDEN
        $decodedProductSKUPropertyList = json_decode($productSKUPropertyList, true);
        //printing decoded data
        // foreach ($decodedProductSKUPropertyList as $value) {
        //     print_r($value);
        // }

        echo '<pre>';
        print_r($decodedProductSKUPropertyList);
        echo '<pre>';        

        //Getting property names and options
        foreach ($decodedProductSKUPropertyList as $value) {
            echo '<pre>';
            print_r($value['skuPropertyName']);
            echo '<pre>';
            foreach ($value['skuPropertyValues'] as $value) {
                echo '<pre>';
                print_r($value['propertyValueDisplayName']);
                echo '<pre>';
                print_r($value['propertyValueId']);
            }
        }
        // dd($decodedProductSKUPropertyList);

        // dd($decodedProductSKUPropertyList);
        // foreach ($decodedProductSKUPropertyList as $item) {
        //     echo $item;
        // }
        //GOLDEN ,"specsModule"

        //Get skuPriceList
        echo '<pre>';
        $skuPriceList = $this->get_string_between($script14, '"skuPriceList":', ',"warrantyDetailJson":');
        // print_r($skuPriceList);
        $decodedSkuPriceList = json_decode($skuPriceList);
        // dd($decodedSkuPriceList);

        echo '<pre>';
        echo 'Options prices';
        echo '<pre>';

        //Getting price list of options
        foreach ($decodedSkuPriceList as $value) {
            echo '<pre>';
            // print_r($value);
            echo '<pre>';
            print_r($value->skuPropIds);
            echo '<pre>';
            print_r('Actual Price: '.$value->skuVal->actSkuCalPrice);
            echo '<pre>';
            print_r('Discount: '.$value->skuVal->discount);
            echo '<pre>';
            print_r('Calculated Price: '.$value->skuVal->skuCalPrice);
        }

        echo '<pre>';
        $res = $client->getResponse();
        if (200 === $res->getStatusCode()) {
            $status = 200;
        }
        echo '<pre>';
        echo 'Status: '.$status;

        echo '<pre>';
        echo '--------------------------------------------------';

        // Printing all scripts
        echo '<pre>';
        $page->filter('script')->each(function ($node, $i = 0) {
            echo '<pre>';
            echo $i;
            echo '<pre>';
            ++$i;
            print_r($node->text());
        });
        echo '<pre>';
    }

    public function show()
    {
        return view('show');
    }

    public function getInfo(Request $request)
    {
        // $results = [];

        $client = new Client();

        $uri = $request->query('q');
        // $uri = 'https://fr.aliexpress.com/item/1005003190838984.html?spm=a2g0o.productlist.0.0.be3f1991wAu8Ko&algo_pvid=9fe4665c-f731-4bda-8da9-842e40675974&algo_exp_id=9fe4665c-f731-4bda-8da9-842e40675974-0&pdp_ext_f=%7B%22sku_id%22%3A%2212000024582844555%22%7D';
        $page = $client->request('GET', $uri);

        //Refactored //Return this
        $script14 = $page->filter('script')->eq(14)->text();


        //Get images
        $images = $this->get_string_between($script14, '"imagePathList":[', '],');
        $imagesArray = $this->getContents($images, '"', '"');

        return response()->json([
            'images' => $imagesArray,
            'script' => $script14
        ]);
    }

    public function search()
    {
        return view('search');
    }

    public function searchProduct(Request $request)
    {
        $uri = $request->query('q');
        return view('c')->with('uri', $uri);
    }
}
