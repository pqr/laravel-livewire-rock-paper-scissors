<button disabled
        class="btn btn_disabled
    @if ($gameEnded && $buttonName === $opponentChoice) btn_choosen  {{ $opponentResult }}  @endif
"
>
    {{ $buttonName }}
</button>
