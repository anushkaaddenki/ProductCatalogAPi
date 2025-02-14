<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index(Request $request)
    {
        //return response()->json($this->productRepo->getAll($request->category_id));
        $perPage = (int) ($request->query('per_page', 10)); // Ensure it's always an integer
        $categoryId = $request->query('category_id');
    
        return response()->json($this->productRepo->getAll($perPage, $categoryId));
    }

    public function show($id)
    {
        return response()->json($this->productRepo->find($id)->toArray());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        return response()->json($this->productRepo->store($data)->toArray(), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'sometimes|required|string|unique:products,sku,' . $id,
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        return response()->json($this->productRepo->update($id, $data)->toArray());
    }

    public function destroy($id)
    {
        $this->productRepo->delete($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
