<?php
    namespace App\Services;

    use App\Models\Category;
    use Illuminate\Http\Request;

    class CategoryService
    {
        public function allCategory()
        {
            return Category::paginate(10);
        }

        public function storeCategory(Request $request)
        {
            return Category::create([
                'name' => $request->name,
            ]);
        }

        public function findId($id)
        {
            return Category::find($id);
        }

        public function updateCategory(Request $request, $id)
        {
            return Category::find($id)->update([
                'name' => $request->name,
            ]);
        }

        public function deleteCategory($id)
        {
            return Category::find($id)->delete();
        }
    }
?>