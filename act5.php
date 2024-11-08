<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Embedded System - Activities</title>
    <link rel="stylesheet" href="src/output.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Fixed Navigation Style */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            /* Ensure it stays above other content */
        }

        /* Add padding to the body content to prevent overlap with fixed nav */
        body {
            padding-top: 60px;
            /* Adjust this value to the height of your nav */
        }

        .act-link {
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            text-align: center;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            background: linear-gradient(145deg, #2a2a2a, #1f1f1f);
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3), -4px -4px 8px rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .act-link:hover {
            background: linear-gradient(145deg, #1e1e1e, #2c2c2c);
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3), -2px -2px 6px rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-[#F5F5F5]">
    <!-- header -->
    <header>
        <nav class="bg-[#316FF6] border-blue-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="https://flowbite.com" class="flex items-center">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Embedded System</span>
                </a>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="/#act1" class="act-link">Act 1</a>
                        </li>
                        <li>
                            <a href="/#act2" class="act-link">Act 2</a>
                        </li>
                        <li>
                            <a href="/#act3" class="act-link">Act 3</a>
                        </li>
                        <li>
                            <a href="/#act4" class="act-link">Act 4</a>
                        </li>
                        <li>
                            <a href="/act5.php" class="act-link">Act 5</a>
                        </li>
                        <li>
                            <a href="/act6.php" class="act-link">Act 6</a>
                        </li>
                        <li>
                            <a href="/act7.php" class="act-link">Act 7</a>
                        </li>
                        <li>
                            <a href="/#act8" class="act-link">Act 8</a>
                        </li>
                        <li>
                            <a href="" class="act-link">Act 9</a>
                        </li>
                        <li>
                            <a href="" class="act-link">Act 10</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <style>
        .act-link {
            display: block;
            padding: 10px 15px;
            margin: 5px 0;
            text-align: center;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            background: linear-gradient(145deg, #2a2a2a, #1f1f1f);
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3), -4px -4px 8px rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .act-link:hover {
            background: linear-gradient(145deg, #1e1e1e, #2c2c2c);
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3), -2px -2px 6px rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
    </style>
    </header>


    <!-- Landing page -->

    <main class="max-w-7xl mx-auto px-10">
        <div class="mt-14">
            <h1 class="text-center text-4xl font-bold p-4">
                Embedded Systems
            </h1>
        </div>
        <div class="mt-14 pt-16">

            <!-- Activity 1 -->

            <div class="h-[400px] bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 w-full mt-4 mx-auto">
                <canvas id="soundChart" width="1600" height="500" class="mx-auto flex items-center justify-center"></canvas>
            </div>

            <div class="h-[400px] bg-white rounded-[8px] border-gray-200 shadow-sm p-4 py-8 w-full mt-4 mx-auto">
                <canvas id="rainChart" width="1600" height="500" class="mx-auto flex items-center justify-center"></canvas>
            </div>
            <div id="weather-icon">
                <img id="icon" src="/assets/icons/sunny-svgrepo-com.svg" alt="Weather Icon" width="100" height="100">
                <span id="weather-text">Sunny</span> <!-- Span for displaying weather condition -->
            </div>

            <div id="temperature" style="margin-top: 10px;">
                <img src="assets/icons/temperatures-heat-svgrepo-com.svg" alt="Temperature Icon" width="20" height="20"> <!-- Temperature icon -->
                <span>Temperature: 0 °C</span> <!-- Display temperature -->
            </div>

            <div id="humidity" style="margin-top: 5px;">
                <img src="/assets/icons/humidity-svgrepo-com.svg" alt="Humidity Icon" width="20" height="20"> <!-- Humidity icon -->
                <span>Humidity: 0%</span> <!-- Display humidity -->
            </div>



            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 10vh;">
                <span id="act5buzzer" style="display: inline-block; text-align: center;">
                    <svg fill="#f8e45c" height="40px" width="40px" version="1.1" id="Icons"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewBox="0 0 32 32" xml:space="preserve">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M26.8,25H5.2c-0.8,0-1.5-0.4-1.9-1.1c-0.4-0.7-0.3-1.5,0.1-2.2L4.5,20c1.8-2.7,2.7-5.8,2.7-9c0-3.7,2.4-7.1,5.9-8.3C13.7,1.6,14.8,1,16,1s2.3,0.6,2.9,1.7c3.5,1.2,5.9,4.6,5.9,8.3c0,3.2,0.9,6.3,2.7,9l1.1,1.7c0.4,0.7,0.5,1.5,0.1,2.2C28.4,24.6,27.6,25,26.8,25z">
                                </path>
                            </g>
                            <path d="M11.1,27c0.5,2.3,2.5,4,4.9,4s4.4-1.7,4.9-4H11.1z"></path>
                        </g>
                    </svg>
                </span>
            </div>

            <br>

            <br>

            <div class="mt-4">
                <h1 class="text-center">Historical Data</h1>
                <table class="min-w-full border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2 text-center">Index</th>
                            <th class="border border-gray-300 p-2 text-center">Latitude</th>
                            <th class="border border-gray-300 p-2 text-center">Longitude</th>
                            <th class="border border-gray-300 p-2 text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody id="sensorDataBody">
                        <!-- Data will be populated here by JavaScript -->
                    </tbody>
                </table>
            </div>
            <!-- End ACT 4  -->
    </main>

    <!-- Scripts for JS -->
    <script src="script/act5_chart.js"></script>
    <script src="script/buzzeract5.js"></script>
    <script src="script/update_icon.js"></script>




</html>