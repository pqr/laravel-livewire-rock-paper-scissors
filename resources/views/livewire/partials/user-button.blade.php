<button wire:click="choose('{{ $buttonName }}')"
        @if ($userChoice) disabled @endif

    class="btn btn-user
    @if ($userChoice === $buttonName) btn_choosen {{ $userResult }} @endif
    @if ($userChoice) btn_disabled @else btn-user_active @endif


"
>
    {{ $buttonName }}
</button>
