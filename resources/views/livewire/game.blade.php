<div wire:poll>
    <a href="{{ route('lobby') }}" class="lobby-link">@lang('game.back_to_lobby')</a>

    <h2 class="game-name">@lang('game.game_name')</h2>
    @livewire('user-name')

    {{ \Illuminate\Support\Facades\Auth::user() }}

    <div class="choices">
        <div>

            @if($isMine)
                <h3 class="choices__head">@lang('game.your_choice'):</h3>
                @include('livewire.partials.buttons-user')
            @else
                <h3 class="choices__head">@lang('game.player1_choice'):</h3>
                @include('livewire.partials.buttons-opponent', ['choice' => $player1Choice, 'result' => $player1Result])
            @endif
        </div>

        <div>
            <h3 class="choices__head">
                @if($isMine)
                    @lang('game.opponent_choice'):
                @else
                    @lang('game.player2_choice'):
                @endif
            </h3>
            @include('livewire.partials.buttons-opponent', ['choice' => $player2Choice, 'result' => $player2Result])

            @if (!$gameover && $isMine) @lang('game.opponent_note') @endif
        </div>
    </div>

    @if ($gameover && $isMine)
        <p class="user-result {{ $player1Result }}">@lang('game.result_'. $player1Result)</p>
    @endif
</div>
