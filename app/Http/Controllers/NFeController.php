<?php

namespace App\Http\Controllers;

use App\Classes\ConnectionToAPI;
use App\NFe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NFeController extends Controller
{

    public function index()
    {
        $nfes = NFe::all();
        return view('nfes.list', compact('nfes'));
    }

    public function search(Request $request)
    {
        $text = $request->text;
        $nfes = NFe::where('access_key', 'LIKE', "%{$text}%")->get();
        return view('nfes.list', compact('nfes'));
    }

    public function getNFeFromAPI()
    {
        //Define Header
        $apiConnection = new ConnectionToAPI();
        $header = array(
            'Content-Type: application/json',
            'x-api-id:' . env('X_API_ID',  ''),
            'x-api-key:' . env('X_API_KEY',  ''),
        );

        $url = 'https://sandbox-api.arquivei.com.br/v1/nfe/received';

        $response = $apiConnection->getContent($header, $url);

        return $response;
    }

    public function base64ToXml($response)
        {
        $listNfe[] = null;
        foreach ($response->data as $nfe) {
            $access_key = $nfe->access_key;

            $base64Data  = $nfe->xml;
            $xmlresponse = base64_decode($base64Data);
            $xmlDecoded  = simplexml_load_string($xmlresponse);

            $totalvalue = 0;

            if (property_exists($xmlDecoded->NFe, "infNFe") || is_object($xmlDecoded->NFe->infNFe)) {
                $totalvalue = $xmlDecoded->NFe->infNFe->total->ICMSTot->vNF;
            }

            array_push($listNfe, [
                'access_key' => $access_key,
                'total'      => $totalvalue
            ]);
        }
        return $listNfe;
    }

    public function store()
    {
        $response = $this->getNFeFromAPI();
        $data = $this->base64ToXml($response);

        $messages = ['unique' => 'Ops! Os dados desta API já foram inseridos na base de dados.'];
        $rules = ['access_key' => 'unique:n_fes'];
        $success_message = '';

        foreach ($data as $d) {
            if (!is_null($d)) {
                $validator = Validator::make($d,$rules,$messages);
                if ($validator->fails()) {
                    $message = $validator->errors()->messages()['access_key'][0];
                    return view('index', compact('message'));
                } else {
                    NFe::create($d);
                    $success_message = 'Dados da API persistidos com sucesso';
                }
            }
        }
        return view('index', compact('success_message'));
    }

    public function redirectToIndex()
    {
        return redirect('/', 302);
    }
}
