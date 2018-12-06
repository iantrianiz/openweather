Simple Open Weather Map Application

FILES ON THIS SYSTEM:
1. tmaps.sql -> Database table and sample records retrieved from https://github.com/Elkfox/Australian-Postcode-Data
2. db_info.php -> Database credential info (Database Name, User and Password)
3. code.php -> File which will generate the XML required by Google Maps
4. test_near.php -> Integration between Google Maps and Openweathermap API. Contain also distance formula and conversion weather formula
5. index.html -> main file, search form for specific city/postcode and distance

SIMPLE SETUP INSTRUCTIONS:
1. Assumed you already have a hosting. From your hosting panel, go to the MySQL Database Administration and create a new database, username and password. See file db_info.php. You can changes all of this info with your own text name if necessary.
2. After database generated, go to PHPMYADMIN and do the import data from the file tmaps.sql. Once imported it will generated a 
table tmaps contain info about the PostCode, Place Name, State Name, State Code, Latitude and Longitude. All of the current data is retrieved from https://github.com/Elkfox/Australian-Postcode-Data
3. Put code.php, test_near.php and index.html to your hosting root or sub folder.
4. Call from your browser (Mozila, Chrome etc) the main index.html file and you will see the form to Entry a City/Post Code and Radius Distance.
5. Once submitted, you will see the list of city based on your search form content. Also, it showing up on Google Maps with Red Marker. If you click on every Red Marker you will see detail info about the City Weather.
6. OpenWeatherMap API contain much parameters which we can used later. We only show some parameters of Temp, Pressure, Humidity, Wind Speed and Clouds.

Happy Trial!

Cheers
