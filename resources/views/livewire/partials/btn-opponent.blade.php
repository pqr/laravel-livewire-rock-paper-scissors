<button disabled
        class="btn btn_disabled btn-opponent-{{$buttonName}}
        @if ($gameover && $buttonName === $opponentChoice) btn_choosen  {{ $opponentResult }}  @endif
            "
>
    @lang('game.' . $buttonName)
</button>
