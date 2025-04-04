<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRequest;
use App\Repositories\CategorieRepository;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //
    protected $categorieRepository;

    public function __construct(CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
    }

    public function create(CategorieRequest $request)
    {

        try {

            $data = $request->validated();
            $categorie = $this->categorieRepository->create($data);

            return response()->json([
                'message' => 'categorie craeted seccss',
                'data' => $categorie
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
