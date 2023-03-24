<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use Exception;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function index()
    {
        try {
            $categories = $this->categoryService->allCategory();
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }

        return view('category.list', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        try {
            $result = $this->categoryService->storeCategory($request);

            if ($result){
                return redirect()->route('category.index')->with('success', 'Thêm mới thành công.');
            } else {
                return back()->with('error', 'Thêm mới k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function edit($id)
    {
        $categories = $this->categoryService->findId($id);

        return view('category.edit', compact('categories'));
    }

    public function update(EditCategoryRequest $request, $id)
    {
        try {
            $result = $this->categoryService->updateCategory($request, $id);

            if ($result){
                return redirect()->route('category.index')->with('success', 'Sửa thành công.');
            } else {
                return back()->with('error', 'Sửa k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->categoryService->deleteCategory($id);

            if ($result){
                return redirect()->route('category.index')->with('success', 'Xóa thành công.');
            } else {
                return back()->with('error', 'Xóa k thành công.');
            }
        } catch (Exception $exception) {
            return back()->with('error', 'Lỗi');
        }
    }
}
