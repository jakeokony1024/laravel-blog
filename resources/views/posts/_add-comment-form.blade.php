@auth
    <x-panel>
        <form method="POST" action="/posts/{{ $post->slug }}/comments">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/40?u={{ auth()->id() }}" alt="avatar" width="40" height="40"
                     class="rounded-full mr-3">
                <h2>Want to Participate?</h2>
            </header>

            <div class="mt-6">
                <textarea
                    name="body"
                    class="w-full text-xs focus:outline-none focus:ring"
                    rows="5"
                    placeholder="Quick think of something to say!"
                    required
                ></textarea>
                @error('body')
                <span class="text-xs text-red-700">{{ $message }}</span>
                @enderror
                <div class="flex justify-end mt-6 border-t border-gray-200 pt-6">
                    <x-form.button>Post</x-form.button>
                </div>
            </div>
        </form>
    </x-panel>
@else
    <p class="font-semibold mt-6">
        <a class="hover:underline text-blue-500" href="/register">Register</a>
        or
        <a class="hover:underline text-blue-500" href="/login">Login</a>
        to leave a comment.
    </p>
@endauth
