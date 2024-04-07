<div x-data="{ chat: false, selectedPerson: '', idSelected: null }" class="fixed bottom-0 right-0 mr-10 mb-20 flex flex-row z-50">
    <div x-show="chat && selectedPerson !== ''" class="bg-dark-green p-2 h-[250px] w-[200px]">
        <p class="text-light-green text-1xl" x-text="'Personne sélectionnée : ' + selectedPerson"></p>
        <form action="{{ route('send_message', ['id' => '$idSelected']) }}" method="POST">
            @csrf
            <button type="submit">Envoyer</button>
        </form>
        <p @click="selectedPerson = ''" >
            dqdfsqdsf
        </p>
    </div>
    <template x-if="chat">
        <div class="flex flex-row">
            <div>
                @foreach($amis as $key => $information)
                <div class="flex flex-row gap-10 odd:bg-middle-light-green even:bg-green w-[200px] px-4 py-1">
                    <p class="w-[50px]" x-on:click="selectedPerson = '{{ $information->name }}'; idSelected = '{{ $information->id }}'">{{ $information->name }}</p>
                    <template x-if="{{ $key }} === 0">
                        <div @click="chat = !chat" class="ml-auto">
                            FERMER
                        </div>
                    </template>
                </div>
            @endforeach            
            </div>
        </div>
    </template>
    <div class="bg-dark-green p-2" x-show="!chat">
        <p @click="chat = !chat" class="text-light-green text-1xl">
            CHAT
        </p>
    </div>
</div>
