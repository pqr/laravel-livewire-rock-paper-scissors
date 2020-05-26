<button wire:click="choose('{{ $buttonName }}')"
        @if ($userChoice) disabled @endif

        class="btn btn-user-{{$buttonName}}
@if ($userChoice === $buttonName) btn_choosen {{ $userResult }} @endif
@if ($userChoice) btn_disabled @else btn_active @endif
    "
>
    @lang('game.' . $buttonName)
</button>
