<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table("categories")->get();
        return response()->json($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (DB::table("categories")->insert(["name" => $request->name])) {
            return response("", 201);
        } else {
            return response("", 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = DB::table("categories")
                        ->where("id", $id)
                        ->first();

        if ($category == null) {
            return response("",404);
        }
        else {
            return response()->json($category, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = DB::table("categories")->where("id", $id)->first();
        if ($category == null) {
            return response("",404);
        }
        else {
            DB::table("categories")
                ->where("id", $id)
                ->update(["name"=> $request->name]);
            return response("", 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = DB::table("categories")->where("id", $id)->first();
        if ($category == null) {
            return response("", 404);
        }
        else {
            DB::table("categories")->delete($id);
            return response("", 204);
        }
    }
}
