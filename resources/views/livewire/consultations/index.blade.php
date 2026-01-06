<!-- C:\laragon\www\infinity-admin\resources\views\livewire\consultations\index.blade.php -->
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Main Card Container -->
        <div class="bg-white overflow-hidden shadow-xl rounded-xl border border-gray-100 card-hover">
            <div class="p-8">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8" >
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Consultation Management</h2>
                        <p class="mt-2 text-gray-600">Review and manage patient consultations</p>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                    <div class="relative w-full md:w-1/3">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.lazy="search"
                            class="block w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-150"
                            placeholder="Search consultations...">
                    </div>
                    <div class="flex items-center space-x-4">
                        <select wire:model="perPage" class="rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-3 transition-all duration-150">
                            <option value="5">5 per page</option>
                            <option value="10">10 per page</option>
                            <option value="15">15 per page</option>
                            <option value="25">25 per page</option>
                            <option value="50">50 per page</option>
                        </select>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto rounded-xl border border-gray-200" >
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>

                             <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group" wire:click="sortBy('id')">
                                    <div class="flex items-center sort-header">

                                        <span>ID</span>
                                        <span class="ml-1 opacity-0 group-hover:opacity-100 sort-arrow">
                                            @if($sortField === 'id')
                                                @if($sortDirection === 'asc')
                                                    ↑
                                                @else
                                                    ↓
                                                @endif
                                            @else
                                                ⇅
                                            @endif
                                        </span>
                                    </div>
                                </th>


                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group" wire:click="sortBy('full_name')">
                                    <div class="flex items-center sort-header">

                                        <span>Name</span>
                                        <span class="ml-1 opacity-0 group-hover:opacity-100 sort-arrow">
                                            @if($sortField === 'full_name')
                                                @if($sortDirection === 'asc')
                                                    ↑
                                                @else
                                                    ↓
                                                @endif
                                            @else
                                                ⇅
                                            @endif
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact Info
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group" wire:click="sortBy('specialty')">
                                    <div class="flex items-center sort-header">
                                        <span>Specialty</span>
                                        <span class="ml-1 opacity-0 group-hover:opacity-100 sort-arrow">
                                            @if($sortField === 'specialty')
                                                @if($sortDirection === 'asc')
                                                    ↑
                                                @else
                                                    ↓
                                                @endif
                                            @else
                                                ⇅
                                            @endif
                                        </span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment Status
                                </th>

                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer group" wire:click="sortBy('appointment_time')">
                                    <div class="flex items-center sort-header">
                                        <span>Appointment</span>
                                        <span class="ml-1 opacity-0 group-hover:opacity-100 sort-arrow">
                                            @if($sortField === 'appointment_time')
                                                @if($sortDirection === 'asc')
                                                    ↑
                                                @else
                                                    ↓
                                                @endif
                                            @else
                                                ⇅
                                            @endif
                                        </span>
                                    </div>
                                </th>

                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Consultation Status
                            </th>

                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($consultations as $consultation)
                                <tr class="row-hover" >
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">
                        #{{ $consultation->id }}
                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <span class="text-indigo-600 font-medium">{{ substr($consultation->full_name, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $consultation->full_name }}</div>
                                                <!-- <div class="text-sm text-gray-500">{{ $consultation->email }}</div> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="text-sm text-gray-900">{{ $consultation->contact_info }}</div>
                                        <div class="text-sm text-gray-500">
                                            @if($consultation->age)
                                                {{ $consultation->age }} years
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 badge">
                                            {{ $consultation->specialtyModel->name ?? $consultation->specialty ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'success' => 'bg-green-100 text-green-800',
                                                'failed' => 'bg-red-100 text-red-800',
                                                'refunded' => 'bg-purple-100 text-purple-800'
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$consultation->payment_status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($consultation->payment_status) }}
                                        </span>
                                        @if($consultation->amount)
                                            <div class="text-sm text-gray-500 mt-1">
                                                {{ $consultation->currency }} - {{ number_format($consultation->amount) }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="text-sm text-gray-900">
                                            {{ $consultation->appointment_time ? $consultation->appointment_time->format('M j, Y g:i A') : 'Not scheduled' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $consultation->created_at->diffForHumans() }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                    <button  class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $consultation->consultation_status === 'consulted' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($consultation->consultation_status) }}
                                    </button>
                                </td>

                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-3">
                                            <a href="{{ route('consultations.show', $consultation) }}" class="text-indigo-600 hover:text-indigo-900 action-btn inline-flex items-center">
                                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                           @if(auth()->user()->isAdmin())
       <button
    onclick="confirm('Are you sure You want to delete this record?') ? @this.deleteConsultation('{{ $consultation->id }}') : false"
    class="text-red-600 hover:text-red-900 action-btn inline-flex items-center"
>
    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
    </svg>
    Delete
</button>
                                             @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">No consultations found</h3>
                                            <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $consultations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
