<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-slow hover:shadow-2xl">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-5 sm:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit Specialty</h2>
                        <p class="mt-1 text-blue-100">Update the specialty information</p>
                    </div>
                    <a href="{{ route('specialties.index') }}"
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
                            <!-- Name -->
                            <div class="group relative">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Name <span class="text-red-500">*</span></label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 0v12h8V4H6z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" wire:model="name" id="name"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                           placeholder="Specialty Name">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="group relative">
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Slug <span class="text-red-500">*</span></label>
                                <div class="relative rounded-lg shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" wire:model="slug" id="slug"
                                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                           placeholder="specialty-slug">
                                </div>
                                @error('slug')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Logo Image Upload -->
                            <div class="group relative">
                                <label for="logo_image" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Logo Image</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg group-focus-within:border-blue-500 group-focus-within:ring-2 group-focus-within:ring-blue-200 transition-all duration-300">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="logo_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload a file</span>
                                                <input type="file" wire:model="logo_image" id="logo_image" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @if($logo_image)
                                    <div class="mt-4 flex justify-center" data-aos="zoom-in">
                                        <img src="{{ $logo_image->temporaryUrl() }}" class="h-24 w-auto rounded-lg shadow-md border border-gray-200">
                                    </div>
                                @elseif($currentLogoImage)
                                    <div class="mt-4 flex justify-center" data-aos="zoom-in">
                                        <img src="{{ asset('storage/'.$currentLogoImage) }}" class="h-24 w-auto rounded-lg shadow-md border border-gray-200">
                                        <button type="button" wire:click="removeLogo" class="ml-2 text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                                @error('logo_image')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Meta Title -->
                            <div class="group relative">
                                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Meta Title</label>
                                <input type="text" wire:model="meta_title" id="meta_title"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                       placeholder="SEO title for search engines">
                                @error('meta_title')
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
                            <!-- Main Image Upload -->
                            <div class="group relative">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Main Image</label>
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
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                @if($image)
                                    <div class="mt-4 flex justify-center" data-aos="zoom-in">
                                        <img src="{{ $image->temporaryUrl() }}" class="h-48 w-auto rounded-lg shadow-md border border-gray-200">
                                    </div>
                                @elseif($currentImage)
                                    <div class="mt-4 flex justify-center" data-aos="zoom-in">
                                        <img src="{{ asset('storage/'.$currentImage) }}" class="h-48 w-auto rounded-lg shadow-md border border-gray-200">
                                        <button type="button" wire:click="removeImage" class="ml-2 text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
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

                            <!-- Meta Description -->
                            <div class="group relative">
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Meta Description</label>
                                <textarea wire:model="meta_description" id="meta_description" rows="3"
                                          class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                          placeholder="SEO description for search engines"></textarea>
                                @error('meta_description')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Meta Keywords -->
                            <div class="group relative">
                                <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1 transition-all duration-300 group-focus-within:text-blue-600">Meta Keywords</label>
                                <input type="text" wire:model="meta_keywords" id="meta_keywords"
                                       class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 placeholder-gray-400"
                                       placeholder="Comma separated keywords for SEO">
                                @error('meta_keywords')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
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
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Update Specialty
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
