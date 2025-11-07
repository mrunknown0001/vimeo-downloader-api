<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Support\Facades\Request;
use App\Client\VideoDownloaderApi;

class DownloadController {

    public function download(Request $request)
    {
        // validate request
        // vimeo url sanitizer
        // format validation: mp3,1080,720,360,4k,2k
        $dlclient = new VideoDownloaderApi();

        $url = "https://vimeo.com/1113240264";
        // $url = "https://www.youtube.com/watch?v=IiEuzY044cs&list=RDIiEuzY044cs&start_radio=1";
        $response = $dlclient->download($url);

        return $response;
    }


    public function progress($id)
    {

    }
}