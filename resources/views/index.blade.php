@extends('layout')

@section('content')

  <form class="max-w-xl m-auto p-14 bg-white rounded shadow-md" method="post">
    @csrf

    <h1 class="text-3xl text-center mb-14">Event ticket system</h1>

    @include('components.alert')

    <div class="mt-4">
      <label class="text-sm leading-loose text-gray-600" for="name">Name <span class="text-red-600 text-md">*</span></label>
      <input class="w-full px-5 py-3 text-gray-700 bg-gray-100 leading-none rounded @error('name') border border-red-500 @enderror" id="name" name="name" type="text" placeholder="Name" aria-label="Name" value="{{ old('name') }}">
    </div>

    <div class="mt-4">
      <label class="text-sm leading-loose text-gray-600" for="email">Email <span class="text-red-600 text-md">*</span></label>
      <input class="w-full px-5 py-3 text-gray-700 bg-gray-100 leading-none rounded @error('email') border border-red-500 @enderror" id="email" name="email" type="text" placeholder="Email" aria-label="Email" value="{{ old('email') }}">
    </div>

    <div class="mt-4">
      <label class="text-sm leading-loose text-gray-600" for="street">Address</label>
      <input class="w-full px-5 py-3 text-gray-700 bg-gray-100 leading-none rounded @error('street') border border-red-500 @enderror" id="street" name="street" type="text" placeholder="Street" aria-label="Street" value="{{ old('street') }}">
    </div>
    <div class="mt-2">
      <label class="hidden text-sm leading-loose text-gray-600" for="city">City</label>
      <input class="w-full px-5 py-3 text-gray-700 bg-gray-100 leading-none rounded @error('city') border border-red-500 @enderror" id="city" name="city" type="text" placeholder="City" aria-label="City" value="{{ old('city') }}">
    </div>
    <div class="inline-block mt-2 w-1/2 pr-1">
      <label class="hidden text-sm leading-loose text-gray-600" for="country">Country</label>
      <input class="w-full px-5 py-3 text-gray-700 bg-gray-100 leading-none rounded @error('country') border border-red-500 @enderror" id="country" name="country" type="text" placeholder="Country" aria-label="Country" value="{{ old('country') }}">
    </div>
    <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
      <label class="hidden text-sm leading-loose text-gray-600" for="zip">Zip</label>
      <input class="w-full px-5 py-3 text-gray-700 bg-gray-100 leading-none rounded @error('zip') border border-red-500 @enderror" id="zip"  name="zip" type="text" placeholder="Zip" aria-label="Zip" value="{{ old('zip') }}">
    </div>

    <div class="mt-4">
      <label class="text-sm leading-loose text-gray-600" for="type">Ticket type <span class="text-red-600 text-md">*</span></label>
      <select class="w-full px-5 py-3 text-gray-700 bg-gray-100 leading-none rounded @error('type') border border-red-500 @enderror" id="type" name="type" type="text" placeholder="Select ticket type" aria-label="Type">
        @foreach (config('constants.ticket_types') as $type => $text)
          <option value="{{ $type }}" @if (old('type') === $type) selected @endif>{{ $text }}</option>
        @endforeach
      </select>
    </div>

    <div class="mt-14 flex justify-end">
      <button class="px-8 py-3 text-white font-semibold uppercase tracking-wide text-sm bg-blue-800 rounded" type="submit">Submit</button>
    </div>
  </form>

@endsection
