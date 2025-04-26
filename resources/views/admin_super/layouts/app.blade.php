<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin_super.partials.head')
</head>

<body>
    <!-- Sidebar -->
    @include('admin_super.partials.sidebar')

    <!-- Main Content -->
    <main id="main" class="main">
        @include('admin_super.partials.header')
        
        <div class="content">
            @yield('content')
        </div>

        @include('admin_super.partials.footer')
    </main>

    @include('admin_super.partials.scripts')
</body>
</html>
