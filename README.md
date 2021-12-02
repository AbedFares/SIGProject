# Géo-STAT
## Website to visualize data on a map

During this project we have developed a website that let the user fill a form about the state of the internet in Tunisia and then visualize all the data collected on an interactive map and check its statistics.

The project has been divided into three parts:
- The frontend of the form using Angular which can be found in the sigFront folder.
- The backend using Springboot which can be found in the sigBack folder.
- The map page using Leaflet which can be found in the sigMap folder.

## Features

- Fill the form about the state of the internet.
- Visualizing the data on the map of Tunisia.
- Check the collected data statistics in each governorate.

## Technologies

Our project uses the following technologies:
- [Angular](https://angular.io/)
- [Leaflet](https://leafletjs.com/)
- [PostgreSQL](https://www.postgresql.org/)
- [OpenStreetMap](https://www.openstreetmap.org/)
- [Springboot](https://spring.io/)

And of course Geo-STAT itself is an open source with a public repository on Github.

## Before running the project you will need to install the following dependencies:
- [Node.js](https://nodejs.org/)
- [PostgreSQL](https://www.postgresql.org/)
- [WAMPServer](https://www.wampserver.com/) or its equivalent to run PHP.

Before running the Angular part, run the following command on the frontend Folder :
```sh
npm install
```
This will install all the dependencies related to the frontend part of the project

## Installation

In the Springboot part, make sure to change the application properties to adjust it to your POSTgresql database.
Depending on the server you are running to run the php files, make sure to configure the php.ini file and enable the pgsql corresponding driver.
Start the Angular project with

```sh
ng serve
```
Check out the home page at http://localhost:4200
