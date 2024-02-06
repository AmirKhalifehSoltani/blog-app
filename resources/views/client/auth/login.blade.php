<div>
{{--    @if (count($errors))--}}
{{--        <ul>--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    @endif--}}

    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
    <form method="POST" action="{{ route('do_login') }}">
        @csrf
        <label for="email">Email</label>
        <input id="email"
               name="email"
               type="text"
               class="@error('email') is-invalid @enderror">

        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="password">Password</label>
        <input id="password"
               name="password"
               type="password"
               class="@error('password') is-invalid @enderror">

        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit">Login</button>
    </form>
</div>
