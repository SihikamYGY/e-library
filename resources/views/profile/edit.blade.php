@extends('layouts.user')

@section('content')
    <section class="max-w-6xl mx-auto px-4 py-10 space-y-8">

        {{-- HEADER --}}
        <div>
            <h1 class="text-3xl font-semibold">Account & Security</h1>
            <p class="text-gray-500 text-sm mt-1">
                Manage your profile, security, and active sessions
            </p>
        </div>

        {{-- GRID --}}
        <div class="grid md:grid-cols-3 gap-6">

            {{-- LEFT: SECURITY OVERVIEW --}}
            <div class="space-y-4">

                {{-- PROFILE CARD --}}
                <div class="bg-white border rounded-xl p-5 text-center">

                    <img src="{{ auth()->user()->avatar
                        ? asset('storage/' . auth()->user()->avatar)
                        : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                        class="w-20 h-20 mx-auto rounded-full object-cover border mb-3">

                    <h2 class="text-sm font-semibold">
                        {{ auth()->user()->name }}
                    </h2>

                    <p class="text-xs text-gray-400">
                        {{ auth()->user()->email }}
                    </p>

                    <div class="mt-4 text-xs text-gray-500 space-y-1">
                        <p>Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                    </div>

                </div>

                {{-- SECURITY SCORE --}}
                <div class="bg-white border rounded-xl p-5">

                    <h3 class="text-sm font-semibold mb-3">Security Score</h3>

                    <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                        <div class="bg-black h-2 rounded-full" style="width: 80%"></div>
                    </div>

                    <p class="text-xs text-gray-500">
                        Your account is in good condition
                    </p>

                </div>

                {{-- QUICK STATUS --}}
                <div class="bg-white border rounded-xl p-5 space-y-3">

                    <div class="flex justify-between text-xs">
                        <span class="text-gray-500">Status</span>
                        <span class="text-green-600 font-medium">Active</span>
                    </div>

                    <div class="flex justify-between text-xs">
                        <span class="text-gray-500">2FA</span>
                        <span class="text-gray-400">Not enabled</span>
                    </div>

                    <div class="flex justify-between text-xs">
                        <span class="text-gray-500">Sessions</span>
                        <span class="text-gray-400">1 device</span>
                    </div>

                </div>

            </div>

            {{-- RIGHT: SETTINGS --}}
            <div class="md:col-span-2 space-y-6">

                {{-- PROFILE SETTINGS --}}
                <div class="bg-white border rounded-xl p-6">
                    <h2 class="text-sm font-semibold mb-4">Profile Information</h2>
                    @include('profile.partials.update-profile-information-form')
                </div>

                {{-- PASSWORD --}}
                <div class="bg-white border rounded-xl p-6">
                    <h2 class="text-sm font-semibold mb-4">Password & Security</h2>
                    @include('profile.partials.update-password-form')
                </div>

                {{-- ACTIVE SESSIONS (NEW SAAS FEATURE) --}}
                <div class="bg-white border rounded-xl p-6">

                    <h2 class="text-sm font-semibold mb-4">Active Sessions</h2>

                    <div class="space-y-3 text-sm">

                        <div class="flex justify-between items-center border rounded-lg p-3">
                            <div>
                                <p class="text-xs font-medium">Chrome - Windows</p>
                                <p class="text-xs text-gray-400">Bandung, Indonesia</p>
                            </div>
                            <span class="text-xs text-green-600">Current</span>
                        </div>

                    </div>

                </div>

                {{-- DANGER ZONE --}}
                <div class="bg-red-50 border border-red-200 rounded-xl p-6">

                    <h2 class="text-sm font-semibold text-red-700 mb-1">
                        Danger Zone
                    </h2>

                    <p class="text-xs text-red-500 mb-4">
                        Permanently delete your account and all data
                    </p>

                    @include('profile.partials.delete-user-form')

                </div>

            </div>

        </div>

    </section>
@endsection
