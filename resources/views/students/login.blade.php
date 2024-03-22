<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md w-96 flex flex-col items-center"> <!-- Added flex and flex-col classes -->
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQHJNtwBSFISEcJRgtMZ3IW2Tbi8nzqzK0wT0W-la4gJA&s" alt="Logo" class="mb-4 w-20 h-20 object-cover rounded-full"> <!-- Added image -->
            <h1 class="text-lg sm:text-xl md:text-2xl font-semibold mb-4">SAINT RITA'S HIGH SCHOOL</h1>
            <p class="text-gray-600 mb-6">— Mothurapur, Chatmohar, Pabna.</p>
            <form  class="w-full" action="{{ route('login.post.student') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">User ID</label>
                    <input type="text" id="user_id" name="user_id" class="mt-1 p-2 w-full border rounded-md focus:outline-none" required>
                    @if ($errors->has('user_id'))
                        <span class="text-danger">{{ $errors->first('user_id') }}</span>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md focus:outline-none" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Log In</button>
            </form>
            <p class="w-full text-sm text-gray-500 mt-4">Can’t access your account?</p>
        </div>
    </div>
</body>