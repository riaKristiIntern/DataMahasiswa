@extends('components.layout')

@section('title', 'Login')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm mx-auto">
    <h1 class="text-2xl font-bold mb-4">Login</h1>

    @if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('login-process') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}"
                class="w-full border rounded-lg p-2" required placeholder="Enter your email">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" class="w-full border rounded-lg p-2" required placeholder="Enter your password">
                <span id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                    <!-- Hidden Icon -->
                    <svg id="eyeClosed" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                    </svg>

                    <!-- Visible Icon -->
                    <svg id="eyeOpen" class="w-6 h-6 text-gray-800 dark:text-white hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z" />
                        <path d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z" />
                        <path d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z" />
                    </svg>
                </span>
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Login</button>
    </form>
</div>

{{-- Toggle Password Visibility --}}
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        // Toggle password visibility
        const passwordType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', passwordType);

        // Toggle icon visibility
        if (passwordType === 'password') {
            eyeClosed.classList.remove('hidden');
            eyeOpen.classList.add('hidden');
        } else {
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }   
    });
</script>
@endsection