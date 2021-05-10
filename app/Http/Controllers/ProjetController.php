<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projet\ProjetStoreRequest;
use App\Http\Requests\Projet\ProjetUpdateRequest;
use App\Http\Requests\ProjetRequest;
use App\Models\Projet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class ProjetController
 * @package App\Http\Controllers
 */
class ProjetController extends Controller
{

    /**
     * ProjetController constructor.
     */
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return Response::json([
            'status' => true,
            'data' => Projet::query()->select('*')->paginate(10),
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjetStoreRequest $request
     * @return void
     */
    public function store(ProjetStoreRequest $request)
    {
        $projet = new Projet();

        $projet->title = $request['title'];
        $projet->assing_to = auth()->user()->name;
        $projet->client_name = $request['client_name'];
        $projet->general_price = $request['general_price'];
        $projet->amount_payed = $request['amount_payed'];
        $projet->ending_date = $request['ending_date'];
        $projet->method_payment = $request['category'];

        $projet->save();
    }

    /**
     * Display the specified resource.
     *
     * @param Projet $projet
     * @return JsonResponse
     */
    public function show($projet)
    {

        if(is_null(Projet::find($projet)))
        {
            return Response::json([
                'status' => false,
                'message' => 'Projet '.$projet.' Not Found',
                'data' => []
            ],404);
        }
        return Response::json([
            'status' => true,
            'message' => 'Projet founds',
            'data' => Projet::find($projet)
            ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjetUpdateRequest $request
     * @param Projet $projet
     * @return void
     */
    public function update(ProjetUpdateRequest $request, Projet $projet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Projet $projet
     * @return void
     */
    public function destroy(Projet $projet)
    {
        //
    }
}
