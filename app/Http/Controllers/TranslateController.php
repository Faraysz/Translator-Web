<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Translation;
use Illuminate\Http\Client\Response;

class TranslateController extends Controller
{
    // Show Translate Form
    public function index()
    {
        return view('translate');
    }
    // Standard Translate Method
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

    // AJAX Translate Method
    public function ajaxTranslate(Request $request)
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
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghubungi server penerjemah'
            ], 500);
        }

        $data = $response->json();

        if (!isset($data['responseData']['translatedText'])) {
            return response()->json([
                'success' => false,
                'message' => 'Response API tidak valid'
            ], 422);
        }

        $result = $data['responseData']['translatedText'];

        // simpan ke database
        Translation::create([
            'source_text' => $request->text,
            'source_lang' => $request->source_lang,
            'target_lang' => $request->target_lang,
            'translated_text' => $result,
        ]);

        return response()->json([
            'success' => true,
            'translatedText' => $result
        ]);
    }
}
