<button wire:click="choose('{{ $buttonName }}')"
        @if ($player1Choice) disabled @endif

        class="btn btn-user-{{$buttonName}}
@if ($player1Choice === $buttonName) btn_choosen {{ $player1Result }} @endif
@if ($player1Choice) btn_disabled @else btn_active @endif
    "
>
    @lang('game.' . $buttonName)
</button>
