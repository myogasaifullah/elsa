<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    /**
     * Log aktivitas user
     *
     * @param string $action
     * @param string|null $description
     * @return void
     */
    public static function log(string $action, ?string $description = null): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'description' => $description,
        ]);
    }

    /**
     * Log login activity
     *
     * @param string|null $description
     * @return void
     */
    public static function login(?string $description = null): void
    {
        self::log('login', $description ?? 'User logged in');
    }

    /**
     * Log logout activity
     *
     * @param string|null $description
     * @return void
     */
    public static function logout(?string $description = null): void
    {
        self::log('logout', $description ?? 'User logged out');
    }

    /**
     * Log create activity
     *
     * @param string $modelName
     * @param string|null $description
     * @return void
     */
    public static function create(string $modelName, ?string $description = null): void
    {
        self::log('create', $description ?? "Created new {$modelName}");
    }

    /**
     * Log update activity
     *
     * @param string $modelName
     * @param string|null $description
     * @return void
     */
    public static function update(string $modelName, ?string $description = null): void
    {
        self::log('update', $description ?? "Updated {$modelName}");
    }

    /**
     * Log delete activity
     *
     * @param string $modelName
     * @param string|null $description
     * @return void
     */
    public static function delete(string $modelName, ?string $description = null): void
    {
        self::log('delete', $description ?? "Deleted {$modelName}");
    }

    /**
     * Log booking activity
     *
     * @param string $action
     * @param string|null $description
     * @return void
     */
    public static function booking(string $action, ?string $description = null): void
    {
        self::log("booking_{$action}", $description);
    }

    /**
     * Log approval activity
     *
     * @param string $action
     * @param string|null $description
     * @return void
     */
    public static function approval(string $action, ?string $description = null): void
    {
        self::log("approval_{$action}", $description);
    }

    /**
     * Log progress activity
     *
     * @param string $action
     * @param string|null $description
     * @return void
     */
    public static function progress(string $action, ?string $description = null): void
    {
        self::log("progress_{$action}", $description);
    }
}
