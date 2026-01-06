<!-- C:\laragon\www\infinity-admin\resources\views\livewire\doctors\availability.blade.php -->
<div>
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Availability Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-slow hover:shadow-2xl">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 px-6 py-5 sm:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ $doctor->name }}'s Availability</h2>
                        <p class="mt-1 text-indigo-100">Manage time slots for consultation</p>
                    </div>
                    <a href="{{ route('doctors.list') }}"
                       class="mt-4 sm:mt-0 inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-full text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to Doctors
                    </a>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-8 sm:p-10">
                @if(session()->has('message'))
                    <div class="mb-8 p-4 bg-green-50 rounded-lg border border-green-200 text-green-700 flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Date Controls -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div class="flex items-center gap-3">
                        <button wire:click="toggleDatePicker" class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            {{ $showDatePicker ? 'Show Default View' : 'Select Specific Date' }}
                        </button>

                        @if($showDatePicker)
                           <div class="flex items-center gap-2">
                                <input
                                    type="date"
                                    wire:model.live="selectedDate"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm cursor-pointer"
                                    onclick="this.showPicker()"
                                    style="min-height: 40px">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-8">
                    @if(count($availabilitySlots) > 0)
                        @foreach($availabilitySlots as $availability)
                            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 transition-all duration-300 hover:border-indigo-200">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($availability->date)->format('l, F j, Y') }}
                                    </h3>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        {{ count($availability->slots) }} slots
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                                    @foreach($availability->slots as $slot)
                                        @php
                                            $isPastDate = \Carbon\Carbon::parse($availability->date)->isPast();
                                        @endphp

                                        @if($slot->is_booked)
                                        <!-- Booked slot -->
                                        <button
                                            wire:click="showAppointmentOptions({{ $slot->id }})"
                                            class="px-4 py-3 rounded-lg border text-center transition-all duration-300
                                                bg-red-50 text-red-700 border-red-200
                                                @if(!$isPastDate) hover:bg-red-100 hover:border-red-300 @endif
                                                flex flex-col items-center justify-center"
                                            title="{{ $isPastDate ? 'Past date - cannot be modified' : 'Click to manage appointment' }}"
                                            @if($isPastDate) disabled @endif>
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}</span>
                                            <span class="text-xs mt-1 text-red-500">Booked</span>
                                            @if($isPastDate)
                                                <span class="text-xs mt-1 text-gray-500">Slots disabled</span>
                                            @endif
                                        </button>
                                    @else
                                        <!-- Available slot -->
                                        <button
                                            wire:click="{{ !$isPastDate ? "toggleSlot('{$availability->date}', {$slot->id})" : '' }}"
                                            class="px-4 py-3 rounded-lg border text-center transition-all duration-300
                                                bg-green-50 text-green-700 border-green-200
                                                @if(!$isPastDate) hover:bg-green-100 hover:border-green-300 @endif
                                                flex flex-col items-center justify-center"
                                            title="{{ $isPastDate ? 'Past date - cannot be modified' : 'Click to mark as booked' }}"
                                            @if($isPastDate) disabled @endif
                                        >
                                            <span class="font-medium">{{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}</span>
                                            <span class="text-xs mt-1 text-green-500">Available</span>
                                            @if($isPastDate)
                                                <span class="text-xs mt-1 text-gray-500">Slots disabled</span>
                                            @endif
                                        </button>
                                    @endif

                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No availability slots</h3>
                            <p class="mt-1 text-gray-500">
                                @if($showDatePicker)
                                    No availability slots found for the selected date.
                                @else
                                    No upcoming availability slots found for this doctor.
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="hidden lg:block fixed bottom-0 left-0 w-32 h-32 bg-indigo-200 rounded-full filter blur-3xl opacity-20 -z-10 animate-float"></div>
        <div class="hidden lg:block fixed top-1/4 right-0 w-48 h-48 bg-indigo-100 rounded-full filter blur-3xl opacity-20 -z-10 animate-float" style="animation-delay: 2s;"></div>
    </div>
</div>

<!-- Modals Container -->
<div x-data="{
    showCancel: @entangle('showCancelModal'),
    showReschedule: @entangle('showRescheduleModal'),
    showSuccess: @entangle('showSuccessModal'),
    showBooking: @entangle('showBookingForm'),
    showBookingDetails: @entangle('showBookingDetails')
}"
    x-show="showCancel || showReschedule || showSuccess || showBooking || showBookingDetails"
    class="fixed inset-0 z-[9999] flex items-center justify-center p-4 overflow-y-auto bg-black bg-opacity-50"
    wire:click="resetModals">



    <!-- Cancel Appointment Modal -->
    <div x-show="showCancel"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative max-w-md mx-auto"
         @click.stop style="width: 50%;">
        <div class="bg-white rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Cancel Appointment</h3>
                <button wire:click="resetModals" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <p class="text-gray-700">Please select a reason for cancellation:</p>

                <select wire:model="selectedCancellationReason" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select a reason</option>
                    @foreach($cancellationReasons as $reason)
                        <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end space-x-4">
                    <button wire:click="resetModals"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                        Back
                    </button>
                    <button wire:click="cancelAppointment"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        Confirm Cancellation
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Details Modal -->
    <div x-show="showBookingDetails"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative max-w-md mx-auto"
         @click.stop style="width: 50%;">
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md mx-auto" @click.stop>
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Appointment Details</h3>



                @if($selectedSlot)
                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-700">
                        <span class="font-semibold">Slot:</span>
                        {{ \Carbon\Carbon::parse($selectedSlot->availability->date)->format('M j, Y') }}
                        at {{ \Carbon\Carbon::parse($selectedSlot->start_time)->format('g:i A') }}
                    </p>
                    <p class="text-sm font-medium text-gray-700 mt-1">
                        <span class="font-semibold">Doctor:</span> {{ $doctor->name }}
                    </p>
                </div>

                @if($selectedSlot->consultation)
                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Patient Name:</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $selectedSlot->consultation->full_name }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Contact:</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $selectedSlot->consultation->contact_info }}</p>
                    </div>

                    @if($selectedSlot->consultation->email)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email:</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $selectedSlot->consultation->email }}</p>
                    </div>
                    @endif

                    <div>
                        <p class="text-sm font-medium text-gray-500">Age:</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $selectedSlot->consultation->age }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Specialty:</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $selectedSlot->consultation->specialty }}</p>
                    </div>

                    @if($selectedSlot->consultation->problem_description)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Problem Description:</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $selectedSlot->consultation->problem_description }}</p>
                    </div>
                    @endif

                    <div>
                        <p class="text-sm font-medium text-gray-500">Payment Method:</p>
                        <p class="text-sm font-semibold text-gray-700">{{ ucfirst($selectedSlot->consultation->payment_method) }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Amount:</p>
                        <p class="text-sm font-semibold text-gray-700">${{ $selectedSlot->consultation->amount }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Status:</p>
                        <p class="text-sm font-semibold text-gray-700">{{ ucfirst($selectedSlot->consultation->consultation_status) }}</p>
                    </div>
                </div>
                @else
                <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                    <p class="text-sm text-yellow-700 mb-3">No consultation details found for this booked slot.</p>
                    <p class="text-xs text-yellow-600 mb-3">This slot was marked as booked but doesn't have consultation details. You can:</p>
                    <div class="flex space-x-2">
                        <button wire:click="createConsultationForSlot"
                                class="px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition">
                            Add Consultation Details
                        </button>
                        <button wire:click="unmarkSlotAsBooked"
                                class="px-3 py-1 bg-gray-600 text-white text-xs rounded hover:bg-gray-700 transition">
                            Mark as Available
                        </button>
                    </div>
                </div>
                @endif
                @endif

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" wire:click="resetModals"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                        Close
                    </button>
                    <button type="button" wire:click="initiateReschedule"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Reschedule
                    </button>
                    <button type="button" wire:click="initiateCancel"
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reschedule Appointment Modal -->
    <div x-show="showReschedule"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative max-w-md mx-auto"
         @click.stop style="width: 50%;">
        <div class="bg-white rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Reschedule Appointment</h3>
                <button wire:click="resetModals" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <p class="text-gray-700">Select a new time slot:</p>

                @if(count($availableRescheduleSlots) > 0)
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($availableRescheduleSlots as $slot)
                            <button wire:click="$set('newSlotId', {{ $slot->id }})"
                                class="px-4 py-3 rounded-lg border text-center transition-all duration-300
                                    {{ $newSlotId == $slot->id ? 'bg-indigo-100 border-indigo-300' : 'bg-white border-gray-300' }}
                                    hover:bg-indigo-50 hover:border-indigo-200">
                                <div class="font-medium">
                                    {{ \Carbon\Carbon::parse($slot->availability->date)->format('M j') }}
                                </div>
                                <div>
                                    {{ \Carbon\Carbon::parse($slot->start_time)->format('g:i A') }}
                                </div>
                            </button>
                        @endforeach
                    </div>

                    <div class="flex justify-end space-x-4 pt-4">
                        <button wire:click="resetModals"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                            Back
                        </button>
                        <button wire:click="rescheduleAppointment"
                                wire:loading.attr="disabled"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition
                                    {{ !$newSlotId ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ !$newSlotId ? 'disabled' : '' }}>
                                <span wire:loading.remove>Confirm Reschedule</span>
                                <span wire:loading>Processing...</span>
                            </button>
                    </div>
                @else
                    <p class="text-gray-500 py-4">No available slots found for rescheduling.</p>
                    <button wire:click="resetModals"
                        class="w-full px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                        Back
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div x-show="showSuccess"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative max-w-md mx-auto"
         @click.stop style="width: 50%;">
        <div class="bg-white rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Appointment Cancelled</h3>
                <button wire:click="resetModals" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div class="p-4 bg-green-50 rounded-lg border border-green-200 text-green-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ $successMessage }}
                </div>

                <div class="flex justify-end pt-4">
                    <button wire:click="resetModals"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Form Modal -->
    <div x-show="showBooking"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative max-w-md mx-auto"
         @click.stop style="width: 50%;">
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md mx-auto" @click.stop>
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Book Appointment</h3>

                @if($selectedSlot)
                <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-700">
                        <span class="font-semibold">Slot:</span>
                        {{ \Carbon\Carbon::parse($selectedSlot->availability->date)->format('M j, Y') }}
                        at {{ \Carbon\Carbon::parse($selectedSlot->start_time)->format('g:i A') }}
                    </p>
                    <p class="text-sm font-medium text-gray-700 mt-1">
                        <span class="font-semibold">Doctor:</span> {{ $doctor->name }}
                    </p>
                </div>
                @endif

                <form wire:submit.prevent="submitBookingForm">
                    <div class="space-y-4">
                        <!-- Full Name -->
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name *</label>
                            <input type="text" wire:model="full_name" id="full_name"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('full_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Contact Info -->
                        <div>
                            <label for="contact_info" class="block text-sm font-medium text-gray-700">Contact Number *</label>
                            <input type="text" wire:model="contact_info" id="contact_info"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('contact_info') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" wire:model="email" id="email"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Age -->
                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700">Age *</label>
                            <input type="text" wire:model="age" id="age"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('age') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Specialty -->
                        <div>
                            <label for="specialty" class="block text-sm font-medium text-gray-700">Specialty *</label>
                            <select wire:model="specialty" id="specialty"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                                @endforeach
                            </select>
                            @error('specialty') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Problem Description -->
                        <div>
                            <label for="problem_description" class="block text-sm font-medium text-gray-700">Problem Description</label>
                            <textarea wire:model="problem_description" id="problem_description" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            @error('problem_description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Payment Method *</label>
                            <div class="mt-1 space-y-2">
                                <div class="flex items-center">
                                    <input wire:model="payment_method" id="payment_cash" type="radio" value="cash"
                                           class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="payment_cash" class="ml-3 block text-sm font-medium text-gray-700">Cash</label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model="payment_method" id="payment_online" type="radio" value="online"
                                           class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="payment_online" class="ml-3 block text-sm font-medium text-gray-700">Online</label>
                                </div>
                            </div>
                            @error('payment_method') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700">Amount *</label>
                            <input type="number" wire:model="amount" id="amount"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" disabled>
                            @error('amount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Payment Status -->
                        <div>
                            <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status *</label>
                            <select wire:model="payment_status" id="payment_status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="pending">Not Paid</option>
                                <option value="success">Paid</option>
                            </select>
                            @error('payment_status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" wire:click="resetBookingForm"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                            Book Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
