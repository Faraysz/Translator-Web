<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Translation;
use Illuminate\Http\Client\Response;

class TranslateController extends Controller
{
    public function index()
    {
        return view('translate');
    }

    public function translate(Request $request)
    {
        /** @var Response $response */
        $response = Http::timeout(10)->get(
            'https://api.mymemory.translated.net/get',
            [
                'q' => $request->text,
                'langpair' => $request->source_lang . '|' . $request->target_lang,
            ]
        );

        if (!$response->successful()) {
            return back()->withErrors([
                'api' => 'Gagal menghubungi server penerjemah'
            ])->withInput();
        }

        $data = $response->json();

        if (!isset($data['responseData']['translatedText'])) {
            return back()->withErrors([
                'api' => 'Response API tidak valid'
            ])->withInput();
        }

        $result = $data['responseData']['translatedText'];

        Translation::create([
            'source_text' => $request->text,
            'source_lang' => $request->source_lang,
            'target_lang' => $request->target_lang,
            'translated_text' => $result,
        ]);

        return view('translate', compact('result'));
    }
}
