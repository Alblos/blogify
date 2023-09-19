<div class="flex items-center gap-2">
    <input type="checkbox" name="like" id="like" class="hidden" checked="{{ $liked }}">
    <label for="like" class="checked:fill-black fill-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fill-inherit stroke-black">
            <path
                d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
        </svg>
    </label>
    {{ $likes }}
</div>
