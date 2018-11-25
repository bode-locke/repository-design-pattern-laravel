# Repository Pattern for Laravel and PHP 7

```
<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    protected $model;

    public function __construct(Post $post)
    {
        $this->model = new Repository($post);
    }

    public function index()
    {
        return $this->model->withAndPaginate(['categories', 'tags'], 15);
    }

    public function showById($id)
    {
        return $this->model->selectById($id);
    }

    public function showBySlug($slug)
    {
        return $this->model->selectByColumn('slug', $slug);
    }

    public function destroy($id)
    {
        $this->model->delete($id);
    }
}


```
