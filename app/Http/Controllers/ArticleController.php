<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
        ], [
            'description.required' => 'Ingrese una descripcion',
            'price.required' => 'Ingrese un precio',
            'price.numeric' => 'Debe ser un numero',
            'image.required' => 'Seleccione imagen',
            'image.image' => 'Debe ser una imagen'
        ]);
        
        try {
            $image=$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('articlesImages', $image);
            DB::beginTransaction();
            Article::create([
                'description'=>$request->description,
                'price'=>$request->price,
                'status'=>$request->status,
                'image'=>$request->image,
            ]);
            DB::commit();
            return response()->json([
                'title'=>'¡Guardado!',
                'msg' => 'El registro se guardó correctamente',
                'icon' => 'success'
            ], 200);
        } catch (Exception $e) {
            DB::rolback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article=Article::find($id);
        return view('articles.form', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric',
        ], [
            'description.required' => 'Ingrese una descripcion',
            'price.required' => 'Ingrese un precio',
            'price.numeric' => 'Debe ser un numero',
        ]);
        try {
            DB::beginTransaction();
            $article->description= $request->description;
            $article->price= $request->price;
            $article->status= $request->status;
            $article->save();
            DB::commit();
            return response()->json([
                'title'=>'Guardado!',
                'msg' => 'El registro se actualizó correctamente',
                'icon' => 'success'
            ], 200);
        } catch (Exception $e) {
            DB::rolback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // $article = Article::find($id);
        $article->delete();
        return response()->json([
            'title'=>'¡Cambios guardados!',
            'msg'=>'El registro se eliminó correctamente',
            'icon'=>'info'
        ]);
    }

    public function list()
    {
        $articles = Article::get();
        return datatables()->of($articles)
        ->addColumn('buttons', 'articles.actionButtons')
        ->rawColumns(['buttons'])
        ->toJson();
    }
}