<section class="px-4 flex flex-col overflow-auto ">
    <div class="sticky top-0 bg-white z-40 w-min">
        <section class="presence-row">
            <div class="grid grid-cols-4 pr-2">
                <button wire:click="previousWeek()"
                        class="col-span-1 p-2 flex items-center justify-center rounded-md hover:bg-gray-100">
                    <x-heroicon-o-chevron-double-left/>
                </button>
                <section class="col-span-2 flex flex-col justify-center items-center ">
                    <span>{{ $firstDayOfWeek->translatedFormat('M') }}</span>
                    <span>{{ $firstDayOfWeek->day }}-{{ $this->lastDayOfWeek->day }}</span>
                </section>
                <button wire:click="nextWeek()"
                        class="col-span-1 p-2 flex items-center justify-center rounded-md hover:bg-gray-100">
                    <x-heroicon-o-chevron-double-right/>
                </button>
            </div>
            @foreach($this->daysOfWeek as $day)
                <section class="px-2">
                    <div class="presence-ceil flex-col p-2 @if($day->isToday()) font-bold text-blue-600 @endif">
                        <span>{{ $day->translatedFormat('l') }}</span>
                        <span>{{ $day->translatedFormat('d') }}</span>
                    </div>
                </section>
            @endforeach
        </section>
        <section class="presence-row self-presence-row mb-2 rounded-xl shadow-lg">
            <section class="p-4 flex justify-center flex-col gap-2">
                <span>{{$me->name }}</span>
                <section class="grid grid-rows-2 gap-1">
                    <button
                        class="col-span-1 -ml-2 p-2 flex gap-1 items-center justify-start rounded-md hover:bg-gray-100"
                        wire:click="fillWithDefaultWeek()"
                        title="Remplir avec la semaine type">
                        <x-heroicon-o-calendar-days class="icon"/>
                        <span>Remplir</span>
                    </button>
                    <button
                        class="col-span-1 -ml-2 p-2 flex gap-1 items-center justify-start rounded-md hover:bg-gray-100"
                        wire:click="clearWeek()">
                        <x-heroicon-o-calendar class="icon"/>
                        <span>Vider</span>
                    </button>
                </section>
            </section>
            @foreach($me->presencesOfWeek($this->daysOfWeek) as $presence)
                <livewire:presence-card :user="$me" :presence="$presence"
                                        :wire:key="'presence-'.Str::orderedUuid()"/>
            @endforeach
        </section>

        <section class="presence-row">
            <section class="pt-6 pb-4 px-2 flex items-center font-bold">
                Total
            </section>

            @foreach($this->daysOfWeek as $day)
                <livewire:presence-resume :day="$day" :wire:key="'resume-'.Str::orderedUuid()"/>
            @endforeach
        </section>
    </div>

    @foreach($otherUsers as $user)
        <section class="presence-row">
            <span class="p-4 flex items-center">{{$user->name }}</span>
            @foreach($user->presencesOfWeek($this->daysOfWeek) as $presence)
                <livewire:presence-card :user="$user" :presence="$presence"
                                        :wire:key="'presence-'.Str::orderedUuid()"/>
            @endforeach
        </section>
    @endforeach
</section>
