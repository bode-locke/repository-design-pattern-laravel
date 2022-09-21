# Repository Design Pattern for Laravel and PHP 7

- Download the folder and place it at the root of your app folder. 

- Create a RepositoryServiceProvider and make sure to place it app.php config file to bind all the models with a repository. 


If you want to change or add methods, must be sure you implement it in this file.

Create your own Repository and Interface for your Model : 

``` php
<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\Interfaces\UserInterface;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserInterface {
    /**
     * __construct
     *
     * @param  mixed $model
     * @return void
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

}
```
You can keep it empty or just add methods in it who are specific to your User Model.


Use it in your controller : 
``` php
<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    private $model;

    public function __construct(private UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    public function index()
    {
        return $this->userInterface->getAll($orderKey = '', $order = 'DESC', $relations = ['pets'], 15);
    }

    public function create(Request $request)
    {
        return $this->userInterface->create($request->all());
    }

    public function show(string $id)
    {
        return $this->userInterface->findOrFail($id, $relations = ['pets', 'friends']);
    }
}
```
