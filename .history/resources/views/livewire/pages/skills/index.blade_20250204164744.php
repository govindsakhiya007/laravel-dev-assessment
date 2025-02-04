<div>
    <div class="container mx-auto py-4">
        @if(Session::has('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ Session::get('success')</span>
                </div>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Danger alert!</span> Change a few things up and try submitting again.
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="alert alert-error">{{ Session::get('error') }}</div>
        @endif
        
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Skills</h1>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="lg:col-span-2 bg-white rounded shadow-md p-4">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 text-left font-semibold">Name</th>
                            <th class="px-4 py-2 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($skills as $skill)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $skill->name }}</td>
                                <td class="px-4 py-2 text-right">
                                    <button wire:click="editSkill({{ $skill->id }})" class="text-blue-500 hover:underline mr-2">Edit</button>
                                    <button wire:click="deleteSkill({{ $skill->id }})" class="text-red-500 hover:underline">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-2 text-center">There are no skills available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Add/Edit Form -->
            <div class="bg-white rounded shadow-md p-4">
                <h2 class="text-lg font-semibold mb-4">{{ $skillId ? 'Update skill' : 'Add new skill' }}</h2>
                <form wire:submit="save">
                    <div class="mb-4">
                        <input type="text" wire:model="name" placeholder="Enter skill name" class="border rounded p-2 w-full mr-2 focus:outline-none">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">
                        {{ $skillId ? 'Update' : 'Create' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
