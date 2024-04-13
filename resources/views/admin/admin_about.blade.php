@extends('admin.admin_dashboard')
@section('content')

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
    <div class="d-flex" >
        <div class="col-5 col-md-3 pe-0 grid-margin">
            <div class="card rounded">
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
        <div class="col-7 col-md-9 ps-0 grid-margin pol-desc">
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
                                        <th rowspan="3">CATEGORY</th>
                                        <th rowspan="3">COLOR</th>
                                        <th colspan="3">BREAKPOINTS</th>
                                        <th rowspan="3">CAUTIONARY STATEMENTS</th>

                                    </tr>
                                    <tr>
                                        <th>PM<sub>10</sub> (ug/m<sup>3</sup>)</th>
                                        <th>PM<sub>2.5</sub> (ug/m<sup>3</sup>)</th>
                                        <th>CO (ppm)</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Good</td>
                                        <td style="background: green;" class="text-light">Green</td>
                                        <td>0 - 54</td>
                                        <td>0 - 25</td>
                                        <td>0 - 25</td>

                                        <td>No</td>
                                    </tr>
                                    <tr>
                                        <td>Fair</td>
                                        <td style="background: yellow;" class="text-dark">Yellow</td>
                                        <td>55 - 154</td>
                                        <td>25.1 - 35.0</td>
                                        <td>25 - 50</td>

                                        <td>No</td>
                                    </tr>
                                    <tr>
                                        <td class="text-wrap" style="line-height: 1.5;">Unhealthy for Sensitive Groups</td>
                                        <td  style="background: orange;">Orange</td>
                                        <td>155 - 254</td>
                                        <td>35.1 - 45.0</td>
                                        <td>51 - 69</td>
                                        <td class="text-wrap text-center">People with respiratory disease, such as asthma, should limit their outdoor exertion.</td>
                                    </tr>
                                    <tr>
                                        <td>Unhealthy</td>
                                        <td style="background: red;" class="text-light">Red</td>
                                        <td>255 - 354</td>
                                        <td>45.1 - 55</td>
                                        <td>70 - 150</td>

                                        <td class="text-wrap text-center">Pedestrians should avoid heavy traffic areas. People with respiratory disease such as asthma should stay indoors and rest as much as possible. Unnecessary trips should be postponed. People should voluntarily restrict the use of vehicles</td>
                                    </tr>
                                    <tr>
                                        <td>Very Unhealthy</td>
                                        <td style="background: purple;" class="text-light">Purple</td>
                                        <td>355 - 424</td>
                                        <td>55.1 - 90</td>
                                        <td>151 - 400</td>

                                        <td class="text-wrap text-center">Pedestrians should avoid heavy traffic areas. People with respiratory disease such as asthma should stay indoors and rest as much as possible. Unnecessary trips should be postponed. Motor vehicles use may be restricted. Industrial activities may be curtailed.</td>
                                    </tr>
                                    <tr>
                                        <td>Hazardous</td>
                                        <td style="background:maroon;" class="text-light">Maroon</td>
                                        <td>425 - 504</td>
                                        <td>Above 91</td>
                                        <td>Above 401</td>

                                        <td class="text-wrap text-center">Everyone should remain indoors. (keeping windows and doors closed unless heat stress is possible). Motor vehicles should be prohibited except for emergency situations. Industrial activities, except that which is vital for public safety should and health should be curtailed.</td>
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

@endsection



<style>
    /* Custom styles for the toggle switch */
   .custom-toggle {
       position: relative;
       width: 30px;
       height: 15px;
       margin-right: .5rem;
   }

   /* Hide the default checkbox */
   .custom-toggle input {
       opacity: 0;
       width: 0;
       height: 0;
   }

   /* Style for the track/background of the toggle switch */
   .custom-toggle label {
       position: absolute;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       outline: 1px solid white;
       background-color: #0c1427; /* Default background color */
       border-radius: 15px; /* Rounded corners */
       cursor: pointer;
       transition: background-color 0.3s; /* Smooth color transition */
   }

   /* Change background color when the toggle switch is checked */
   .custom-toggle input:checked + label {
       background-color: blue; /* Blue color when checked */
   }

   /* Style for the sliding circle inside the toggle switch */
   .custom-toggle label:before {
       content: '';
       position: absolute;
       top: 50%;
       transform: translateY(-50%);
       width: 15px;
       height: 15px;
       background-color: #fff; /* Circle color */
       border-radius: 50%; /* Rounded shape */
       transition: transform 0.3s; /* Smooth sliding transition */
   }

   /* Move the circle to the right when the toggle switch is checked */
   .custom-toggle input:checked + label:before {
       transform: translate(15px, -50%);
   }
   </style>
