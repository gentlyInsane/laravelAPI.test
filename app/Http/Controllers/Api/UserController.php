<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $offset = $request->has('offset') ? $request->query('offset') : 0;
        $limit = $request->has('limit') ? $request->query('limit') : 10;

        $queryBuilder = User::query();
        if ($request->has('q'))
            $queryBuilder->where('name', 'like', '%' . $request->query('q') . '%');
        if ($request->has('sortBy'))
            $queryBuilder->orderBy($request->query('sortBy'), $request->query('sort', 'DESC'));

        $data = $queryBuilder->offset($offset)->limit($limit)->get();
        return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response([
            'date' => $user,
            'message' => 'User created.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param user $user
     * @return user
     */
    public function show(user $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param user $user
     * @return Response
     */
    public function update(Request $request, user $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response([
            'data' => $user,
            'message' => 'User updated.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param user $user
     * @return Response
     * @throws Exception
     */
    public function destroy(user $user)
    {
        $user->delete();

        return response(['message' => 'User deleted'], 200);
    }
}