@isset($successMessage)
  <div class="my-8 bg-green-100 rounded text-green-900 px-4 py-3" role="alert">
    <p class="font-bold mb-2">Ok!</p>
    <p class="text-sm">{{ $successMessage ?? '' }}</p>
  </div>
@endif

@isset($infoMessage)
  <div class="my-8 bg-blue-100 rounded text-blue-900 px-4 py-3" role="alert">
    <p class="font-bold mb-2">Info!</p>
    <p class="text-sm">{{ $infoMessage ?? '' }}</p>
  </div>
@endif

@isset($alertMessage)
  <div class="my-8 bg-yellow-100 rounded text-yellow-900 px-4 py-3" role="alert">
    <p class="font-bold mb-2">Alert!</p>
    <p class="text-sm">{{ $alertMessage ?? '' }}</p>
  </div>
@endif

@if ($errors->any() || isset($errorMessage))
  <div class="my-8 bg-red-100 rounded text-red-700 px-4 py-3" role="alert">
    <p class="font-bold mb-2">Error!</p>
    <p class="text-sm">{{ $errorMessage ?? '' }}</p>

    @foreach ($errors->all() as $error)
      <p class="text-sm">{{ $error }}</p>
    @endforeach

  </div>
@endif
