<?php
    namespace App\Repositories;

    use App\Models\Product;
    use Illuminate\Http\Request;
    use App\Http\Requests\ProductRequest;

    interface ProductRepositoryInterface extends BaseRepositoryInterface
    {
        public function createProduct(Product $product);
        public function show_product(int $product_id);
        public function editProduct($product_id);
        public function updateProduct(array $data, $product_id );
        public function deleteProduct($product_id);
        public function getAllProducts();
        public function searchProduct($query);
        public function findProductById( $product_id);
    }
?>