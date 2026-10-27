<x-layouts.admin :title="$title ?? 'Admin Panel'">
    @if(isset($pageHeader))
        <x-slot:pageHeader>
            {{ $pageHeader }}
        </x-slot:pageHeader>
    @endif

    {{ $slot }}
</x-layouts.admin>
