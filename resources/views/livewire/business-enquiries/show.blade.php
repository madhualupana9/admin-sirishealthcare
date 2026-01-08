<div class="py-8" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Main Card Container -->
        <div class="bg-white overflow-hidden shadow-xl rounded-xl border border-gray-100 card-hover">
            <div class="p-8">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800">Enquiry Details</h2>
                        <p class="mt-2 text-gray-600">Review complete enquiry information</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('business-enquiries.index') }}" class="inline-flex items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-150 back-btn">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to List
                        </a>
                    </div>
                </div>

                <!-- Enquirer Profile Section -->
                <div class="flex items-center mb-8" >
                    <div class="flex-shrink-0 h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center shadow-inner">
                        <span class="text-indigo-600 text-2xl font-medium">{{ substr($enquiry->enquirer_name, 0, 1) }}</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $enquiry->enquirer_name }}</h3>
                        <p class="text-gray-600">{{ $enquiry->enquirer_email }}</p>
                    </div>
                </div>

                <!-- Information Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Contact Information Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 info-card">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Contact Information</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Mobile:</span>
                                <span class="text-gray-900">{{ $enquiry->enquirer_mobile }}</span>
                            </div>
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Email:</span>
                                <span class="text-gray-900">{{ $enquiry->enquirer_email }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 info-card">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Enquiry Status</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-gray-500">Status:</span>
                                    <button wire:click="toggleEnquiryStatus" class="ml-2 px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $enquiry->enquirer_status === 'enquired' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($enquiry->enquirer_status) }}
                                    </button>
                                </div>
                                <div>
                                    <span class="text-gray-500">Checked:</span>
                                    <button class="ml-2 px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $enquiry->enquirer_check ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $enquiry->enquirer_check ? 'Yes' : 'No' }}
                                    </button>
                                </div>
                            </div>
                            <div class="flex">
                                <span class="text-gray-500 w-32 flex-shrink-0">Submitted:</span>
                               @if($enquiry->created_at)
                                {{ $enquiry->created_at->format('F j, Y g:i A') }}
                            @else
                                <span class="text-gray-400 italic">N/A</span>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Message Section -->
                <div class="mt-6" >
                    <div class="bg-green-50 rounded-xl p-6 border border-green-100 problem-description">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <h3 class="ml-3 text-lg font-medium text-gray-900">Enquiry Message</h3>
                        </div>
                        <div class="prose max-w-none text-gray-700">
                            <p class="whitespace-pre-line">{{ $enquiry->enquirer_message ?? 'No message provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
