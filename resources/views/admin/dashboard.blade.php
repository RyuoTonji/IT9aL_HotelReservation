Welcome nigga, {{ Auth::user() }}!!!

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      @if (Auth::user()->role !== 'Admin')
        
      @endif
    });
  </script>
@endpush
