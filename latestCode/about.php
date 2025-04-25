<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="header.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moffat Bay Marina</title>
    <style>
        body {
            background-image: url('../img/photo.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Dark overlay */
            z-index: -1;
            /* Behind all elements */
        }



        nav {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }


        main {
            margin-bottom: 50px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .overlay {
            position: relative;
        }

        .overlay::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .text {
            text-align: center;
            position: relative;
            z-index: 2;
            color: white;
            padding: 20px;
        }

        .proposal img {
            align-self: center;
            max-width: 60%;
            /* Scale to fit the container */
            min-width: 200px;
            /* Prevent the image from shrinking too much */
            max-height: 2500px;
            /* Set a maximum height */
            height: auto;
            /* Maintain aspect ratio */
            object-fit: contain;
            /* Ensure the full image is displayed */
        }

        .story img {
            align-self: right;
            max-width: 60%;
            min-width: 200px;
            max-height: 500px;
            height: auto;
            object-fit: contain;
        }

        p {
            max-width: 800px;
            margin: 0 auto;
            /* Center-align text block */
            line-height: 1.6;
            /* Increase line spacing for readability */
            color: white;
            /* Text color for contrast */
        }

        h1 {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            /* Center-align text block */
            line-height: 1.6;
            /* Increase line spacing for readability */
            color: white;
        }

        .pic {
            text-align: left;
        }

        .container {
            text-align: center;
            /* Center text and inline elements */
            margin: 30px auto;
            /* Add spacing and center the container */
            max-width: 800px;
            /* Set a width limit for the content */
        }

        .container img {
            max-width: 100%;
            /* Ensure images scale with the container */
            height: auto;
            /* Maintain aspect ratio */
            border-radius: 10px;
            /* Optional: Rounded corners for images */
            margin: 20px 0;
            /* Add spacing around images */
        }

        .container p {
            line-height: 1.6;
            /* Improve readability */
            color: white;
            /* Ensure contrast */
        }
    </style>
</head>

<body>
    <?php include 'header.html'; ?>
    <main>
        <div class="overlay">
            <div class="story">
                <p>
                    We have been providing clients with exceptional service for more than 80 years.
                    Our high class accomodations provided by our lodge will be sure to surpase your expectations.
                    The Moffatbay Marina has slips available to rent and can acomodate both large and small vessels.
                </p>
                <h1>OUR STORY</h1><br>

                <p>
                    Owning a marina was a dream that Linus and Rebecca Snoot had been saving money to fulfill for many
                    years.
                    This dream became a reality far sooner than they could have imagined when John H. Kipps, a wealthy
                    industrialist and the marina's owner at the time, decided to give away his possessions. This
                    decision was driven
                    by a misguided spiritual adviser who convinced him that the world was coming to an end. In January
                    of 1945 the
                    ownership of "Kippss Slipps" was transfered to the Snoots and renavations began. The name was
                    changed to Moffat Bay
                    and it opened the following year. The family continued to improve the marina until it became the
                    lucsurious Marina you see today. Moffat Bay is perferct for:
                </p>
                <div class="container">
                    <h1>Proposals</h1>
                    <p>
                        Moffat Bay Marina is a great place to getaway with your special someone. From proposals to 50th
                        Anniversaries,
                        your special day will be perfect here at Moffat Bay.
                    </p>
                    <img src="images/romanticprop.webp" alt="Proposal Image">
                </div>

                <div class="container">
                    <h1>Celebrations</h1>
                    <p>
                        Celebrate Graduations, Birthdays, Family Reunions, or any occasion on the water.
                    </p>
                    <img src="images/partygirls.webp" alt="Celebration Image">
                </div>

                <div class="container">
                    <h1>Retire in Style</h1>
                    <p>
                        Finally retired? Moffat Bay provides the perfect atmosphere to enjoy your retirement
                        on the water.
                    </p>
                    <img src="images/finalyRetired.webp" alt="Retirement Image">
                </div>
                <div class="container">
                    <h1>Unforgetable Family Vacations</h1>
                    <p>
                        A family vacation that everyone will enjoy.
                    </p>
                    <img src="images/family.jpg" alt="Retirement Image">
                </div>




            </div>
        </div>



    </main>
    <footer>
        <p>&copy; 2025 Your Website. All rights reserved.</p>
    </footer>
</body>

</html>