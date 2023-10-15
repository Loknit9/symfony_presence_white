import "./styles/calendrier.css";

import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import axios from "axios";

//pour lancer le code js quand le dom est chargé (pour pouvoir mettre les infos .js dans le haut du twig)
document.addEventListener("DOMContentLoaded", function() {

    //obtenir les donnees (JSON) du controller
    let div_calendrier = document.getElementById("div_calendrier");
    
    let eventsJSON = div_calendrier.dataset.calendrier;

    let eventsArray = JSON.parse (eventsJSON);

    // console.log (eventsArray);

    // creer l'objet calendar (fullcalendar)

    let calendar = new Calendar (div_calendrier, {
            events: eventsArray,
            displayEventTime: false, // cacher l'heure
            initialView: "dayGridMonth",
            initialDate: new Date(), // aujourd'hui
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            plugins: [interactionPlugin, dayGridPlugin],

            dateClick: function (info){
                console.log(info.dateStr);
                window.location.href = "/afficher/liste/equipes/" + info.dateStr + "/" + div_calendrier.dataset.equipe ;
            }
            
        });

        calendar.render();

    // mettre le calendar ds le div



    //fixer le format



    // fixer les evts (click) charger una autre page (avec la date et l'equipe ds l'url)







});