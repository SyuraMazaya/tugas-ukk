<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected LogAktivitasService $logService
    ) {}

    /**
     * Get all users with pagination.
     */
    public function getAll(?int $roleId = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = User::with('role');

        if ($roleId) {
            $query->where('role_id', $roleId);
        }

        return $query->orderBy('name')->paginate($perPage);
    }

    /**
     * Find user by ID.
     */
    public function findById(int $id): ?User
    {
        return User::with('role')->find($id);
    }

    /**
     * Create new user.
     */
    public function create(array $data): User
    {
        $user = User::create([
            'role_id' => $data['role_id'],
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        $user->load('role');
        $this->logService->logUserCreated($user);

        return $user;
    }

    /**
     * Update user.
     */
    public function update(User $user, array $data): User
    {
        $oldData = [
            'username' => $user->username,
            'name' => $user->name,
            'role' => $user->role->name,
        ];

        $updateData = [
            'role_id' => $data['role_id'],
            'name' => $data['name'],
            'username' => $data['username'],
        ];

        // Only update password if provided
        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);
        $user->load('role');

        $this->logService->logUserUpdated($user, $oldData);

        return $user;
    }

    /**
     * Delete user.
     */
    public function delete(User $user): bool
    {
        // Check if user has active peminjaman
        $activePeminjaman = $user->peminjaman()
            ->whereIn('status', ['pending', 'disetujui'])
            ->exists();

        if ($activePeminjaman) {
            throw new \Exception('User tidak dapat dihapus karena masih memiliki peminjaman aktif.');
        }

        $this->logService->logUserDeleted($user);

        return $user->delete();
    }

    /**
     * Get all roles.
     */
    public function getRoles()
    {
        return Role::all();
    }
}
