<?php
//SD
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\StaticTextLang;
use App\Pdfs;
use App\SeoBlocks;
use App\Models\Headings;
use App\Widgets\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Class PdfController
 * @package App\Http\Controllers
 */
class PdfController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pdfs = Pdfs::orderBy('id','desc')->get();
        $seo_block = new SeoBlocks(StaticTextLang::t("Lorem ipsum dolor sit amet portfolio",'seoblock_portfolio'),StaticTextLang::t(Helper::DEFAULT_SEO_DESCRIPTION.'portfolio','seoblock_portfolio'));
        if(!empty($pdfs)) {
            return view('pdf.index',[
                'pdfs' => $pdfs,'seo_block'=>$seo_block
            ]);
        }

        abort(404);
    }

    public function show($id)
    {
        $pdf = new Pdfs();

        $pdfs = Pdfs::orderBy('id','desc')->take(3)->get();

        $single_pdf = $pdf->getPdf($id);
        if(!empty($pdf)) {
            return view('pdf.show',[
                'pdf' => $single_pdf,
                'pdfs' => $pdfs
            ]);
        }

        abort(404);
    }

    public function downloadNow()
    {
        $data = [];
        parse_str($_POST['data'], $data);
        $mess='';
        $db_request=\App\Models\Request::saveRequest($data);
        try {
           // $this->sendEmail($db_request,'emails.contact_us');
            $mess = 'Thank you for downloading TEKTELIC whitepaper!';//'Your email is sent';
        }
        catch(\Exception $e) {
            // return redirect()->back()->with('success', 'Error');
             echo $e->getMessage();
            $mess = 'error';
        }

        return response()->json([
            'mess' => $mess,
        ]);
    }
}
