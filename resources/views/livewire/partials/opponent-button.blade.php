<button disabled
        class="btn btn_disabled
    @if ($gameEnded && $buttonName === $opponentChoice) btn_choosen @endif
"
>
    {{ $buttonName }}
</button>
