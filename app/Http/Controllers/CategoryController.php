<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function api() {
        $data = Category::latest()->get();
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

            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $url = route('category.delete', $row->id);
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

        return view('category');
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
        Category::create([
            'name' => $request->name,
        ]);

        $successMessage = "Success to create category! ";
        return redirect()->route('category.index')->with('success', $successMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        $category = Category::find($id);
        return view('category-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        $successMessage = "Success to update category! ";
        return redirect()->route('category.index')->with('success', $successMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        $category = Category::find($id);
        $category->delete();
        $successMessage = "Success delete category! ";
        return redirect()->route('category.index')->with('success', $successMessage);
    }
}
