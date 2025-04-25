@php
    $record = $getRecord();
    $icon = $getState();
    $color = $record->categoria->cor;
@endphp

<div style="background-color: {{ $color }}; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
    @svg($icon, 'w-5 h-5 text-white')
</div> 