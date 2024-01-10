<!DOCTYPE html>
<html lang="en">
@include('user.layout.head')
<body>

    @include('user.layout.header')
    
    @yield('content')
    
    @include('user.layout.footer')
    
    @include('user.layout.script')
    
    @include('sweetalert::alert')
    
</body>
</html>