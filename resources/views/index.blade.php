@extends('layouts.app')

@section('scripts')
    <script type="text/javascript" src="{{ url('assets/js/ajax.js') }}"></script>
@endsection

@section('navItems')
    <nav class="navbar bg-dark navbar-expand-lg navbar-dark fixed-top navbar-sparrow">
      <div class="container"><h3 class="text-white">Andrei's</h3>
        <div class="collapse navbar-collapse" id="navbarNavDropdown1">
          <ul class="navbar-nav ms-auto">
          </ul>
        </div>
      </div>
    </nav>
@endsection

@section('content')
    <div class="container px-4">
          <div id="itemAjaxBody" class="row mb-5">
          </div>
        <div class="row" style="margin-top: 8px;">
            <div id="row">
                <ul id="pagination" class="pagination justify-content-center">
                </ul>
            </div>
        </div><!-- end of .container-->
    </div>
@endsection

@section('modalContent')
    <div class="modal fade container" id="modalShow" tabindex="-1" role="dialog" aria-hidden="true">
        
    </div>
@endsection