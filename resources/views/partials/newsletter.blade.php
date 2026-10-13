<form x-data="newsletter(@js(['publicKey' => $publicKey, 'listId' => $listId]))" @submit.prevent="submit" class="flex flex-col gap-2">
    <label for="newsletter-email" class="text-[15px] text-frost">{{ $label ?: __('Product news and tips, once a month.', 'radicle') }}</label>

    <div x-show="status !== 'success'" class="flex flex-wrap gap-2 rounded-full bg-white/10 p-1.5">
        <input
            id="newsletter-email"
            type="email"
            name="email"
            x-model="email"
            required
            autocomplete="email"
            placeholder="you@agency.com"
            class="min-h-12 min-w-0 flex-[1_1_180px] rounded-full border-0 bg-transparent px-[18px] text-white placeholder:text-frost/70 focus:outline-2 focus:outline-white/40"
        >
        <button type="submit" :disabled="status === 'loading'" class="min-h-12 cursor-pointer rounded-full border-0 bg-brand px-6 font-bold text-white transition-colors hover:bg-brand-dark disabled:opacity-60">
            {{ __('Subscribe', 'radicle') }}
        </button>
    </div>

    <p x-show="status === 'success'" x-cloak role="status" class="m-0 font-medium text-sun">{{ __('Thanks! Check your inbox to confirm.', 'radicle') }}</p>
    <p x-show="status === 'error'" x-cloak role="alert" class="m-0 text-sm text-sun">{{ __('Something went wrong. Please try again.', 'radicle') }}</p>
</form>
