<div>
    <x-jet-section-border />

    <!-- Manage Todos -->
    <div class="mt-10 sm:mt-0">
        <x-jet-action-section>
            <x-slot name="title">
                {{ __('Active TODOs') }} ({{ $user->todos_undone->count() }})
            </x-slot>

            <x-slot name="description">
                {{ __('All of your undone todos.') }}
            </x-slot>

            <!-- Todos List -->
            <x-slot name="content">
                <div class="space-y-6">
                    @foreach ($user->todos_undone->sortBy('title') as $todo)
                        @php
                        /** @var \App\Models\Todo $todo */
                        @endphp
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex items-start flex-col">
                                    <div class="ml-4">{{ $todo->title }}</div>
                                    <div class="ml-4 text-gray-500">{{ $todo->description }}</div>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <button class="ml-2 text-sm text-green-400" wire:click="markAsDone({{ $todo->id }})">
                                    {{ __('Done') }}
                                </button>

                                @can('delete', $todo)
                                    <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="delete('{{ $todo->id }}')">
                                        {{ __('Remove') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-slot>
        </x-jet-action-section>
    </div>

    @if ($user->todos_done->isNotEmpty())
        <x-jet-section-border />

        <!-- Manage Todos -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('Done TODOs') }} ({{ $user->todos_done->count() }})
                </x-slot>

                <x-slot name="description">
                    {{ __('All of your done todos.') }}
                </x-slot>

                <!-- Todos List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($user->todos_done->sortBy('title') as $todo)
                            @php
                            /** @var \App\Models\Todo $todo */
                            @endphp
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex items-start flex-col">
                                        <div class="ml-4">{{ $todo->title }}</div>
                                        <div class="ml-4 text-gray-500">{{ $todo->description }}</div>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <button class="ml-2 text-sm text-green-400" wire:click="markAsUndone({{ $todo->id }})">
                                        {{ __('Undone') }}
                                    </button>

                                    @can('delete', $todo)
                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="delete('{{ $todo->id }}')">
                                            {{ __('Remove') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    @if ($user->todos_trashed->isNotEmpty())
        <x-jet-section-border />

        <!-- Manage Trashed Todos -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('Deleted TODOs') }} ({{ $user->todos_trashed->count() }})
                </x-slot>

                <x-slot name="description">
                    {{ __('All of your deleted todos.') }}
                </x-slot>

                <!-- Todos List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($user->todos_trashed->sortBy('title') as $todo)
                            @php
                            /** @var \App\Models\Todo $todo */
                            @endphp
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex items-start flex-col">
                                        <div class="ml-4">
                                            {{ $todo->title }}
                                            (@if($todo->done) &checkmark; @else &times; @endif)
                                        </div>
                                        <div class="ml-4 text-gray-500">{{ $todo->description }}</div>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <button class="ml-2 text-sm text-green-400" wire:click="restore({{ $todo->id }})">
                                        {{ __('Restore') }}
                                    </button>

                                    @can('delete', $todo)
                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none" wire:click="confirmFinalDelete({{ $todo->id }})">
                                            {{ __('Remove completely') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    <!-- Remove Team Member Confirmation Modal -->
    <x-jet-confirmation-modal wire:model="confirmingFinalDelete">
        <x-slot name="title">
            {{ __('Completely remove todo') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to remove this todo completely?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingFinalDelete')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="finalDelete()" wire:loading.attr="disabled">
                {{ __('Yes, remove') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>
