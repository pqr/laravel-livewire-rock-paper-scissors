<button wire:click="choose('{{ $buttonName }}')"
        @if ($userChoice) disabled @endif

    class="btn
    @if ($userChoice === $buttonName) btn_choosen {{ $userResult }} @endif
    @if ($userChoice) btn_disabled @else btn_active @endif


"
>
    {{ $buttonName }}
</button>
