<div>
    <h2 class="game-name">@lang('game.game_name')</h2>
    @livewire('user-name')

    <div class="choices">
        <div>
            <h3 class="choices__head">@lang('game.your_choice'):</h3>
            <div>
                @include('livewire.partials.btn-user', ['buttonName' => \App\Http\Livewire\Game::ROCK])
            </div>
            <div>
                @include('livewire.partials.btn-user', ['buttonName' => \App\Http\Livewire\Game::PAPER])
            </div>
            <div>
                @include('livewire.partials.btn-user', ['buttonName' => \App\Http\Livewire\Game::SCISSORS])
            </div>
        </div>

        <div>
            <h3 class="choices__head">@lang('game.opponent_choice'):</h3>
            <div>
                @include('livewire.partials.btn-opponent', ['buttonName' => \App\Http\Livewire\Game::ROCK])
            </div>
            <div>
                @include('livewire.partials.btn-opponent', ['buttonName' => \App\Http\Livewire\Game::PAPER])
            </div>
            <div>
                @include('livewire.partials.btn-opponent', ['buttonName' => \App\Http\Livewire\Game::SCISSORS])
            </div>

            @if (!$isGameEnded) @lang('game.opponent_note') @endif
        </div>
    </div>

    @if ($isGameEnded)
        <p class="user-result {{ $userResult }}">@lang('game.result_'. $userResult)</p>
    @endif
</div>
