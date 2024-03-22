<div x-data="{ chat: false }" class="fixed bottom-0 right-0 mr-10 mb-20 flex flex-row">
    <div @click=" chat = !chat " class=" bg-blue-600">
        <p>
            CHAT
        </p>
    </div>
    <div x-show="chat" class="bg-blue-700">
        @foreach($amis as $information)
            <div class="flex flex-row gap-20">
                <p class="w-[50px]">{{ $information->name}}</p>
            </div>
        @endforeach
    </div>
</div>




    