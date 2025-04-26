<!DOCTYPE html>
<html lang="en">

<head>
    @include('direktur.partials.head')
</head>

<body>
    <!-- Sidebar -->
    @include('direktur.partials.sidebar')

    <!-- Main Content -->
    <main id="main" class="main">
        @include('direktur.partials.header')
        
        <div class="content">
            @yield('content')
        </div>

        @include('direktur.partials.footer')
    </main>

    @include('direktur.partials.scripts')
</body>
</html>
