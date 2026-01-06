<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-slow hover:shadow-2xl">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-5 sm:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit Hospital Information</h2>
                        <p class="mt-1 text-blue-100">Update the required fields</p>
                    </div>
                    <a href="{{ route('hospitals.index') }}"
                       class="mt-4 sm:mt-0 inline-flex items-center px-5 py-3 border border-transparent text-base font-medium rounded-full text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Back to List
                    </a>
                </div>
            </div>

            <!-- Form Content -->
            <div class="px-6 py-8 sm:p-10">
                <form wire:submit.prevent="save" class="space-y-8">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Hospital Name -->
                            <div class="group relative">
                                <label for="hospital_name" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Hospital Name <span class="text-red-500">*</span></label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" wire:model="hospital_name" id="hospital_name"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                           placeholder="Hospital Name">
                                </div>
                                @error('hospital_name')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="group relative">
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">City <span class="text-red-500">*</span></label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" wire:model="city" id="city"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                           placeholder="Enter City">
                                </div>
                                @error('city')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="group relative">
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">State <span class="text-red-500">*</span></label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" wire:model="state" id="state"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                           placeholder="Enter State">
                                </div>
                                @error('state')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Contact Number -->
                            <div class="group relative">
                                <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Contact Number</label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                    </div>
                                    <input type="text" wire:model="contact_number" id="contact_number"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                           placeholder="Enter Phone Number">
                                </div>
                                @error('contact_number')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Specialties -->
                            <div class="group relative" x-data="{ open: false }" @click.away="open = false">
                                <label for="specialtySearch" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Specialties <span class="text-red-500">*</span></label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text"
                                        wire:model.debounce.300ms="specialtySearch"
                                        x-on:click="open = true"
                                        id="specialtySearch"
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                        placeholder="Click to select specialties or search..."
                                        autocomplete="off">
                                </div>

                                <!-- Selected Specialties -->
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach($selectedSpecialties as $index => $specialtyId)
                                        @php
                                            $specialty = \App\Models\Specialty::find($specialtyId);
                                        @endphp
                                        @if($specialty)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-sm font-medium">
                                                {{ $specialty->name }}
                                                <button type="button"
                                                        wire:click="removeSpecialty({{ $index }})"
                                                        class="ml-1.5 inline-flex items-center justify-center h-4 w-4 rounded-full text-blue-600 hover:bg-blue-200 hover:text-blue-900 focus:outline-none focus:bg-blue-200">
                                                    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                                                        <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
                                                    </svg>
                                                </button>
                                            </span>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Specialty Dropdown -->
                                <div x-show="open" x-transition class="mt-1 w-full bg-white rounded-lg shadow-lg border border-gray-200 z-10 absolute">
                                    <div class="p-2 border-b border-gray-200">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox"
                                                wire:model="selectAllSpecialties"
                                                wire:click="toggleSelectAll"
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm font-medium text-gray-700">Select All</span>
                                        </label>
                                    </div>
                                    <ul class="py-1 max-h-60 overflow-auto">
                                        @foreach($specialtyResults as $specialty)
                                            <li wire:key="specialty-{{ $specialty['id'] }}"
                                                class="px-4 py-2 hover:bg-blue-50 cursor-pointer transition-colors duration-150 flex items-center"
                                                wire:click.stop="selectSpecialty({{ $specialty['id'] }})">
                                                <input type="checkbox"
                                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mr-2"
                                                    {{ in_array($specialty['id'], $selectedSpecialties) ? 'checked' : '' }}>
                                                <span class="block truncate font-medium">{{ $specialty['name'] }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                @error('selectedSpecialties')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="group relative">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Hospital Image</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg group-focus-within:border-blue-500 group-focus-within:ring-2 group-focus-within:ring-blue-200 transition-all duration-300">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload a file</span>
                                                <input type="file" wire:model="image" id="image" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                                @if($image)
                                    <div class="mt-4 flex justify-center">
                                        <img src="{{ $image->temporaryUrl() }}" class="h-48 w-auto rounded-lg shadow-md border border-gray-200">
                                    </div>
                                @elseif($currentImage)
                                    <div class="mt-4 flex justify-center">
                                        <img src="{{ asset('storage/'.$currentImage) }}" class="h-48 w-auto rounded-lg shadow-md border border-gray-200">
                                    </div>
                                @endif
                                @error('image')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-center">
                                <div class="flex items-center h-5">
                                    <input wire:model="is_active" id="is_active" type="checkbox" class="focus:ring-blue-500 h-6 w-6 text-blue-600 border-gray-300 rounded transition-colors duration-300">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_active" class="font-medium text-gray-700">Active Hospital</label>
                                    <p class="text-gray-500">Check to make this hospital visible in listings</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rich Text Editor -->
                    <div class="group" wire:ignore>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2 transition-all duration-300 group-focus-within:text-indigo-600">About Hospital</label>
                        <textarea wire:model="description" id="description" rows="10"
                                  class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 placeholder-gray-400 input-highlight"
                                  placeholder="Detailed description about the hospital...">{!! $description !!}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit"
                                class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105">
                            <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg wire:loading.remove wire:target="save" class="-ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                            </svg>
                            Update Hospital
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Decorative Elements (Optional) -->
        <div class="hidden lg:block fixed bottom-0 left-0 w-32 h-32 bg-blue-200 rounded-full filter blur-3xl opacity-20 -z-10 animate-float"></div>
        <div class="hidden lg:block fixed top-1/4 right-0 w-48 h-48 bg-blue-100 rounded-full filter blur-3xl opacity-20 -z-10 animate-float" style="animation-delay: 2s;"></div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        // Initialize TinyMCE
        const initEditor = () => {
            tinymce.init({
                selector: '#description',
                plugins: 'advlist autolink lists link image charmap preview anchor table code help wordcount',
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                height: 400,
                setup: function(editor) {
                    // Update Livewire when content changes
                    editor.on('change', function(e) {
                        @this.set('description', editor.getContent());
                    });
                    
                    // Handle Livewire model updates
                    Livewire.on('tinymce:update', (content) => {
                        if (content !== editor.getContent()) {
                            editor.setContent(content);
                        }
                    });
                },
                init_instance_callback: function(editor) {
                    // Set initial content
                    editor.setContent(@this.description || '');
                }
            });
        };

        // Initialize editor on page load
        initEditor();

        // Reinitialize editor when Livewire updates the DOM
        Livewire.hook('morph.updated', ({ el }) => {
            if (el.id === 'description') {
                tinymce.remove('#description');
                initEditor();
            }
        });

        // Clean up when component is removed
        Livewire.hook('component.removed', () => {
            tinymce.remove('#description');
        });
    });
</script>