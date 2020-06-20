<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Ingredient::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $url = route('ingredient.delete', $row->id);
                    $button =
                        '<center>' .
                        '<form action="' .  $url  . '" method="post">' .
                        csrf_field()  . method_field("DELETE")  .
                        '<a href="' . $url . '" class=" btn btn-primary" style="margin-right: 10px">Edit</a>' .
                        '<button class="btn btn-danger" type="submit" onclick="return confirm(' .
                        "'Are you sure delete $row->name ?')" .
                        '" href=""><i class="fa fa-trash"></i>Delete</button>' .
                        '</form>' .
                        '</center>';
                    return $button;
                })
                ->editColumn('created_at', function($row) {
                    $formattingDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('F j, Y');
                    $lastCreated = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->diffForHumans();
                    $row = $formattingDate . ' (' . $lastCreated . ')';
                    return $row;
                })
                ->make(true);
        }

        return view('ingredient');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ingredient::create([
            'name' => $request->name,
        ]);

        $successMessage = "Success to create ingredient! ";
        return redirect()->route('ingredient.index')->with('success', $successMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient, $id)
    {
        $ingredient = Ingredient::find($id);
        return view('ingredient-edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient, $id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->name = $request->name;
        $ingredient->save();
        $successMessage = "Success to update ingredient! ";
        return redirect()->route('ingredient.index')->with('success', $successMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient, $id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        $successMessage = "Success delete ingredient! ";
        return redirect()->route('ingredient.index')->with('success', $successMessage);
    }
}
