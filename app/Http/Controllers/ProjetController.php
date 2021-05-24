<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projet\ProjetStoreRequest;
use App\Http\Requests\Projet\ProjetUpdateRequest;
use App\Models\Dept;
use App\Models\Projet;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Exception;

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
            'data' => Projet::query()->select('*')->orderByDesc('created_at')->paginate(10),
        ], 200);
    }

    /**
     * Store a newly created projet in storage.
     *
     * @param ProjetStoreRequest $request
     * @return JsonResponse
     */
    public function store(ProjetStoreRequest $request)
    {
        $user = User::findByEmail($request['client_email']);

        if ($user) {
            try {
                // CREATE A PROJET
                $projet = new Projet();

                $projet->title = $request['title'];
                $projet->slug = Str::slug($request['title'], '-');
                $projet->user_id = auth()->user()->getAuthIdentifier();
                $projet->client_email = $request['client_email'];
                $projet->general_price = $request['general_price'];
                $projet->description = $request['description'];
                $projet->amount_payed = $request['amount_payed'];
                $projet->assign_to = auth()->user()->name;
                $projet->ending_date = $request['ending_date'];
                $projet->category = $request['category'];

                $projet->save();


                // CREATE A DEPT
                $dept = new Dept();

                $dept->amount_to_pay = $request['general_price'] - $request['amount_payed'];
                $dept->amount_payed = $request['amount_payed'];
                $dept->user_id = $user->id;
                $dept->projet_id = $projet->id;

                $dept->save();

                // CREATE A RECEIPT
                $receipt = new Receipt();

                $receipt->phase = 'PHASE 1';
                $receipt->amount_payed = $request['amount_payed'];
                $receipt->method_payment = $request['method_payment'];
                $receipt->dept_id = $dept->id;

                $receipt->save();

                return Response::json([
                    'status' => true,
                    'message' => 'New projet added',
                    'data' => $projet
                ], 201);
            } catch (Exception $exception) {

                return Response::json([
                    'status' => false,
                    'message' => $exception->getMessage(),
                    'data' => []
                ], 404);
            }
        }

        return Response::json([
            'status' => false,
            'message' => 'The User ' . $request['client_email'] . ' is not Registerd',
            'data' => []
        ], 404);
    }

    /**
     * Display the specified projet.
     * Search By Slug
     * @param $slug
     * @return JsonResponse
     */
    public function show($slug)
    {
        // Ici on vérifie si c'est un entier
        if (is_numeric($slug)) {
            return Response::json([
                'status' => false,
                'message' => 'Please enter a name of projet',
                'data' => []
            ], 404);
        }

        $projet = Projet::findBySlug($slug);

        // le projet demandé n'a pas été trouver ou n'existe pas
        if (is_null($projet)) {
            return Response::json([
                'status' => false,
                'message' => 'Projet ' . $slug . ' Not Found',
                'data' => []
            ], 404);
        }

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
     * @return JsonResponse
     */
    public function update(ProjetUpdateRequest $request, Projet $projet)
    {

        if(!$projet)
        {
            return response()->json([
                'status' => false,
                'message' => 'Projet Not Found',
                'data' => []
            ]);

        }

        $projet->title = is_null($request['title']) ? $projet->title : $request['title'];
        $projet->slug = is_null($request['title']) ? $projet->slug : Str::slug($request['title']);
        $projet->client_email = is_null($request['client_email']) ? $projet->client_email : $request['client_email'];
        $projet->general_price = is_null($request['general_price']) ? $projet->general_price : $request['general_price'];
        $projet->description = is_null($request['description']) ? $projet->description : $request['description'];
        $projet->amount_payed = is_null($request['amount_payed']) ? $projet->amount_payed : $request['amount_payed'];
        $projet->assign_to = auth()->user()->name;
        $projet->ending_date = is_null($request['ending_date']) ? $projet->ending_date : $request['ending_date'];
        $projet->category = is_null($request['category']) ? $projet->category : $request['category'];

        $projet->save();

        return response()->json([
            'status' => true,
            'message' => 'Projet Updated',
            'data' => $projet
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Projet $projet
     * @return void
     */
    public function destroy(Projet $projet)
    {
        abort(500);
    }
}
