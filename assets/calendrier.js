import "./styles/calendrier.css";

import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";


//pour lancer le code js quand le dom est chargé
document.addEventListener("DOMContentLoaded", function() {

    //obtenir les donnees (JSON) du controller
    let div_calendrier = document.getElementById("div_calendrier");
    
    let eventsJSON = div_calendrier.dataset.calendrier;

    let eventsArray = JSON.parse (eventsJSON);

    //console.log (eventsArray);

    // creer l'objet calendar (fullcalendar)

    let calendar = new Calendar (div_calendrier, 
        {
            events: eventsArray,
            displayEventTime: false, // cacher l'heure
            initialView: "dayGridMonth",
            initialDate: new Date(), // aujourd'hui
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            plugins: [interactionPlugin, dayGridPlugin]
        }     
        );

        calendar.render();

    // mettre le calendar ds le div



    //fixer le format



    // fixer les evts (click) charger una autre page (avec la ate et l'equipe ds l'url)







})