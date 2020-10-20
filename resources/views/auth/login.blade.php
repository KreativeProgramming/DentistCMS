<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased mt-auto mb-auto align-middle">

        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 border-0">
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <div class="text-gray-500 text-center mb-3 font-bold">
                                <h4>Sign in</h4>
                            </div>
                            <form method="POST" action="{{route('login')}}">
                                @csrf
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Email
                                    </label>
                                    <input type="email"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                        placeholder="Email" name="email" id="email" />
                                </div>

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                        htmlFor="grid-password">
                                        Password
                                    </label>
                                    <input type="password"
                                        class="px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:shadow-outline w-full ease-linear transition-all duration-150"
                                        placeholder="Password" name="password" id="password" />
                                </div>
                                <div>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input id="customCheckLogin" type="checkbox"
                                            class="form-checkbox text-gray-800 ml-1 w-5 h-5 ease-linear transition-all duration-150"
                                            name="remember" />
                                        <span class="ml-2 text-sm font-semibold text-gray-700">
                                            Remember me
                                        </span>
                                    </label>
                                </div>

                                <div class="text-center mt-6">
                                    <button
                                        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                                        type="submit">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-6 relative">
                        <div class="w-1/2">
                            <a href="javascript:void(0)" class="text-gray-300">
                                <small>Forgot password?</small>
                            </a>
                        </div>
                        <div class="w-1/2 text-right">
                            <router-link to="/auth/register" class="text-gray-300">
                                <small>Create new account</small>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>