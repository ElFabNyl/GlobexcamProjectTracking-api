<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projet\ProjetStoreRequest;
use App\Http\Requests\Projet\ProjetUpdateRequest;
use App\Models\Projet;
use Illuminate\Http\JsonResponse;
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
        return $this->middleware(['role:admin,manager']);
    }

    /**
     * Display a listing of the projet.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return Response::json([
            'status' => true,
            'data' => Projet::query()->select('*')->paginate(10),
        ], 200);
    }

    /**
     * Store a newly created projet in storage.
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
        $projet->user_id = auth()->user()->getAuthIdentifier();

        $projet->save();
    }

    /**
     * Display the specified projet.
     *
     * @param Projet $projet
     * @return JsonResponse
     */
    public function show($slug)
    {

        $projet = Projet::query()
            ->select('*')
        ->where('slug',$slug)->firstOr();
        // le projet demandé n'a pas été trouver ou n'existe pas

//        if () {
//            return Response::json([
//                'status' => false,
//                'message' => 'Projet ' . $slug . ' Not Found',
//                'data' => []
//            ], 404);
//        }

        // Le projet demandé existe
        return Response::json([
            'status' => true,
            'message' => 'Projet founds',
            'data' => $projet
        ], 200);
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
