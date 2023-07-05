<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use App\Contracts\RepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->userRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->userRepository->getAll());
    }

    /**
     * Store a newly created resource in storage.
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $data = $request->all();
            $data['password'] =  Hash::make($request->input('password'));
            $record = $this->userRepository->create($data);
            return response()->json(['data' => $record, 'message' => 'Record created successfully!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message'=> $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->userRepository->find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UserUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        try {
            $data = $request->all();
            $data['password'] =  Hash::make($request->input('password'));
            $this->userRepository->update($user->id, $data);

            return response()->json(['data' => $user, 'message' => 'Registration updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user->id);
        return response()->json(['message' => 'Record removed successfully.']);
    }
}
