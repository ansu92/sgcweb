<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 overflow-hidden shadow-xl sm:rounded-lg">
                <div>

                    <div class="relative bg-white overflow-hidden">
                        <div class="max-w-7xl mx-auto">
                            <div
                                class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none"
                                    aria-hidden="true">
                                    <polygon points="50,0 100,0 50,100 0,100" />
                                </svg>

                                <div>
                                    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                                    </div>
                                </div>

                                <main
                                    class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                                    <div class="sm:text-center lg:text-left">
                                        <h1
                                            class="text-4xl tracking-tight font-extrabold text-gray-800 sm:text-5xl md:text-6xl">
                                            <span class="block xl:inline">SGC Web</span>
                                            <span class="block text-indigo-600 md:text-4xl">Sistema
                                                Administrativo</span>
                                        </h1>
                                        <p
                                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                            ¡Cobranza, facturación, información y reportes para tu condominio en un solo
                                            lugar!
                                        </p>
                                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                            <div class="rounded-md shadow">
                                                <a href="{{ route('login') }}"
                                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                                    Iniciar sesión
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                            </div>
                        </div>
                        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                                src="https://image.freepik.com/foto-gratis/padre-feliz-hija-pie-cerca-balcon-abierto-sonriendo_74855-9994.jpg"
                                alt="">
                        </div>
                    </div>
                    {{-- <section class="text-gray-600 body-font bg-gray-100">
                        <div class="container mx-auto">
                            <div class="flex flex-col text-center w-full mb-20 h-96 justify-center">
                                <h1
                                    class="text-gray-800 md:text-4xl text-4xl tracking-tight font-extrabold sm:text-5xl  title-font mb-4">
                                    Master
                                    Cleanse Reliac Heirloom</h1>
                                <p
                                    class="text-gray-500 sm:text-lg md:text-xl lg:w-2/3 mx-auto leading-relaxed text-base text-justify">
                                    Es un sistema totalmente online para la administración de condominios, dirigidos
                                    por Juntas de Condominio y Administradores de Condominio, con sistema de roles y
                                    permisos, controlando el nivel de acceso que tienen los usuarios.</p>
                                <p
                                    class="text-gray-500 sm:text-lg md:text-xl lg:w-2/3  mt-4 mx-auto leading-relaxed text-base text-justify">
                                    El sistema
                                    facilita la comunicación con el usuario al enviarle notificaciones de cobros, o
                                    recibos de condominio, a través de mensajes de texto o correo electrónico, para así
                                    mantener a la comunidad en contacto, además de ofrecer una cartelera virtual para
                                    que los administradores de distintas tareas del condominio publiquen sus
                                    comunicados.</p>
                            </div>
                        </div>
                    </section> --}}

                    <section class="text-gray-600 body-font bg-gray-100">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="flex flex-col text-center w-full">
                                <h1
                                    class="text-gray-800 md:text-4xl text-4xl tracking-tight font-extrabold sm:text-5xl title-font mb-4">
                                    ¿Qué es SGC Web?</h1>
                                <p
                                    class="text-gray-500 sm:text-lg md:text-xl lg:w-2/3 mx-auto leading-relaxed text-base text-justify">
                                    Es un sistema totalmente online para la administración de condominios, dirigidos
                                    por Juntas de Condominio y Administradores de Condominio, con sistema de roles y
                                    permisos, controlando el nivel de acceso que tienen los usuarios.</p>
                                <p
                                    class="text-gray-500 sm:text-lg md:text-xl lg:w-2/3  mt-4 mx-auto leading-relaxed text-base text-justify">
                                    El sistema
                                    facilita la comunicación con el usuario al enviarle notificaciones de cobros, o
                                    recibos de condominio, a través de mensajes de texto o correo electrónico, para así
                                    mantener a la comunidad en contacto, además de ofrecer una cartelera virtual para
                                    que los administradores de distintas tareas del condominio publiquen sus
                                    comunicados.</p>
                            </div>
                        </div>
                    </section>

                    <section class="text-gray-600 body-font bg-white">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="flex flex-col text-center w-full mb-20">
                                <h1 class="text-gray-800 md:text-4xl text-4xl tracking-tight font-extrabold sm:text-5xl title-font  title-font">¿Qué le ofrece SGC
                                    Web?</h1>
                            </div>
                            <div class="flex flex-wrap -m-4">
                                <div class="p-4 md:w-1/3">
                                    <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-blue-500 text-white flex-shrink-0">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                    viewBox="0 0 24 24">
                                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                                </svg>
                                            </div>
                                            <h2 class="text-gray-900 text-lg title-font font-medium">Responsivo</h2>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-base text-justify">Sistema que se puede
                                                utilizar desde un
                                                teléfono celular, laptop, PC de escritorio o tablet, ofreciendo un
                                                manejo del sistema fácil e intuitivo, ajustando su tamaño para adaptarse
                                                al
                                                tamaño de la ventana donde se está ejecutando.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 md:w-1/3">
                                    <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-blue-500 text-white flex-shrink-0">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                    viewBox="0 0 24 24">
                                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                            <h2 class="text-gray-900 text-lg title-font font-medium">Sistema de roles y
                                                perfiles</h2>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-base text-justify">El sistema permite
                                                restringir el acceso a funciones o módulos. Por ejemplo, los
                                                administradores podrán generar el presupuesto, registrar gastos
                                                mensuales, calcular las alícuotas necesarias, etc.
                                                Y por otro lado, el propietario puede ver sus recibos y
                                                registrar los pagos realizados en el sistema.</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 md:w-1/3">
                                    <div class="flex rounded-lg h-full bg-gray-100 p-8 flex-col">
                                        <div class="flex items-center mb-3">
                                            <div
                                                class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-blue-500 text-white flex-shrink-0">
                                                <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                                                    viewBox="0 0 24 24">
                                                    <circle cx="6" cy="6" r="3"></circle>
                                                    <circle cx="6" cy="18" r="3"></circle>
                                                    <path d="M20 4L8.12 15.88M14.47 14.48L20 20M8.12 8.12L12 12"></path>
                                                </svg>
                                            </div>
                                            <h2 class="text-gray-900 text-lg title-font font-medium">Otras funciones
                                            </h2>
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-base text-justify">También ofrece una
                                                cartelera virtual,
                                                un manual de usuario y genera varios reportes de información en formato
                                                PDF. Como extra, posee un sistema de mensajería para que los miembros
                                                del condominio puedan comunicarse entre ellos.</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="text-gray-600 body-font bg-gray-100">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="flex flex-col text-center w-full mb-20">
                                <h1 class="text-gray-800 md:text-4xl text-4xl tracking-tight font-extrabold sm:text-5xl title-font  title-font mb-4">Nuestro
                                    Equipo
                                </h1>

                            </div>
                            <div class="flex flex-wrap -m-4">
                                <div class="p-4 lg:w-1/2">
                                    <div
                                        class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                        <img alt="team"
                                            class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                            src="{{asset('img/team/anthony.jpeg')}}">
                                        <div class="flex-grow sm:pl-8">
                                            <h2 class="title-font font-medium text-lg text-gray-900">Anthony J. Suárez
                                            </h2>
                                            <h3 class="text-gray-500 mb-3">TSU en Informática</h3>                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 lg:w-1/2">
                                    <div
                                        class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                        <img alt="team"
                                            class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                            src="{{asset('img/team/diego.jpeg')}}">
                                        <div class="flex-grow sm:pl-8">
                                            <h2 class="title-font font-medium text-lg text-gray-900">Diego A. Rodríguez
                                            </h2>
                                            <h3 class="text-gray-500 mb-3">TSU en Informática</h3>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 lg:w-1/2">
                                    <div
                                        class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                        <img alt="team"
                                            class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                            src="{{asset('img/team/guillermo.jpeg')}}">
                                        <div class="flex-grow sm:pl-8">
                                            <h2 class="title-font font-medium text-lg text-gray-900">Guillermo Thourey
                                            </h2>
                                            <h3 class="text-gray-500 mb-3">TSU en Informática</h3>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 lg:w-1/2">
                                    <div
                                        class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                                        <img alt="team"
                                            class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4"
                                            src="{{asset('img/team/pablo.jpeg')}}">
                                        <div class="flex-grow sm:pl-8">
                                            <h2 class="title-font font-medium text-lg text-gray-900">Pablo Bastardo
                                            </h2>
                                            <h3 class="text-gray-500 mb-3">TSU en Informática</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
