<?php

namespace App\Repositories;

use App\Models\News;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class DashboardRepository implements RepositoryInterface
{
    private $user;
    private $news;

    public function __construct(User $user, 
    News $news)
    {
        $this->user = $user;
        $this->news = $news;
    }


    public function getCountUsers()
    {
        $data = $this->user::get()->count();
        return $data;
    }
    public function getCountArticles()
    {
        $news = $this->news::get()->count();
        $total = $news;
        return $total;
    }

    public function get(){

    }
    public function getPaginate($howMany){

    }
    public function find($id){

    }
    public function store($data){

    }
    public function update($data, $id){

    }
    public function destroy($id){

    }
}
