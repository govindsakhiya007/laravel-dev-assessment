<div>
    <div class="container mx-auto py-4">
        @if(Session::has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <div class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ Session::get('success') }}</span>
                    </div>
                </div>
            </div>
        @endif
        @if(Session::has('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                    <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ Session::get('error') }}</span>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Create new job posting</h1>
        </div>

        <form wire:submit.prevent="saveJob" class="grid grid-cols-3 gap-4 bg-white p-4 rounded shadow-md">
            
            <div class="col-span-2">
                <h2 class="text-lg font-semibold mb-4 bg-gray-100 px-4 py-2">Job details</h2>
                <div class="bg-white rounded shadow-md p-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input type="text" wire:model="title" class="w-full rounded-lg border-gray-300 focus:ring-blue-500" placeholder="Enter job posting title">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea wire:model="description" class="w-full rounded-lg border-gray-300 focus:ring-blue-500" placeholder="Job posting description"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Experience</label>
                            <input type="text" wire:model="experience" class="w-full rounded-lg border-gray-300 focus:ring-blue-500" placeholder="Eg. 1-3 Yrs">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Salary</label>
                            <input type="text" wire:model="salary" class="w-full rounded-lg border-gray-300 focus:ring-blue-500" placeholder="Eg. 2.75-5 Lacs PA">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Location</label>
                            <input type="text" wire:model="location" class="w-full rounded-lg border-gray-300 focus:ring-blue-500" placeholder="Eg. Remote / Pune">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Extra Info</label>
                            <input type="text" wire:model="extra_info" class="w-full rounded-lg border-gray-300 focus:ring-blue-500" placeholder="Eg. Full Time, Urgent, Part Time">
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <h2 class="text-lg font-semibold mb-4 bg-gray-100 px-4 py-2">Company details</h2>
                <div class="bg-white rounded shadow-md p-4">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" wire:model="company_name" class="w-full rounded-lg border-gray-300 focus:ring-blue-500">
                        @error('company_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4"></
                </div>
            </div>
            
        </form>
    </div>
</div>
