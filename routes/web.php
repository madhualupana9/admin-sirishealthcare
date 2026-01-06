<?php

use App\Livewire\Dashboard;
use App\Livewire\Users\Index as UserIndex;
use App\Livewire\Users\Create;
use App\Livewire\Users\Edit;
use App\Livewire\Consultations\Index as ConsultationIndex;
use App\Livewire\Consultations\Show;
use App\Livewire\Specialties\Index as SpecialtiesIndex;
use App\Livewire\Specialties\Create as SpecialtiesCreate;
use App\Livewire\Specialties\Edit as SpecialtiesEdit;
use App\Livewire\Doctors\Index as DoctorsIndex;
use App\Livewire\Doctors\Create as DoctorsCreate;
use App\Livewire\Doctors\Edit as DoctorsEdit;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// Dashboard - accessible to all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

// User Management - only for admins
Route::middleware(['auth', 'permission:manage-users'])->group(function () {
    Route::get('/users', UserIndex::class)->name('users.index');
    Route::get('/users/create', Create::class)->name('users.create');
    Route::get('/users/{user}/edit', Edit::class)->name('users.edit');
});

// Consultations - different permissions for viewing vs managing
Route::middleware(['auth', 'permission:view-consultations'])->group(function () {
    Route::get('/consultations', ConsultationIndex::class)->name('consultations.index');
    Route::get('/consultations/{consultation}', Show::class)->name('consultations.show');
});

// Hospitals Management
Route::middleware(['auth', 'permission:manage-hospitals'])->group(function () {
    Route::get('/hospitals', \App\Livewire\Hostels\Index::class)->name('hospitals.index');
    Route::get('/hospitals/{hostel}', \App\Livewire\Hostels\View::class)->name('hospitals.view');
    Route::get('/hostels/create', \App\Livewire\Hostels\Create::class)->name('hospitals.create');
    Route::get('/hospitals/{hostel}/edit', \App\Livewire\Hostels\Edit::class)->name('hospitals.edit');
});

// Specialties Management
Route::middleware(['auth', 'permission:manage-specialties'])->group(function () {
    Route::get('/specialties', SpecialtiesIndex::class)->name('specialties.index');
    Route::get('/specialties/create', SpecialtiesCreate::class)->name('specialties.create');
    Route::get('/specialties/{specialty}/edit', SpecialtiesEdit::class)->name('specialties.edit');
});

// Route::middleware(['auth', 'permission:manage-doctors'])->group(function () {
//      Route::get('/doctors', DoctorsIndex::class)->name('doctors.index');
//     Route::get('/doctors-list', \App\Livewire\Doctors\DoctorsList::class)->name('doctors.indexlist');
//     Route::get('/doctors/create', \App\Livewire\Doctors\Create::class)->name('doctors.create');
//     Route::get('/doctors/{doctor}/edit', \App\Livewire\Doctors\Edit::class)->name('doctors.edit');
//     Route::get('/doctors', \App\Livewire\Doctors\DoctorsList::class)->name('doctors.list');
//     Route::get('/doctors/{doctor}/availability', \App\Livewire\Doctors\Availability::class)->name('doctor.availability');
// });


Route::middleware(['auth', 'permission:manage-doctors'])->group(function () {
    // Main doctors index view
    Route::get('/doctors', DoctorsIndex::class)->name('doctors.index');

    // Alternative doctors list view
    Route::get('/doctors/list', \App\Livewire\Doctors\DoctorsList::class)->name('doctors.list');

    // Create doctor
    Route::get('/doctors/create', DoctorsCreate::class)->name('doctors.create');

    // Edit doctor
    Route::get('/doctors/{doctor}/edit', DoctorsEdit::class)->name('doctors.edit');

    // Doctor availability
    Route::get('/doctors/{doctor}/availability', \App\Livewire\Doctors\Availability::class)->name('doctors.availability');
});

// Business Enquiries
Route::prefix('business-enquiries')->middleware(['auth', 'permission:manage-enquiries'])->group(function () {
    Route::get('/', \App\Livewire\BusinessEnquiries\Index::class)->name('business-enquiries.index');
    Route::get('/{enquiry}', \App\Livewire\BusinessEnquiries\Show::class)->name('business-enquiries.show');
});

// Blogs Management
Route::middleware(['auth', 'permission:manage-blogs'])->group(function () {
    Route::get('/blogs', \App\Livewire\Blogs\Index::class)->name('blogs.index');
    Route::get('/blogs/create', \App\Livewire\Blogs\Create::class)->name('blogs.create');
    Route::get('/blogs/{blog}/edit', \App\Livewire\Blogs\Edit::class)->name('blogs.edit');
});

// Image Uploads - protected but no specific permission needed
Route::post('/upload-image', function (Request $request) {
    $request->validate([
        'file' => 'required|image|max:2048',
    ]);

    $path = $request->file('file')->store('blog-images', 'public');

    return response()->json([
        'location' => asset("storage/$path")
    ]);
})->middleware('auth');

// Profile - accessible to all authenticated users
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// TinyMCE image upload
Route::post('/upload-tinymce-image', function (Request $request) {
    $request->validate([
        'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $path = $request->file('upload')->store('public/uploads');
    $url = Storage::url($path);

    return response()->json([
        'url' => $url,
        'uploaded' => true
    ]);
})->name('upload.tinymce.image')->middleware('auth');



require __DIR__.'/auth.php';
