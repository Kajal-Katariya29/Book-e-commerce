<!DOCTYPE html>
<html lang="en">
    @include('admin.layouts.head')
    <body>
        <main>
            @yield('body')
        </main>
        @include('admin.layouts.scripts')
        @yield('scripts')
    </body>
</html>
