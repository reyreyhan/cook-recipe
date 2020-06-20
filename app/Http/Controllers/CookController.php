<?php

namespace App\Http\Controllers;

use App\Category;
use App\Cook;
use App\Ingredient;
use App\CookIngredient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CookController extends Controller
{
    public function api() {
        $data = Cook::latest()->with(['category', 'cookIngredient'])->get();
        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Cook::latest()->with(['category', 'cookIngredient'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $url = route('cook.delete', $row->id);
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
                ->addColumn('category', function($row) {
                    $row = $row->category->name;
                    return $row;
                })
                ->make(true);
        }

        $category = Category::latest()->get();
        $ingredient = Ingredient::latest()->get();
        return view('cook', compact('category', 'ingredient'));
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
        $cook = Cook::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'created_by' => $request->created_by,
        ]);

        for ($i = 0; $i < count($request->information); $i++) {
            CookIngredient::create([
                'cook_id' => $cook->id,
                'ingredient_id' => $request->ingredient_id[$i],
                'information' => $request->information[$i],
            ]);
        }

        $successMessage = "Success to create cook recipe! ";
        return redirect()->route('cook.index')->with('success', $successMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cook  $cook
     * @return \Illuminate\Http\Response
     */
    public function show(Cook $cook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cook  $cook
     * @return \Illuminate\Http\Response
     */
    public function edit(Cook $cook, $id)
    {
        $cook = Cook::latest()->with(['category', 'cookIngredient'])->find($id);
        $category = Category::latest()->get();
        $ingredient = Ingredient::latest()->get();
        $count = 1;
        return view('cook-edit', compact('cook', 'category', 'ingredient', 'count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cook  $cook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cook $cook, $id)
    {
        $cook = Cook::find($id);
        $cook->name = $request->name;
        $cook->category_id = $request->category_id;
        $cook->created_by = $request->created_by;
        $cook->save();

        $cookIngredient = CookIngredient::where('cook_id', $id);
        $cookIngredient->delete();

        for ($i = 0; $i < count($request->information); $i++) {
            CookIngredient::create([
                'cook_id' => $cook->id,
                'ingredient_id' => $request->ingredient_id[$i],
                'information' => $request->information[$i],
            ]);
        }

        $successMessage = "Success to update cook recipe! ";
        return redirect()->route('cook.index')->with('success', $successMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cook  $cook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cook $cook, $id)
    {
        $cook = Cook::find($id);
        $cookIngredient = CookIngredient::where('cook_id', $id);

        $cook->delete();
        $cookIngredient->delete();
        $successMessage = "Success delete cook recipe! ";
        return redirect()->route('cook.index')->with('success', $successMessage);
    }
}
