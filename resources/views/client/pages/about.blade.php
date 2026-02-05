@extends('client.layouts.app')

@section('title', 'À Propos de Nous')

@section('content')
    <!-- Section Hero -->
    <section class="relative bg-gradient-to-r from-sky-600 to-sky-800 py-20">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="container relative z-10 mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="mb-4 text-4xl font-bold md:text-5xl">À Propos de Nous</h1>
                <p class="mx-auto max-w-2xl text-xl text-sky-100">
                    Découvrez notre histoire et notre engagement envers l'excellence du pressing
                </p>
                <nav class="mt-6">
                    <ol class="flex items-center justify-center space-x-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-sky-200 hover:text-white">Accueil</a></li>
                        <li class="text-sky-200">/</li>
                        <li class="font-medium text-white">À Propos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Notre Histoire -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid items-center gap-12 lg:grid-cols-2">
                <div class="relative">
                    <div class="relative rounded-2xl p-8">
                        <img src="{{ asset('images/about-pressing.jpg') }}" alt="Notre équipe"
                            class="h-80 w-full rounded-xl object-cover"
                            onerror="this.src='https://images.unsplash.com/photo-1545173168-9f1947eebb7f?w=600&h=400&fit=crop'">
                        <div class="absolute -bottom-4 -right-4 rounded-xl bg-sky-500 p-4 text-white shadow-lg">
                            <div class="text-2xl font-bold">100%</div>
                            <div class="text-sm">Satisfaction</div>
                        </div>
                    </div>
                </div>
                <div>
                    <span class="text-sm font-semibold uppercase tracking-wider text-sky-500">Notre Histoire</span>
                    <h2 class="mb-6 mt-2 text-3xl font-bold text-gray-900 md:text-4xl">
                        Votre Pressing de Confiance depuis 2020
                    </h2>
                    <p class="mb-4 leading-relaxed text-gray-600">
                        Fondé en 2020 à Cotonou, notre pressing est né d'une passion pour le textile et d'un désir profond
                        de révolutionner les services de nettoyage au Bénin. Nous avons commencé avec une petite équipe
                        dévouée et un rêve : offrir un service de pressing de qualité supérieure accessible à tous.
                    </p>
                    <p class="mb-6 leading-relaxed text-gray-600">
                        Aujourd'hui, nous sommes fiers d'être l'un des pressings les plus appréciés de la région,
                        servant des centaines de clients satisfaits chaque mois. Notre croissance témoigne de notre
                        engagement envers l'excellence et la satisfaction client.
                    </p>
                    <div class="mt-8 grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-sky-500">5+</div>
                            <div class="text-sm text-gray-500">Années d'expérience</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-sky-500">2000+</div>
                            <div class="text-sm text-gray-500">Clients satisfaits</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-sky-500">50K+</div>
                            <div class="text-sm text-gray-500">Vêtements traités</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Notre Équipe -->
    <section class="relative overflow-hidden bg-gray-50 py-16">
        <div class="mx-auto max-w-7xl px-6 pt-20">
            <div class="grid grid-cols-1 items-center gap-16 lg:grid-cols-2">
                <!-- TEXTE GAUCHE -->
                <div class="space-y-6">
                    <h1 class="text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                        Rencontrez Notre Équipe
                    </h1>
                                        <p class="max-w-xl text-lg text-slate-600">
                        Des professionnels passionnés et expérimentés au service de votre satisfaction.

                    </p>
                </div>

                <!-- CAROUSEL D'ÉQUIPE DROITE -->
                <div class="relative">
                    <div class="swiper experts-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <article class="flex h-full flex-col gap-6 rounded-2xl bg-white p-8 m-4 shadow-md transition-shadow hover:shadow-lg">
                                    <div class="flex flex-col items-center text-center gap-4">
                                        <img src="https://i.pravatar.cc/200?img=12" alt="Jean Dupont" class="h-24 w-24 rounded-full object-cover">
                                        <div>
                                            <h3 class="text-xl font-bold text-slate-900">Jean Dupont</h3>
                                            <p class="font-semibold text-sky-600">Responsable Qualité</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-center gap-3 pt-4 border-t border-gray-200">
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="Facebook">
                                            <i class="fab fa-facebook text-lg"></i>
                                        </a>
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="LinkedIn">
                                            <i class="fab fa-linkedin text-lg"></i>
                                        </a>
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="Twitter">
                                            <i class="fab fa-twitter text-lg"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="flex h-full flex-col gap-6 rounded-2xl bg-white p-8 m-4 shadow-md transition-shadow hover:shadow-lg">
                                    <div class="flex flex-col items-center text-center gap-4">
                                        <img src="https://i.pravatar.cc/200?img=32" alt="Marie Adjovi" class="h-24 w-24 rounded-full object-cover">
                                        <div>
                                            <h3 class="text-xl font-bold text-slate-900">Marie Adjovi</h3>
                                            <p class="font-semibold text-sky-600">Directeur Technique</p>

                                        </div>
                                    </div>
                                    <div class="flex justify-center gap-3 pt-4 border-t border-gray-200">
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="Facebook">
                                            <i class="fab fa-facebook text-lg"></i>
                                        </a>
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="LinkedIn">
                                            <i class="fab fa-linkedin text-lg"></i>
                                        </a>
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="Twitter">
                                            <i class="fab fa-twitter text-lg"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="flex h-full flex-col gap-6 rounded-2xl bg-white p-8 m-4 shadow-md transition-shadow hover:shadow-lg">
                                    <div class="flex flex-col items-center text-center gap-4">
                                        <img src="https://i.pravatar.cc/200?img=56" alt="Pierre Kossou" class="h-24 w-24 rounded-full object-cover">
                                        <div>
                                            <h3 class="text-xl font-bold text-slate-900">Pierre Kossou</h3>
                                            <p class="font-semibold text-sky-600">Chef Opérations</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-center gap-3 pt-4 border-t border-gray-200">
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="Facebook">
                                            <i class="fab fa-facebook text-lg"></i>
                                        </a>
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="LinkedIn">
                                            <i class="fab fa-linkedin text-lg"></i>
                                        </a>
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="Twitter">
                                            <i class="fab fa-twitter text-lg"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>

                            <div class="swiper-slide">
                                <article class="flex h-full flex-col gap-6 rounded-2xl bg-white p-8 m-4 shadow-md transition-shadow hover:shadow-lg">
                                    <div class="flex flex-col items-center text-center gap-4">
                                        <img src="https://i.pravatar.cc/200?img=45" alt="Laure Mensah" class="h-24 w-24 rounded-full object-cover">
                                        <div>
                                            <h3 class="text-xl font-bold text-slate-900">Laure Mensah</h3>
                                            <p class="font-semibold text-sky-600">Service Client</p>
                                        </div>
                                    </div>
                                    <div class="flex justify-center gap-3 pt-4 border-t border-gray-200">
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="Facebook">
                                            <i class="fab fa-facebook text-lg"></i>
                                        </a>
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="LinkedIn">
                                            <i class="fab fa-linkedin text-lg"></i>
                                        </a>
                                        <a href="#" class="text-sky-600 hover:text-sky-700 transition" aria-label="Twitter">
                                            <i class="fab fa-twitter text-lg"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>

                    <!-- Contrôles -->
                    <div class="mt-8 flex justify-center gap-4">
                        <button class="experts-prev flex h-12 w-12 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 transition hover:border-slate-300 hover:bg-slate-100 hover:text-slate-900" aria-label="Précédent">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button class="experts-next flex h-12 w-12 items-center justify-center rounded-full border border-slate-200 bg-white text-slate-600 transition hover:border-slate-300 hover:bg-slate-100 hover:text-slate-900" aria-label="Suivant">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Appel à l'Action -->
    <section class="bg-gradient-to-r from-sky-600 to-sky-800 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="mb-4 text-3xl font-bold text-white md:text-4xl">Prêt à Commander ?</h2>
            <p class="mx-auto mb-8 max-w-2xl text-lg text-white/90">
                Confiez-nous vos vêtements et profitez d'un service de qualité professionnelle.
            </p>
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                <a href="{{ route('commander') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-3 font-semibold text-sky-600 transition-colors hover:bg-gray-100">
                    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Commander Maintenant
                </a>
                <a href="https://wa.me/22997000000" target="_blank"
                    class="inline-flex items-center justify-center rounded-lg border-2 border-white px-8 py-3 font-semibold text-white transition-colors hover:bg-white/10">
                    <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Contacter sur WhatsApp
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Experts Swiper
                const expertsSwiper = new Swiper('.experts-swiper', {
                    loop: true,
                    speed: 400,
                    spaceBetween: 24,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: '.experts-next',
                        prevEl: '.experts-prev',
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1
                        },
                        768: {
                            slidesPerView: 2
                        },
                    },
                });
            });
        </script>
    @endpush

@endsection
