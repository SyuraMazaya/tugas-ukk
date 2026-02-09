<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Display a listing of users.
     */
    public function index(Request $request): View
    {
        $roleId = $request->get('role_id');
        $users = $this->userService->getAll($roleId);
        $roles = $this->userService->getRoles();

        return view('admin.users.index', compact('users', 'roles', 'roleId'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        $roles = $this->userService->getRoles();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->create($request->validated());

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified user.
     */
    public function show(int $id): View
    {
        $user = $this->userService->findById($id);

        if (!$user) {
            abort(404);
        }

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(int $id): View
    {
        $user = $this->userService->findById($id);

        if (!$user) {
            abort(404);
        }

        $roles = $this->userService->getRoles();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $user = $this->userService->findById($id);

        if (!$user) {
            abort(404);
        }

        $this->userService->update($user, $request->validated());

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(int $id): RedirectResponse
    {
        $user = $this->userService->findById($id);

        if (!$user) {
            abort(404);
        }

        try {
            $this->userService->delete($user);
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', $e->getMessage());
        }
    }
}
