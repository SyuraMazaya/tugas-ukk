<?php

namespace App\Services;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LogAktivitasService
{
    /**
     * Log an activity.
     */
    public function log(string $aktivitas, ?array $detailData = null, ?User $user = null): LogAktivitas
    {
        $user = $user ?? Auth::user();

        return LogAktivitas::create([
            'user_id' => $user->id,
            'aktivitas' => $aktivitas,
            'detail_data' => $detailData,
        ]);
    }

    /**
     * Log user creation.
     */
    public function logUserCreated(User $createdUser): void
    {
        $this->log('Membuat user baru', [
            'user_id' => $createdUser->id,
            'username' => $createdUser->username,
            'name' => $createdUser->name,
            'role' => $createdUser->role->name,
        ]);
    }

    /**
     * Log user update.
     */
    public function logUserUpdated(User $user, array $oldData): void
    {
        $this->log('Mengupdate user', [
            'user_id' => $user->id,
            'before' => $oldData,
            'after' => [
                'username' => $user->username,
                'name' => $user->name,
                'role' => $user->role->name,
            ],
        ]);
    }

    /**
     * Log user deletion.
     */
    public function logUserDeleted(User $user): void
    {
        $this->log('Menghapus user', [
            'user_id' => $user->id,
            'username' => $user->username,
            'name' => $user->name,
        ]);
    }

    /**
     * Get all logs with pagination.
     */
    public function getAllLogs(int $perPage = 15)
    {
        return LogAktivitas::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
