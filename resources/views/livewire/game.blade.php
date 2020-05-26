<div>
    <h2>Welcome to the game</h2>
    @livewire('user-name')

    <div class="choices">
        <div>
            <h3 class="choices__head">Your choice:</h3>
            <div>
                @include('livewire.partials.btn-user', ['buttonName' => 'Rock'])
            </div>
            <div>
                @include('livewire.partials.btn-user', ['buttonName' => 'Paper'])
            </div>
            <div>
                @include('livewire.partials.btn-user', ['buttonName' => 'Scissors'])
            </div>
        </div>

        <div>
            <h3 class="choices__head">Opponent choice:</h3>
            <div>
                @include('livewire.partials.btn-opponent', ['buttonName' => 'Rock'])
            </div>
            <div>
                @include('livewire.partials.btn-opponent', ['buttonName' => 'Paper'])
            </div>
            <div>
                @include('livewire.partials.btn-opponent', ['buttonName' => 'Scissors'])
            </div>

            @if (!$gameEnded) Opponent choice hidden @endif
        </div>
    </div>

    <p class="user-result">{{ $userResult }}</p>
</div>
