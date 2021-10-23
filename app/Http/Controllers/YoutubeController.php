<?php
//SD
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\StaticTextLang;
use App\Youtubes;
use App\Models\Headings;
use App\Widgets\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Class PdfController
 * @package App\Http\Controllers
 */
class YoutubeController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pdfs = Youtubes::orderBy('id','desc')->get();
        if(!empty($pdfs)) {
            return view('pdf.index',[
                'pdfs' => $pdfs
            ]);
        }

        abort(404);
    }
}
