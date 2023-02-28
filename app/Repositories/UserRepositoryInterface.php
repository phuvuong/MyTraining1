<?php
    namespace App\Repositories;

    use App\Models\User;
    use Illuminate\Http\Request;

    interface UserRepositoryInterface extends BaseRepositoryInterface
    {
        public function getUser($email);
       
    }
?>