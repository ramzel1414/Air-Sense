<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AirSense - About</title>

        <!-- Change the href attribute to the path of your icon file -->
        <link rel="icon" href="{{ asset('airsense.png') }}" type="image/png">

        <!-- Styles -->
        <style>
            .custom-radius {
              border-radius: 50%;
            }



            /* ! tailwindcss v3.2.4 | MIT License | https://tailwincss.com */
            *,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, sans-serif;font-feature-settings:normal}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::-webkit-backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.relative{position:relative}.mx-auto{margin-left:auto;margin-right:auto}.mx-6{margin-left:1.5rem;margin-right:1.5rem}.ml-4{margin-left:1rem}.mt-16{margin-top:4rem}.mt-6{margin-top:1.5rem}.mt-4{margin-top:1rem}.-mt-px{margin-top:-1px}.mr-1{margin-right:0.25rem}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.h-16{height:4rem}.h-7{height:1.75rem}.h-6{height:1.5rem}.h-5{height:1.25rem}.min-h-screen{min-height:100vh}.w-auto{width:auto}.w-16{width:4rem}.w-7{width:1.75rem}.w-6{width:1.5rem}.w-5{width:1.25rem}.max-w-7xl{max-width:80rem}.shrink-0{flex-shrink:0}.scale-100{--tw-scale-x:1;--tw-scale-y:1;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.items-center{align-items:center}.justify-center{justify-content:center}.gap-6{gap:1.5rem}.gap-4{gap:1rem}.self-center{align-self:center}.rounded-lg{border-radius:0.5rem}.rounded-full{border-radius:9999px}.bg-gray-100{--tw-bg-opacity:1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-red-50{--tw-bg-opacity:1;background-color:rgb(254 242 242 / var(--tw-bg-opacity))}.bg-dots-darker{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")}.from-gray-700\/50{--tw-gradient-from:rgb(55 65 81 / 0.5);--tw-gradient-to:rgb(55 65 81 / 0);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-transparent{--tw-gradient-to:rgb(0 0 0 / 0);--tw-gradient-stops:var(--tw-gradient-from), transparent, var(--tw-gradient-to)}.bg-center{background-position:center}.stroke-red-500{stroke:#ef4444}.stroke-gray-400{stroke:#9ca3af}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.text-center{text-align:center}.text-right{text-align:right}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-sm{font-size:0.875rem;line-height:1.25rem}.font-semibold{font-weight:600}.leading-relaxed{line-height:1.625}.text-gray-600{--tw-text-opacity:1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity:1;color:rgb(107 114 128 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-2xl{--tw-shadow:0 25px 50px -12px rgb(0 0 0 / 0.25);--tw-shadow-colored:0 25px 50px -12px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.shadow-gray-500\/20{--tw-shadow-color:rgb(107 114 128 / 0.2);--tw-shadow:var(--tw-shadow-colored)}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.selection\:bg-red-500 *::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-red-500::selection{--tw-bg-opacity:1;background-color:rgb(239 68 68 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-gray-900:hover{--tw-text-opacity:1;color:rgb(17 24 39 / var(--tw-text-opacity))}.hover\:text-gray-700:hover{--tw-text-opacity:1;color:rgb(55 65 81 / var(--tw-text-opacity))}.focus\:rounded-sm:focus{border-radius:0.125rem}.focus\:outline:focus{outline-style:solid}.focus\:outline-2:focus{outline-width:2px}.focus\:outline-red-500:focus{outline-color:#ef4444}.group:hover .group-hover\:stroke-gray-600{stroke:#4b5563}.z-10{z-index: 10}@media (prefers-reduced-motion: no-preference){.motion-safe\:hover\:scale-\[1\.01\]:hover{--tw-scale-x:1.01;--tw-scale-y:1.01;transform:translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}}@media (prefers-color-scheme: dark){.dark\:bg-gray-900{--tw-bg-opacity:1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:bg-gray-800\/50{background-color:rgb(31 41 55 / 0.5)}.dark\:bg-red-800\/20{background-color:rgb(153 27 27 / 0.2)}.dark\:bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}.dark\:bg-gradient-to-bl{background-image:linear-gradient(to bottom left, var(--tw-gradient-stops))}.dark\:stroke-gray-600{stroke:#4b5563}.dark\:text-gray-400{--tw-text-opacity:1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:shadow-none{--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.dark\:ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.dark\:ring-inset{--tw-ring-inset:inset}.dark\:ring-white\/5{--tw-ring-color:rgb(255 255 255 / 0.05)}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.group:hover .dark\:group-hover\:stroke-gray-400{stroke:#9ca3af}}@media (min-width: 640px){.sm\:fixed{position:fixed}.sm\:top-0{top:0px}.sm\:right-0{right:0px}.sm\:ml-0{margin-left:0px}.sm\:flex{display:flex}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 1024px){.lg\:gap-8{gap:2rem}.lg\:p-8{padding:2rem}}


    </style>

<style>
    .classification th, td {
        text-align: center;
        vertical-align: middle;
        
    }
    .text-wrap {
        word-wrap: break-word; 
        overflow-wrap: break-word; 
    }

    .text-left {
        text-align: left;
    }


</style>

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('../assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('../assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('../assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('../assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('../assets/css/demo1/style.css') }}">
    <!-- End layout styles -->

    {{-- toaster for update notif --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >



    </head>

    <body>
      
      @if (Route::has('login'))
      <div class="sm:fixed sm:top-0 sm:right-0 p-5 text-right z-10">
          <a href="{{route('welcome')}}" class="p-1 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Back</a>
          <a href="{{route('about')}}" class="p-1 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">About</a>
          @auth
              <a href="{{ route('admin.location')}}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Back</a>
          @else
              <a href="{{ route('login') }}" class="p-1 ml-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Log in</a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="p-1 ml-2 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Register</a>
              @endif
          @endauth
      </div>
    @endif





  <div class="page-content m-4">

    <div class="d-flex justify-content-center align-items-center grid-margin pb-4" style="border-bottom: 1px solid black">
        <a href="{{route('welcome')}}" class="d-flex align-items-center text-gray-600 hover:text-gray-900 focus:outline-gray-500 p-1 focus:outline focus:outline-2 focus:rounded-sm">
          <img src="{{ asset('airsense.png') }}" alt="Air Sense Logo" class="toggle-air-logo h-16 w-auto bg-gray-100 dark:bg-gray-900 custom-radius">
        <h3 class="mx-1">AirSense</h3>
        </a>
      </div>


    <div class="page-content">
    
        <h3 class="mb-4">About Us</h3>
        {{-- 1st row --}}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3 d-flex justify-content-start">About AirSense</h6>
                        <p class="text-right mb-1">
                            Welcome to AirSense, where innovation meets environmental stewardship. At AirSense, our mission is to revolutionize air quality monitoring and management through advanced technology, data-driven solutions, and <strong>Random Forest</strong> forecasting method.                    </p>
                        <p class="text-right mb-1">
                            <br>
                            Driven by a passion for sustainability and public health, AirSense provides real-time monitoring of key pollutants such as PM2.5, PM10, CO, NO2, and O3. Our cutting-edge system combines state-of-the-art sensors with machine learning algorithms, empowering individuals, governments, and industries to make informed decisions and take proactive measures to improve air quality.
                        </p>
                        <p class="text-right mb-1">
                            <br>
                            At AirSense, we are committed to reducing our carbon footprint and operating sustainably. That's why we harness the power of IoT and solar panels to fuel our monitoring station, ensuring reliability while minimizing environmental impact.
                        </p>
                        <p class="text-right mb-1">
                            <br>
                            With AirSense, we aim to raise awareness about air pollution and inspire collective action towards cleaner, healthier air for all. Join us in our journey towards a sustainable and pollution-free future with AirSense.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- 2nd row orig --}}
        <div class="row">
            <div class="col-5 col-md-3 pe-0 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3 d-flex justify-content-start">Pollutant Description</h6>
                        <div class="nav nav-tabs nav-tabs-vertical" id="v-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-home-tab" data-bs-toggle="pill" href="#v-home" role="tab" aria-controls="v-home" aria-selected="true">PM2.5</a>
                            <a class="nav-link" id="v-profile-tab" data-bs-toggle="pill" href="#v-profile" role="tab" aria-controls="v-profile" aria-selected="false">PM10</a>
                            <a class="nav-link" id="v-messages-tab" data-bs-toggle="pill" href="#v-messages" role="tab" aria-controls="v-messages" aria-selected="false">CO</a>
                            <a class="nav-link" id="v-no2-tab" data-bs-toggle="pill" href="#v-no2" role="tab" aria-controls="v-no2" aria-selected="false">NO2</a>
                            <a class="nav-link" id="v-settings-tab" data-bs-toggle="pill" href="#v-settings" role="tab" aria-controls="v-settings" aria-selected="false">O3</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7 col-md-9 ps-0 grid-margin">
              <div class="tab-content tab-content-vertical border p-3" id="v-tabContent">
                <div class="tab-pane fade show active mt-4" id="v-home" role="tabpanel" aria-labelledby="v-home-tab">
                  <h6 class="mb-3">PM2.5</h6>
                  <p>
                      PM2.5, or fine particulate matter, refers to tiny airborne particles with diameters of 2.5 micrometers or smaller. These particles, often from sources like vehicle emissions and industrial processes, can penetrate deep into the lungs and pose health risks, making monitoring essential for safeguarding air quality and public health.
                  </p>
    
                  
                </div>
                <div class="tab-pane fade mt-4" id="v-profile" role="tabpanel" aria-labelledby="v-profile-tab">
                    <h6 class="mb-3">PM10</h6>
                    <p>
                        PM10, known as coarse particulate matter, encompasses airborne particles with diameters of 10 micrometers or smaller. These particles, originating from sources like road dust, construction activities, and agricultural practices, can irritate the respiratory system upon inhalation, posing health concerns and necessitating monitoring to safeguard public well-being.
                   </p>
    
                </div>
                <div class="tab-pane fade mt-4" id="v-messages" role="tabpanel" aria-labelledby="v-messages-tab">
                    <h6 class="mb-3">CO</h6>
                    <p>
                        CO, or carbon monoxide, is a colorless and odorless gas produced by incomplete combustion of fossil fuels in vehicles, industrial processes, and residential heating systems. Due to its high affinity for hemoglobin, CO can impair the blood's ability to carry oxygen, leading to symptoms such as headaches, dizziness, and even death in high concentrations. Monitoring CO levels is crucial for detecting potential sources of indoor and outdoor pollution and implementing measures to protect public health and safety.              </p>
                    </div>
                <div class="tab-pane fade mt-4" id="v-no2" role="tabpanel" aria-labelledby="v-no2-tab">
                    <h6 class="mb-3">NO2</h6>
                    <p>
                        NO2, or nitrogen dioxide, is a reddish-brown gas primarily emitted from combustion processes in vehicles, power plants, and industrial facilities. Exposure to NO2 can exacerbate respiratory conditions such as asthma and increase susceptibility to respiratory infections. Monitoring NO2 levels is essential for assessing air quality and implementing pollution control measures to reduce health risks and protect vulnerable populations.
                    </p>
                  </div>
                <div class="tab-pane fade mt-4" id="v-settings" role="tabpanel" aria-labelledby="v-settings-tab">
                    <h6 class="mb-3">03</h6>
                    <p>
                        O3, or ozone, is a reactive gas composed of three oxygen atoms formed through complex chemical reactions involving pollutants such as nitrogen oxides and volatile organic compounds in the presence of sunlight. While beneficial in the stratosphere for blocking harmful UV radiation, ground-level ozone can irritate the respiratory system, trigger asthma attacks, and cause lung inflammation. Monitoring O3 levels aids in understanding air pollution dynamics and implementing strategies to reduce emissions, ultimately promoting healthier environments and mitigating the adverse effects of ozone pollution on human health.
                    </p>
                </div>
              </div>
            </div>
          </div>
          
        {{-- 3rd row --}}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Air Quality Index Classification</h6>
                        <div class="table-responsive">
                            <table class="table classification">
                                <thead>
                                    <tr>
                                        <th rowspan="2">CATEGORY</th>
                                        <th rowspan="2">COLOR</th>
                                        <th colspan="2">BREAKPOINTS</th>
                                        <th rowspan="2">CAUTIONARY STATEMENTS</th>
                                        
                                    </tr>
                                    <tr>
                                        <th>PM<sub>10</sub> (ug/m<sup>3</sup>)</th>
                                        <th>PM<sub>2.5</sub> (ug/m<sup>3</sup>)</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    <tr>
                                        <td>Good</td>
                                        <td style="background: green;" class="text-light">Green</td>
                                        <td>0 - 54</td>
                                        <td>0 - 25</td>
                                        <td>No</td>
                                    </tr>
                                    <tr>
                                        <td>Fair</td>
                                        <td style="background: yellow;">Yellow</td>
                                        <td>55 - 154</td>
                                        <td>25.1 - 35.0</td>
                                        <td>No</td>
                                    </tr>
                                    <tr>
                                        <td class="text-wrap" style="line-height: 1.5;">Unhealthy for Sensitive Groups</td>
                                        <td  style="background: orange;">Orange</td>
                                        <td>155 - 254</td>
                                        <td>35.1 - 45.0</td>
                                        <td class="text-wrap text-left">People with respiratory disease, such as asthma, should limit their outdoor exertion.</td>
                                    </tr>
                                    <tr>
                                        <td>Very Unhealthy</td>
                                        <td style="background: red;" class="text-light">Red</td>
                                        <td>255 - 354</td>
                                        <td>45.1 - 55</td>
                                        <td class="text-wrap text-left">Pedestrians should avoid heavy traffic areas. People with respiratory disease such as asthma should stay indoors and rest as much as possible. Unnecessary trips should be postponed. People should voluntarily restrict the use of vehicles</td>
                                    </tr>
                                    <tr>
                                        <td>Accutely Unhealthy</td>
                                        <td style="background: purple;" class="text-light">Purple</td>
                                        <td>355 - 424</td>
                                        <td>55.1 - 90</td>
                                        <td class="text-wrap text-left">Pedestrians should avoid heavy traffic areas. People with respiratory disease such as asthma should stay indoors and rest as much as possible. Unnecessary trips should be postponed. Motor vehicles use may be restricted. Industrial activities may be curtailed.</td>
                                    </tr>
                                    <tr>
                                        <td>Emergency</td>
                                        <td style="background:maroon;" class="text-light">Maroon</td>
                                        <td>425 - 504</td>
                                        <td>Above 91</td>
                                        <td class="text-wrap text-left">Everyone should remain indoors. (keeping windows and doors closed unless heat stress is possible). Motor vehicles should be prohibited except for emergency situations. Industrial activities, except that which is vital for public safety should and health should be curtailed.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- 3rd row --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Frequently Asked Questions</h6>
                        <div class="accordion" id="FaqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is the AirSense system?
                                </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        The AirSense system is an innovative air quality monitoring solution designed to track various pollutants in the atmosphere, including PM2.5, PM10, O3, CO, and NO2. It utilizes advanced sensors and machine learning algorithms to provide real-time insights into air quality levels.       
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How does the AirSense system work?
                                </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        The AirSense system consists of sensors deployed in various locations to continuously monitor air quality parameters. These sensors collect real-time data on pollutant levels, which are then processed and analyzed using machine learning algorithms, particularly Random Forest models. These models help in forecasting future pollutant levels based on historical data and other relevant factors. 
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How can I access the data from the AirSense system?
                                </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        Users can access the data collected by the AirSense system through a user-friendly interface, which may include web-based dashboards or mobile applications. The data is presented in easy-to-understand formats, such as charts, graphs, and maps, allowing users to interpret and analyze air quality information effectively.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Is the AirSense system suitable for both indoor and outdoor environments?                            </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        Yes, the AirSense system is versatile and can be deployed in both indoor and outdoor environments. It can be used in various settings, including residential areas, industrial facilities, commercial buildings, and public spaces, to monitor air quality and ensure a safe and healthy environment for occupants.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    How can I deploy the AirSense system in my area?
                                </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        To deploy the AirSense system in your area, please contact our team for consultation and assistance. We offer customized solutions to meet the unique requirements of different environments and applications. Our experts will work closely with you to design and implement an air quality monitoring solution that best suits your needs.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Is there ongoing support and maintenance for the AirSense system?                            </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#FaqAccordion">
                                    <div class="accordion-body">
                                        Yes, we provide comprehensive support and maintenance services for the AirSense system to ensure its optimal performance and reliability. Our team of experts offers technical assistance, software updates, and periodic maintenance to keep the system running smoothly and efficiently.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


	<!-- core:js -->
	<script src="{{ asset('../assets/vendors/core/core.js')}}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="{{ asset('../assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
  <script src="{{ asset('../assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('../assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
  <script src="{{ asset('../assets/js/jquery.flot-dark.js')}}"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('../assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{ asset('../assets/js/template.js')}}"></script>
	<!-- endinject -->

        {{-- PM2.5 Chart--}}
  	<script src="{{ asset('../assets/pm25.js')}}"></script>
    {{-- PM10 Chart--}}
  	<script src="{{ asset('../assets/pm10.js')}}"></script>
    {{-- CO Chart--}}
  	<script src="{{ asset('../assets/co.js')}}"></script>
    {{-- NO2 Chart--}}
  	<script src="{{ asset('../assets/no2.js')}}"></script>
    {{-- O3 Chart--}}
  	<script src="{{ asset('../assets/o3.js')}}"></script>

    {{-- PM2.5 Forecasting Chart--}}
  	<script src="{{ asset('../assets/pm25f.js')}}"></script>

    {{-- PM10 Forecasting Chart--}}
  	<script src="{{ asset('../assets/pm10f.js')}}"></script>


    </body>
</html>
