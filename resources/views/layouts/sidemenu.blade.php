<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Gestion') }}</title>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="{{ asset('responsiveDashboard/css/style.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Theme style -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Scripts -->

    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    @if (Auth::check())
        <script>
            var userRole = "{{ Auth::user()->role }}";
            // Your other JavaScript code for logged-in users here
        </script>
    @endif

    <script src="{{ asset('js/user-location.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- =============== navigationn ================ -->

    <div class="container_respdash">
        <div class="navigationn">

            <ul>

                @if (auth()->user()->isAdmin())
                    <li>
                        <a href="">
                            <span class="icon">
                            </span>
                            <span class="title">Gestion délégués médicaux</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('commercial.outils') }}">
                            <span class="icon">
                                <ion-icon name="people-circle-outline"></ion-icon>
                            </span>
                            <span class="title">Outil deleguer</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('ajouter_commerciaux') }}">
                            <span class="icon">
                                <ion-icon name="bag-add-outline"></ion-icon>
                            </span>
                            <span class="title">Ajouter un délégué</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/register') }}">
                            <span class="icon">
                                <ion-icon name="person-add-outline"></ion-icon>
                            </span>
                            <span class="title">Ajouter un ADMIN</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="">
                            <span class="icon">
                            </span>
                            <span class="title">Gestion délégués médicaux</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('commercial.outils') }}">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Page d'acceuil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('commercial.visite_effectuer') }}">
                            <span class="icon">
                                <ion-icon name="briefcase-outline"></ion-icon>
                            </span>
                            <span class="title">Ajouter un Visite</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('commercial.ajout_bandeCommande') }}">
                            <span class="icon">
                                <ion-icon name="document-outline"></ion-icon>
                            </span>
                            <span class="title">Cree un bon de commande</span>
                        </a>
                    </li>
                @endif
            </ul>




        </div>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>


                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    {{-- @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif --}}
                @else
                    <div class="lead">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">

                            <ion-icon name="log-out-outline"></ion-icon>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>

            <!-- ======================= Cards ================== -->
            @yield('content')
            {{-- <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Nombre client</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
</div>
           <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
</div> --}}
            <!-- =========== Scripts =========  -->

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- Bootstrap -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
            <script src="{{ asset('responsiveDashboard/js/main.js') }}"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                // Function to handle the form submission with SweetAlert confirmation
                function handleFormSubmit(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const form = event.target.closest('form'); // Find the closest form element
                    if (!form) return; // If no form found, return

                    const confirmText = form.getAttribute(
                        'data-confirm'); // Get the confirmation message from data-confirm attribute

                    // Display the SweetAlert confirmation dialog
                    Swal.fire({
                        title: confirmText || 'Etes vous sur de cette action?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Oui, je suis sur',
                        cancelButtonText: 'Non',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.setAttribute('target', '_self');
                            form.submit(); // If confirmed, submit the form
                        }
                    });
                }

                // Attach the onSubmit handler to buttons with the alertClass
                const buttons = document.querySelectorAll('.alertClass');
                buttons.forEach((button) => {
                    button.addEventListener('click', handleFormSubmit);
                });
                document.addEventListener('DOMContentLoaded', function() {
                    const confirmEditButtons = document.querySelectorAll('.confirmEdit');

                    const updateForm = document.getElementById('update-form');
                    confirmEditButtons.forEach(button => {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();

                            const form = button.closest('form');
                            Swal.fire({
                                title: 'Etes vous sur de modifier ?',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Oui, modifier',
                                cancelButtonText: 'Annuler'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to the edit URL
                                    form.submit();
                                }
                            });
                        });
                    });
                });
            </script>
            @yield('scripts')
</body>

</html>
