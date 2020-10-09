<x-jet-form-section submit="createTodo">
    <x-slot name="title">
        {{ __('Create a new todo') }}
    </x-slot>

    <x-slot name="description"></x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="title" value="{{ __('Title') }}" />
            <x-jet-input
                id="title"
                type="text"
                class="mt-1 block w-full"
                wire:model.defer="state.title"
                required
                autofocus
            />
            <x-jet-input-error for="title" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="description" value="{{ __('Description') }}" />
            <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="state.description" />
            <x-jet-input-error for="description" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>
            {{ __('Add') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
