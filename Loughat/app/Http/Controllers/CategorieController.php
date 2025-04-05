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

    public function index ()
    {
        $categories = $this->categorieRepository->all();
        // dd($categories);
        return view('admindashboard.categories', compact('categories'));
    }

    public function create(CategorieRequest $request)
    {

        try {
            $data = $request->validated();
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $path = $file->store('categories', 'public'); 
                $data['logo'] = $path;
            }
            $categorie = $this->categorieRepository->create($data);
            // return response()->json([
            //     'message' => 'categorie craeted seccss',
            //     'data' => $categorie
            // ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(CategorieRequest $request, $id)
    {
        try {

            $categorie = $this->categorieRepository->find($id);

            if (! $categorie) {

                return response()->json([
                    'message' => 'categorie not found',
                ]);
            }
            $data = $request->validated();
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $path = $file->store('categories', 'public'); 
                $data['logo'] = $path;
            }
            $updateCategorie = $this->categorieRepository->update($data, $id);

            // return response()->json([
            //     'message' => 'categorie updated seccss',
            //     'data' => $updateCategorie
            // ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {

            $categorie = $this->categorieRepository->delete($id);

            if (! $categorie) {

                return response()->json([
                    'message' => 'categorie not found',
                ]);
            }
            // return response()->json([
            //     'message' => 'categorie deleted',
            // ]);
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
