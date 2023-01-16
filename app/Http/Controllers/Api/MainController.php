<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function categories()
    {
        return Category::all();
    }

    public function categoryStore(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:4',
            'description' => 'required',
        ]);

        $category = Category::create($request->all());

        return $category;
    }

    public function categoryShow($id)
    {
        return Category::find($id);
    }

    public function categoryUpdate(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|min:4',
            'description' => 'required',
        ]);

        $category = DB::table('categories')
            ->where('id', $id)
            ->update($validate);

        if ($category)
        {
            $data = Category::find($id);

            return response()->json(['status' => 'success', 'data' => $data]);
        }


        return response()->json(['status' => 'success', 'message' => 'You haven\'t change any date']);
    }

    public function categoryDelete($id)
    {
        Category::where('id', $id)->delete();


        return response()->json(['status' => 'success', 'message' => 'category deleted successfully']);
    }

    public function subCategories()
    {
        return SubCategory::all();
    }

    public function subCategoryStore(Request $request)
    {
        $validate = $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:4',
            'description' => 'required',
        ]);

        $sub_category = SubCategory::create($request->all());

        return response()->json(['status' => 'success', 'data' => $sub_category]);
    }

    public function subCategoryShow($id)
    {
        return SubCategory::find($id);
    }

    public function subCategoryUpdate(Request $request, $id)
    {
        $validate = $request->validate([
            'category_id' => 'required',
            'name' => 'required|min:4',
            'description' => 'required',
        ]);

        $subcategory = DB::table('sub_categories')
            ->where('id', $id)
            ->update($validate);

        if ($subcategory)
        {
            $data = SubCategory::find($id);

            return response()->json(['status' => 'success', 'data' => $data]);
        }

        return response()->json(['status' => 'success', 'message' => 'You haven\'t change any date']);
    }

    public function subCategoryDelete($id)
    {
        SubCategory::where('id', $id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Sub Category deleted successfully']);

    }




}
