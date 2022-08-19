@extends('layout')
@section('title', 'Home')

@section('content')
    <div class="bg-white-primary">
        {{-- Hero --}}
        <div class='grid grid-cols-1 md:grid-cols-2 py-12'>
            <div class='flex flex-col gap-8'>
                <h1 class='text-4xl font-bold text-black-primary'>
                    Kami Menyediakan
                    <span class='text-orange-primary'>
                        Mandor Terbaik
                    </span>
                    untuk Kebutuhan
                    <span class='text-orange-primary'>
                        Proyek Anda
                    </span>

                </h1>
                <h2 class='text-xl font-medium text-black-primary'>
                    Quliku merupakan sebuah platform penyedia jasa mandor, mulai dari proyek rumah tangga sampai dengan
                    proyek besar
                </h2>
                <div class='inline-block text-center md:text-left'>
                    <a href='/login'
                        class="font-bold px-5 py-2 bg-orange-primary text-white-primary hover:bg-orange-secondary rounded-2xl transition duration-300">
                        Download Aplikasi Quliku
                    </a>
                </div>
            </div>
            <div class='p-1'>
                <img class='hidden md:block' alt='image-hero' src='/images/image-hero.png' />
            </div>
        </div>

        {{-- Layanan --}}
        <div class="py-12">
            <div class="mx-auto max-w-7xl">
                <div class="lg:text-center">
                    <h2 class="text-base font-bold uppercase tracking-wide text-orange-primary">
                        Layanan
                    </h2>
                    <p class="mt-2 text-3xl font-extrabold leading-8 tracking-tight text-black-primary sm:text-4xl">
                        Pelayanan yang kami miliki
                    </p>
                    <p class="mt-4 max-w-2xl text-xl text-black-secondary lg:mx-auto">
                        Kami menyediakan mandor yang terverifikasi untuk Anda. Selain itu, Anda dapat dengan mudah manajamen
                        proyek
                    </p>
                </div>

                <div class="mt-10">

                    <dl class="space-y-10 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10 md:space-y-0">
                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-orange-primary text-white-primary">
                                    <img src='/images/icon-recomendation.png' alt='image-recomendation' class="h-7 w-7" />
                                </div>
                                <p class="ml-16 text-lg font-medium leading-6 text-black-primary">
                                    Rekomendasi Mandor Terbaik
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-black-secondary">
                                Anda dapat mencari mandor terbaik berdasarkan rekomendasi mandor yang kami berikan
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-orange-primary text-white-primary">
                                    <img src='/images/icon-mandor.png' alt='image-mandor' class="h-7 w-7" />
                                </div>
                                <p class="ml-16 text-lg font-medium leading-6 text-black-primary">
                                    Pengklasifikasian Mandor
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-black-secondary">
                                Anda dimudahkan mencari mandor sesuai kebutuhan berdasarkan klasifikasi mandor
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-orange-primary text-white-primary">
                                    <img src='/images/icon-laporan.png' alt='image-laporan' class="h-7 w-7" />
                                </div>
                                <p class="ml-16 text-lg font-medium leading-6 text-black-primary">
                                    Laporan Perkembangan Mandor
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-black-secondary">
                                Anda dengan mudah mengetahui perkembangan proyek Anda melalui laporan mandor
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-orange-primary text-white-primary">
                                    <img src='/images/icon-transfer.png' alt='image-transfer' class="h-8 w-8" />
                                </div>
                                <p class="ml-16 text-lg font-medium leading-6 text-black-primary">
                                    Pencatatan Pembayaran Proyek
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-black-secondary">
                                Pembayaran yang Anda lakukan dapat dicatat melalui aplikasi, sehingga mempermudah pencatatan
                                pembayaran
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        {{-- Benefit --}}
        <div class="content-3-2 flex flex-col items-center py-12 lg:flex-row">

            {{-- Left --}}
            <div class="mb-12 flex w-full justify-center text-center lg:mb-0 lg:w-1/2">
                <img src='/images/image-benefit.png' alt='image-benefit' class="hidden md:block" />
            </div>

            {{-- Right --}}
            <div class="flex w-full flex-col items-center text-center lg:w-1/2 lg:items-start lg:text-left">
                <h2 class="mt-2 text-3xl font-extrabold leading-8 tracking-tight text-black-primary sm:text-4xl">
                    Benefit Menggunakan
                    <span class="text-orange-primary">
                        Quliku
                    </span>
                </h2>

                <ul class="pt-10">

                    <li class="mb-8">
                        <h4
                            class="text-black-primary mb-5 flex flex-col items-center justify-center text-2xl font-medium lg:flex-row lg:justify-start">
                            <span
                                class="circle mb-5 flex h-8 w-8 items-center justify-center rounded-full bg-orange-primary text-xl text-white-primary lg:mr-5 lg:mb-0">
                                1
                            </span>
                            Mandor yang Berpengalaman
                        </h4>

                        <p class="text-base leading-7 tracking-wide md:pl-[52px]">
                            Quliku menyediakan beragam klasifikasi mandor yang dipastikan berpengalaman
                        </p>
                    </li>

                    <li class="mb-8">
                        <h4
                            class="text-black-primary mb-5 flex flex-col items-center justify-center text-2xl font-medium lg:flex-row lg:justify-start">
                            <span
                                class="circle mb-5 flex h-8 w-8 items-center justify-center rounded-full bg-orange-primary text-xl text-white-primary lg:mr-5 lg:mb-0">
                                2
                            </span>
                            Mendapatkan Mandor Sesuai Keinginan
                        </h4>

                        <p class="text-base leading-7 tracking-wide md:pl-[52px]">
                            Quliku memudahkan kontraktor mencari mandor berdasarkan filter yang ditentukan
                        </p>
                    </li>

                    <li class="mb-8">
                        <h4
                            class="text-black-primary mb-5 flex flex-col items-center justify-center text-2xl font-medium lg:flex-row lg:justify-start">
                            <span
                                class="circle mb-5 flex h-8 w-8 items-center justify-center rounded-full bg-orange-primary text-xl text-white-primary lg:mr-5 lg:mb-0">
                                3
                            </span>
                            Mandor Terverifikasi
                        </h4>

                        <p class="text-base leading-7 tracking-wide md:pl-[52px]">
                            Quliku memastikan mitra mandor yang terdaftar sudah diverifikasi oleh pihak Quliku
                        </p>
                    </li>

                    <li class="mb-8">
                        <h4
                            class="text-black-primary mb-5 flex flex-col items-center justify-center text-2xl font-medium lg:flex-row lg:justify-start">
                            <span
                                class="circle mb-5 flex h-8 w-8 items-center justify-center rounded-full bg-orange-primary text-xl text-white-primary lg:mr-5 lg:mb-0">
                                4
                            </span>
                            Monitoring Kinerja Mandor
                        </h4>

                        <p class="text-base leading-7 tracking-wide md:pl-[52px]">
                            Quliku memudahkan kontraktor mengetahui perkembangan proyek yang dikerjakan mandor
                        </p>
                    </li>

                </ul>

            </div>

        </div>


    </div>
@endsection
