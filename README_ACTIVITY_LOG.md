# Sistem Log Aktivitas

## Deskripsi
Sistem log aktivitas yang mencakup:
- Log aktivitas user (login, logout, CRUD operations)
- Log aktivitas business logic (booking, approval, progress updates)
- Penyimpanan di Database MySQL

## Cara Menggunakan

### 1. Migration
Jalankan migration untuk membuat tabel `activity_logs`:
```bash
php artisan migrate
```

### 2. Contoh Penggunaan

#### Log Login/Logout
```php
use App\Services\ActivityLogService;

// Log login
ActivityLogService::login();

// Log logout
ActivityLogService::logout();
```

#### Log CRUD Operations
```php
// Log create
ActivityLogService::create('User', 'Menambahkan user baru');

// Log update
ActivityLogService::update('Booking', 'Mengupdate booking dengan ID 123');

// Log delete
ActivityLogService::delete('Progress', 'Menghapus progress dengan ID 456');
```

#### Log Business Logic
```php
// Log booking
ActivityLogService::booking('create', 'Membuat booking baru');
ActivityLogService::booking('approve', 'Menyetujui booking');
ActivityLogService::booking('reject', 'Menolak booking');

// Log approval
ActivityLogService::approval('approve', 'Menyetujui jadwal booking');
ActivityLogService::approval('reject', 'Menolak jadwal booking');

// Log progress
ActivityLogService::progress('update', 'Update progress menjadi 75%');
ActivityLogService::progress('complete', 'Menandai progress sebagai selesai');
```

### 3. Query Log
```php
// Mendapatkan semua log
$logs = ActivityLog::with('user')->latest()->get();

// Filter berdasarkan action
$loginLogs = ActivityLog::where('action', 'login')->get();
$bookingLogs = ActivityLog::where('action', 'like', 'booking_%')->get();
```

### 4. Struktur Tabel
- `id`: Primary key
- `user_id`: ID user yang melakukan aktivitas
- `action`: Jenis aktivitas (login, logout, create, update, delete, booking_*, approval_*, progress_*)
- `description`: Deskripsi aktivitas
- `created_at`: Waktu aktivitas dilakukan
- `updated_at`: Waktu update terakhir

## Contoh Implementasi di Controller

```php
// Contoh di UserController
public function store(Request $request)
{
    $user = User::create($validatedData);
    ActivityLogService::create('User', "Menambahkan user {$user->name}");
    
    return redirect()->back()->with('success', 'User berhasil ditambahkan');
}

// Contoh di JadwalBookingController
public function approve($id)
{
    $booking = JadwalBooking::findOrFail($id);
    $booking->update(['status' => 'approved']);
    ActivityLogService::booking('approve', "Menyetujui booking {$booking->title}");
    
    return redirect()->back()->with('success', 'Booking disetujui');
}
