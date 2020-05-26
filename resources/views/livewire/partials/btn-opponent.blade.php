<button disabled
        class="btn btn_disabled btn-opponent-{{$buttonName}}
        @if ($isGameEnded && $buttonName === $opponentChoice) btn_choosen  {{ $opponentResult }}  @endif
            "
>
    @lang('game.' . $buttonName)
</button>
