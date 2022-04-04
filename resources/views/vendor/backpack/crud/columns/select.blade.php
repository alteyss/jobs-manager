{{-- single relationships (1-1, 1-n) --}}
@php
    $column['attribute'] = $column['attribute'] ?? (new $column['model'])->identifiableAttribute();
    $column['value'] = $column['value'] ?? $crud->getRelatedEntriesAttributes($entry, $column['entity'], $column['attribute']);
    $column['escaped'] = $column['escaped'] ?? true;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['limit'] = $column['limit'] ?? 32;

    if($column['value'] instanceof \Closure) {
        $column['value'] = $column['value']($entry);
    }

    foreach ($column['value'] as &$value) {
        $value = Str::limit($value, $column['limit'], '…');
    }

    $is_state = $column['entity'] == 'state';
@endphp

<span>
    @if(count($column['value']))
        {{ $column['prefix'] }}
        @foreach($column['value'] as $key => $text)
            @php
                $related_key = $key;
            @endphp

            @if($is_state)
                @php
                    $state = $crud->getRelatedEntriesAttributes($entry, $column['entity'], 'color');
                @endphp
                @foreach($state as $key => $color)
                    <span class="d-inline-flex" style="color: {!! $color !!}; font-weight: bold;">
                        @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
                            @if($column['escaped'])
                                {{ $text }}
                            @else
                                {!! $text !!}
                            @endif
                        @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')

                        @if(!$loop->last), @endif
                    </span>
                @endforeach
            @else
                <span class="d-inline-flex">
                    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
                        @if($column['escaped'])
                            {{ $text }}
                        @else
                            {!! $text !!}
                        @endif
                    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')

                    @if(!$loop->last), @endif
                </span>
            @endif
        @endforeach
        {{ $column['suffix'] }}
    @else
        {{ $column['default'] ?? '-' }}
    @endif
</span>
