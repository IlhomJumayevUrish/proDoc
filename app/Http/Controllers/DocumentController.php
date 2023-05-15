<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\Field;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PhpOffice\PhpWord\TemplateProcessor;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $documents = Document::orderBy('id', 'desc')->get();
        $options = Template::orderBy('id', 'desc')->get();
        return view('dashboard.pages.document',
            [
                'documents' => $documents,
                'options' => $options
            ]);
    }

    public function file(Request $request, $id)
    {
        $file_name='storage/document/qrcode/'.time().'.png';
        $writer = new PngWriter();
        $qrCode = QrCode::create('https://www.youtube.com/watch?v=kWoW2wMKJA4&list=RDMMkWoW2wMKJA4&start_radio=1')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $result = $writer->write($qrCode);
        $result->saveToFile($file_name);
        $data = $request->all();
        $data = array_combine(array_keys($data), array_values($data));
        Arr::forget($data, '_token');
        Arr::forget($data, 'doc_name');
        $original = Template::findOrFail($id);
        $newString = substr_replace($original->file, 'app\public\template\\', 0, 18);
        $modifiedDocxFile = 'public/document/' . time() . '.docx';
        $templateProcessor = new TemplateProcessor(storage_path($newString));
        $templateProcessor->setValues($data);
        $templateProcessor->setImageValue('image', $file_name);
        $templateProcessor->saveAs(storage_path('app/' . $modifiedDocxFile));
        $document = new Document();
        $document->name = $request->doc_name;
        $document->template_id = $id;
        $document->user_id = auth()->id();
        $document->file = substr_replace($modifiedDocxFile, 'storage', 0, 6);
        $document->save();
        return redirect()->back();
    }

    public function create(DocumentRequest $request)
    {
        $data = Field::where('template_id', $request->template_id)->get();
        return view('dashboard.pages.temps',
            [
                'fields' => $data,
                'template' => $request->template_id,
                'name' => $request->name
            ]);
    }


}
