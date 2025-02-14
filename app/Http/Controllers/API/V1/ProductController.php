<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index(Request $request)
    {
        try {
        $perPage = (int) ($request->query('per_page', 10)); // Ensure it's always an integer
        $categoryId = $request->query('category_id');
        return response()->json($this->productRepo->getAll($perPage, $categoryId));
        }catch (Exception $e) {
            Log::error("Error fetching products: " . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch products'], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productRepo->find($id);
            if (!$product) {
                Log::error("Product not found ");
                return response()->json(['error' => 'Product not found'], 404);
            }
            return response()->json($product->toArray());
        } catch (ModelNotFoundException $e) {
            Log::error("Product not found " . $e->getMessage());
            return response()->json(['error' => 'Product not found'], 404);
        } catch (Exception $e) {
            Log::error("Failed to retrieve product " . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve product'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'sku' => 'required|string|unique:products,sku',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
            ]);

            return response()->json($this->productRepo->store($data)->toArray(), 201);
        } catch (ValidationException $e) {
            Log::error("Failed to create product Validation Error " . $e->getMessage());
            return response()->json(['error' => $e->errors()], 422);
        } catch (Exception $e) {
            Log::error("Failed to create product " . $e->getMessage());
            return response()->json(['error' => 'Failed to create product'], 500);
        }
        
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'sku' => 'sometimes|required|string|unique:products,sku,' . $id,
                'price' => 'sometimes|required|numeric|min:0',
                'category_id' => 'sometimes|required|exists:categories,id',
            ]);

            $updatedProduct = $this->productRepo->update($id, $data);
            if (!$updatedProduct) {
                return response()->json(['error' => 'Product not found'], 404);
            }
            return response()->json($updatedProduct->toArray());
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }

    public function destroy($id)
    {
        try{
            $this->productRepo->delete($id);
            return response()->json(['message' => 'Product deleted successfully']);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete product'], 500);
        }
        
    }
}
