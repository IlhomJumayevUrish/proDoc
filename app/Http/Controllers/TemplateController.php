<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateRequest;
use App\Models\Field;
use App\Models\Template;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $templates = Template::orderBy('id','desc')->get();
        return view('dashboard.pages.template', ['templates' => $templates]);
    }

    public function show($id)
    {
        $template = Template::findOrFail($id);
        return view('dashboard.pages.temp', ['template' => $template]);
    }
    public function temp($id)
    {
        $data = Field::where('template_id',$id)->get();
        return view('dashboard.pages.temps', ['fields' => $data,'template'=>$id]);
    }

    public function generate(Request $request, $id)
    {
        $labels = $request->label;
        $keys = $request->key;
        foreach ($labels as $key=>$value) {
            Field::create([
                'label' => $value,
                'key' => $keys[$key],
                'type' => 1,
                'template_id' => $id,
            ]);
        }
        $templates = Template::orderBy('id','desc')->get();
        return view('dashboard.pages.template', ['templates' => $templates]);
    }

    public function create(TemplateRequest $request)
    {
        $template = new Template();
        $template->name = $request->name;
        $template->status = 'active';
        $template->file = uploadFile($request->file('file'), "template");
        $template->user_id = auth()->id();
        $template->save();
        $newString = substr_replace($template->file, 'app\public\template\\', 0,18);
        $templateProcessor = new TemplateProcessor(storage_path($newString));
        return view('dashboard.pages.temp', ['template' => $template,'keys'=>$templateProcessor->getVariables()]);
    }
}
