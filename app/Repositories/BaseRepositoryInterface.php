<?php
    namespace App\Repositories;

    use Exception;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Query\Builder;
    use Illuminate\Http\Request;
    use App\Models\Product;

    interface BaseRepositoryInterface
    {
            public function all();
            public function find($id);
            public function create(array $data);
            public function update(array $data, $id );
            public function delete($id);
    }
?>