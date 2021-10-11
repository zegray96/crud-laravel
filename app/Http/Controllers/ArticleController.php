<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    protected $artImgfolder;
    
    public function __construct()
    {
        // Definimos el nombre de la carpeta donde almacenar las imagnes
        $this->artImgfolder = storage_path(). '/app/public/articlesImages';
    }
    
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
            'image' => 'image',
        ], [
            'description.required' => 'Ingrese una descripcion',
            'price.required' => 'Ingrese un precio',
            'price.numeric' => 'Debe ser un numero',
            'image.image' => 'Debe ser una imagen'
        ]);
        
        try {
            if ($request->hasFile('image')) {
                // Creamos la carpeta si no existe
                if (!file_exists($this->artImgfolder)) {
                    mkdir($this->artImgfolder, 0777, true);
                }
                // Definimos el nombre del archivo
                $image=date('YmdHis').'_'.$request->file('image')->getClientOriginalName();
                // Definimos donde se va guardar
                $path = $this->artImgfolder.'/'.$image;
                // Guardamos y redimensionamos
                Image::make($request->file('image'))->resize(500, 500)->save($path);
            }
            
            DB::beginTransaction();
            Article::create([
                'description'=>$request->description,
                'price'=>$request->price,
                'status'=>$request->status,
                'image'=>isset($image) ? $image : null,
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
            if ($request->hasFile('image')) {
                // Verificar si posee una imagen
                if ($article->image!=null) {
                    // Borramos la imagen anterior
                    Storage::delete('public/articlesImages/'.$article->image);
                }
                // Creamos la carpeta si no existe
                if (!file_exists($this->artImgfolder)) {
                    mkdir($this->artImgfolder, 0777, true);
                }
                // Definimos el nombre del archivo
                $image=date('YmdHis').'_'.$request->file('image')->getClientOriginalName();
                // Definimos donde se va guardar
                $path = $this->artImgfolder.'/'.$image;
                // Guardamos y redimensionamos
                Image::make($request->file('image'))->resize(500, 500)->save($path);

                $article->image = $image;
            }

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
        if ($article->image!=null) {
            // Borramos la imagen anterior
            Storage::delete('public/articlesImages/'.$article->image);
        }
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