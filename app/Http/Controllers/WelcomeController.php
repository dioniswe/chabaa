<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    /**
     * contact email as image
     */
    public function getContactEmail(Request $request)
    {
        $arr = \App\Model\Config::all(['config', 'value'])->toArray();
        $config = Arr::pluck($arr, 'value', 'config');
        $emailText = \Illuminate\Support\Arr::get($config, 'servantry.church.email');

        $textLength = strlen($emailText);
        $textHeight = 10;

        // create image handle
        $image = ImageCreate($textLength*($textHeight-1),20);

        // set colours
        $backgroundColour = ImageColorAllocate($image,255,255,255); // white
        $textColour = ImageColorAllocate($image,0,0,0); // black

        // set text
        ImageString($image,$textHeight,0,0,$emailText,$textColour);

        // create image
        $imagePng = ImagePNG($image);
    }
}
