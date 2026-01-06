<div>
<div class="py-8" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Main Card Container -->
        <div class="bg-white overflow-hidden shadow-xl rounded-xl border border-gray-100 card-hover">
            <div class="p-8">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Consultation Details</h2>
                        <p class="mt-2 text-gray-600">Review complete consultation information</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('consultations.index') }}" class="inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-150 back-btn">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>

                <!-- Patient Profile Section -->
                <div class="flex items-center mb-8" >
                    <div class="flex-shrink-0 h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center shadow-inner">
                        <span class="text-indigo-600 text-2xl font-medium">{{ substr($consultation->full_name, 0, 1) }}</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $consultation->full_name }}</h3>
                        <p class="text-gray-600">{{ $consultation->email }}</p>
                    </div>
                </div>

                <!-- Information Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Personal Information Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 info-card">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Personal Information</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Contact Info:</span>
                                <span class="text-gray-900">{{ $consultation->contact_info ?? 'N/A' }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Age:</span>
                                <span class="text-gray-900">{{ $consultation->age ? $consultation->age.' years' : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Details Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 info-card">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Appointment Details</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Specialty:</span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $consultation->specialtyModel->name ?? $consultation->specialty ?? 'N/A' }}
                                </span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Doctor:</span>
                                <span class="text-gray-900">
                                    {{ $consultation->doctor->name ?? 'N/A' }}
                                </span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Appointment Time:</span>
                                <span class="text-gray-900">
                                    {{ $consultation->appointment_time ? $consultation->appointment_time->format('F j, Y g:i A') : 'Not scheduled' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 info-card">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Payment Information</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Status:</span>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'success' => 'bg-green-100 text-green-800',
                                        'failed' => 'bg-red-100 text-red-800',
                                        'refunded' => 'bg-purple-100 text-purple-800'
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$consultation->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($consultation->payment_status) }}
                                </span>
                            </div>
                           @if($consultation->amount)
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Amount:</span>
                                <span class="text-gray-900">
                                    {{ $consultation->currency }} {{ number_format($consultation->amount / 100, 2) }}
                                </span>
                            </div>
                            @endif
                            @if($consultation->payment_method)
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Method:</span>
                                <span class="text-gray-900">{{ ucfirst($consultation->payment_method) }}</span>
                            </div>
                            @endif
                            @if($consultation->razorpay_payment_id)
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Payment ID:</span>
                                <span class="text-gray-900">{{ $consultation->razorpay_payment_id }}</span>
                            </div>
                            @endif
                            @if($consultation->invoice_id)
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Invoice ID:</span>
                                <span class="text-gray-900">{{ $consultation->invoice_id }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                     <!-- Appointment Status & Slot Information Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 info-card">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Appointment Status & Slots</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Status:</span>
                                @php
                                    $appointmentStatusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        'rescheduled' => 'bg-purple-100 text-purple-800'
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $appointmentStatusColors[$consultation->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($consultation->status) }}
                                </span>
                            </div>
                            @if($consultation->originalSlot && $consultation->originalSlot->availability)
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Original Slot:</span>
                                <span class="text-gray-900">
                                    {{ \Carbon\Carbon::parse($consultation->originalSlot->availability->date)->format('M j, Y') }}
                                    at {{ \Carbon\Carbon::parse($consultation->originalSlot->start_time)->format('g:i A') }}
                                </span>
                            </div>
                            @endif
                            @if($consultation->slot && $consultation->slot->availability)
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Current Slot:</span>
                                <span class="text-gray-900">
                                    {{ \Carbon\Carbon::parse($consultation->slot->availability->date)->format('M j, Y') }}
                                    at {{ \Carbon\Carbon::parse($consultation->slot->start_time)->format('g:i A') }}
                                </span>
                            </div>
                            @endif
                            @if($consultation->cancellation_reason_id && $consultation->cancellationReason)
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Cancellation Reason:</span>
                                <span class="text-gray-900">{{ $consultation->cancellationReason->reason }}</span>
                            </div>
                            @endif
                            @if($consultation->cancellation_notes)
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Cancellation Notes:</span>
                                <span class="text-gray-900">{{ $consultation->cancellation_notes }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Problem Description -->
                <div class="mt-6" >
                    <div class="bg-green-50 rounded-xl p-6 border border-green-100 problem-description">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Problem Description</h3>
                        </div>
                        <div class="prose max-w-none text-gray-700">
                            <p class="whitespace-pre-line">{{ $consultation->problem_description ?? 'No description provided' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                @if($consultation->notes)
                <div class="mt-6" >
                    <div class="bg-yellow-50 rounded-xl p-6 border border-yellow-100 notes-section">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Admin Notes</h3>
                        </div>
                        <div class="prose max-w-none text-gray-700">
                            <p class="whitespace-pre-line">{{ $consultation->notes }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="mt-6">
    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                    <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="ml-3 text-lg font-medium text-gray-900">Consultation Status</h3>
            </div>
            <button wire:click="confirmStatusChange" class="px-4 py-2 rounded-xl {{ $consultation->consultation_status === 'consulted' ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }} transition-colors duration-150">
                {{ ucfirst($consultation->consultation_status) }}
            </button>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div x-data="{ show: @entangle('showConfirmModal') }"
     x-show="show"
     x-transition:enter="ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl max-w-md"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Change Consultation Status?</h3>
            <p class="text-gray-600 mb-6">
                Are you sure you want to change the consultation status from
                <span class="font-semibold">{{ ucfirst($consultation->consultation_status) }}</span>
                to
                <span class="font-semibold">{{ $consultation->consultation_status === 'pending' ? 'Consulted' : 'Pending' }}</span>?
            </p>
            <div class="flex justify-end space-x-3">
                <button wire:click="cancelStatusChange"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                    Cancel
                </button>
                <button wire:click="toggleConsultationStatus"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session()->has('message'))
<div class="fixed top-4 right-4 z-50 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
    <span class="block sm:inline">{{ session('message') }}</span>
</div>
@endif

</div>
