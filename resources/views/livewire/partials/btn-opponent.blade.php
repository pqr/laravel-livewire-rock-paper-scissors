<button disabled
        class="btn btn_disabled btn-opponent-{{$buttonName}}
        @if ($buttonName === $choice) btn_choosen  {{ $result }}  @endif
            "
>
    @lang('game.' . $buttonName)
</button>
