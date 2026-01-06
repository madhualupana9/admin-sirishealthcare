<div>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
                    <p class="mt-2 text-sm text-gray-600">Welcome back, {{ auth()->user()->name }}!</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ auth()->user()->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ auth()->user()->isAdmin() ? 'Administrator' : 'Standard User' }}
                    </span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @if(auth()->user()->isAdmin())
                <!-- Users Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-500 rounded-lg p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-500">Total Hospitals</h3>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ \App\Models\Hostel::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('hospitals.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                View all hospitals <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
             @endif
                <!-- Consultations Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-lg p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-500">Total Consultations</h3>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ \App\Models\Consultation::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('consultations.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
                                View all consultations <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->isAdmin())
                <!-- Recent Activity Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-lg p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-500">Total Doctors</h3>
                                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ \App\Models\Doctor::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('hospitals.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                View Doctors<span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Status Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-500 rounded-lg p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-medium text-gray-500">Total Specialties</h3>
                               <p class="mt-1 text-2xl font-semibold text-gray-900">{{ \App\Models\Specialty::count() }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('specialties.index') }}" class="text-sm font-medium text-yellow-600 hover:text-yellow-500">
                                View Specialties <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
                 @endif
            </div>

              <!-- Recent Activity Section -->
<div class="mb-8 bg-white rounded-lg shadow overflow-hidden border border-gray-100">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Consultations</h3>
    </div>
    <div class="bg-white overflow-hidden">
        <ul class="divide-y divide-gray-200">
            @foreach(\App\Models\Consultation::where('consultation_status', 'pending')
                ->latest()
                ->take(10)
                ->get() as $consultation)
            <li class="px-4 py-4 sm:px-6">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1 flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1 px-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $consultation->full_name }} - {{ $consultation->specialty ?? 'General' }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $consultation->problem_description ? Str::limit($consultation->problem_description, 50) : 'No description' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('consultations.show', $consultation) }}"
   class="inline-flex items-center px-3 py-1.5 border border-indigo-200 text-xs font-medium rounded-md text-indigo-700 bg-indigo-50 hover:bg-indigo-100 hover:text-indigo-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-150 ease-in-out">
    <svg class="-ml-0.5 mr-1.5 h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
    </svg>
    View
</a>
                    </div>
                </div>
            </li>
            @endforeach

            @if(\App\Models\Consultation::where('consultation_status', 'pending')->count() === 0)
            <li class="px-4 py-4 sm:px-6">
                <div class="text-center text-sm text-gray-500">
                    No pending consultations found
                </div>
            </li>
            @endif
        </ul>
        <div class="px-4 py-4 sm:px-6 border-t border-gray-200">
            <a href="{{ route('consultations.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                View all consultations <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </div>
</div>

            <!-- Admin Notice & Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                <!-- Admin Notice -->
                @if(auth()->user()->isAdmin())
                <div class="lg:col-span-2 bg-white rounded-lg shadow overflow-hidden border border-gray-100">
    <div class="p-5">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                </svg>
            </div>
            <div class="ml-4 w-full">
                <h3 class="text-lg font-medium text-gray-900">Doctors</h3>
                <p class="mt-1 text-sm text-gray-600">
                    You have full access to manage doctors, their specialties, and hospital assignments.
                </p>

                <!-- Doctors List -->
                <div class="mt-4 space-y-3">
                    @foreach(\App\Models\Doctor::with(['specialty', 'hospital'])->latest()->take(10)->get() as $doctor)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-150">
                        <div class="flex items-center">
                            @if($doctor->photo)
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/'.$doctor->photo) }}" alt="{{ $doctor->name }}">
                            @else
                            <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                <span class="text-purple-600 font-medium">{{ substr($doctor->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $doctor->name }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $doctor->specialty->name ?? 'No Specialty' }} • {{ $doctor->hospital->name ?? 'No Hospital' }}
                                </p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                              {{ $doctor->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $doctor->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    @endforeach
                </div>

                <!-- View All Link -->
                <div class="mt-4">
                    <a href="{{ route('doctors.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500 inline-flex items-center">
                        View all doctors
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



                <!-- Quick Links -->
                <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Specialties</h3>
                        <ul class="space-y-3">

                        <li class="border-b border-gray-200 last:border-b-0">
    <div class="px-4 py-3">
        <h4 class="text-sm font-medium text-gray-500 mb-2">Latest Specialties</h4>
        <ul class="space-y-2">
            @foreach(\App\Models\Specialty::latest()->take(10)->get() as $specialty)
            <li>
                <a href="{{ route('specialties.edit', $specialty) }}" class="group flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-150">
                    <svg class="flex-shrink-0 mr-2 h-5 w-5 text-gray-400 group-hover:text-purple-500 transition-colors duration-150" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="truncate">{{ $specialty->name }}</span>
                    <span class="ml-auto text-xs text-gray-500">{{ $specialty->created_at->diffForHumans() }}</span>
                </a>
            </li>
            @endforeach
        </ul>
         <div class="mt-4">
                    <a href="{{ route('specialties.index') }}" class="text-sm font-medium text-purple-600 hover:text-purple-500 inline-flex items-center">
                        View all Specialties
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
    </div>
</li>

                        </ul>
                    </div>
                </div>
   @endif

            </div>


        </div>
    </div>
</div>
