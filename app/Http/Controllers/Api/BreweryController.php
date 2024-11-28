<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http; // Importa la classe Http

class BreweryController extends Controller
{
    public function index(Request $request)
    {
        // Esempio di chiamata proxy a OpenBreweryDB
        $response = Http::get('https://api.openbrewerydb.org/v1/breweries');

        // Controlla la risposta e restituisci i dati
        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Impossibile recuperare i dati'], 500);
    }

    public function show($id) {

        $response = Http::get('https://api.openbrewerydb.org/v1/breweries/'.$id);

        // Controlla la risposta e restituisci i dati
        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Impossibile recuperare i dati'], 500);
    }
}
