<div>
    <h1>Welcome to the game</h1>
    @livewire('user-name')

    <div class="choices">
        <div>
            <h3 class="choices__head">Your choice:</h3>
            <div>
                @include('livewire.partials.user-button', ['buttonName' => 'Rock'])
            </div>
            <div>
                @include('livewire.partials.user-button', ['buttonName' => 'Paper'])
            </div>
            <div>
                @include('livewire.partials.user-button', ['buttonName' => 'Scissors'])
            </div>
        </div>

        <div>
            <h3 class="choices__head">Opponent choice:</h3>
            <div>
                @include('livewire.partials.opponent-button', ['buttonName' => 'Rock'])
            </div>
            <div>
                @include('livewire.partials.opponent-button', ['buttonName' => 'Paper'])
            </div>
            <div>
                @include('livewire.partials.opponent-button', ['buttonName' => 'Scissors'])
            </div>

            @if (!$gameEnded) Opponent choice hidden @endif
        </div>
    </div>

    <p class="game-result">{{ $userResult }}</p>
</div>
