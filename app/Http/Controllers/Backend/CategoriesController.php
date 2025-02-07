<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Category\ICategoryService;
use App\Services\DataTables\CategoriesDataTable;
use App\Http\Requests\Backend\Category\CategoryRequest;

class CategoriesController extends Controller
{
    public function __construct(
        private ICategoryService $categoryService,
    ) {}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!request()->ajax()) {
            return view('backend.categories.index');
        }
        return (new CategoriesDataTable())->build();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoriesTree = $this->categoryService->tree();
        return view('backend.categories.create', ['categoriesTree' => $categoriesTree]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryService->store($request->validatedData());

            if (!$category) {
                return redirect()->back()->with('error', 'Failed to create category. Please try again.');
            }

            return redirect()->back()->with('success', 'Category Created Successfully ...');
        } catch (Exception $e) {
            Log::error($e->getMessage() . '' . $e->getFile() . '' . $e->getLine());
            return redirect()->back()->with('error', "An error occurred while creating the category. Please try again.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->getById($id);
        $categoriesTree = $this->categoryService->tree();

        return view('backend.categories.edit', [
            'category' => $category,
            'categoriesTree' => $categoriesTree
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        try {
            $category = $this->categoryService->update($id, $request->validatedData());

            if (!$category) {
                return redirect()->back()->with('error', 'Failed to update category. Please try again.');
            }

            return redirect()->back()->with('success', 'Category Updated Successfully ...');
        } catch (Exception $e) {
            Log::error($e->getMessage() . '' . $e->getFile() . '' . $e->getLine());
            return redirect()->back()->with('error', "An error occurred while updating the category. Please try again.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = $this->categoryService->delete($id);
            if (!$category) {
                return redirect()->back()->with("error", "Failed to delete category. Please try again.");
            }
            return redirect()->back()->with("success", "Category Deleted Successfully ...");
        } catch (Exception $e) {
            Log::error($e->getMessage() . "" . $e->getFile() . "" . $e->getLine());
            return redirect()->back()->with("error", "An error occurred while deleting the category. Please try again.");
        }
    }
}
