import "./styles/calendrier.css";

import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import frLocale from '@fullcalendar/core/locales/fr';

//pour lancer le code js quand le dom est chargé (pour pouvoir mettre les infos .js dans le haut du twig)
document.addEventListener("DOMContentLoaded", function() {

    //obtenir les donnees (JSON) du controller
    let div_calendrier = document.getElementById("div_calendrier");
    
    let eventsJSON = div_calendrier.dataset.calendrier;

    let eventsArray = JSON.parse (eventsJSON);

    // console.log (eventsArray);

    // creer l'objet calendar (fullcalendar)

    let calendar = new Calendar (div_calendrier, {
            locale: 'fr',
            events: eventsArray,
            displayEventTime: false, // cacher l'heure
            initialView: "dayGridMonth",
            initialDate: new Date(), // aujourd'hui
            headerToolbar: {
                left: "today",
                center: "title",
                right: "prev,next",
                display: 'backgroundColor',
            },
            plugins: [interactionPlugin, dayGridPlugin],

            // fixer les evts (click) charger une autre page (avec la date et l'equipe ds l'url)
            dateClick: function (info){
                
                console.log(div_calendrier.dataset.equipe);
                window.location.href = "/evenement/" + info.dateStr + "/" + div_calendrier.dataset.equipe ;
            },

            //afficher la page URL de l'evt lorsqu'on clique sur un evenement qui se trouve dans le calendrier et les présences pour ce jour
            eventClick: function(info) {
                let eventStart = info.event.start; // Récupération de la date de début de l'événement
                let formattedDate = eventStart.toISOString().split('T')[0]; 
                let eventId = info.event.id;

                console.log(div_calendrier.dataset.equipe + formattedDate);

                alert('Event: ' + info.event.title + formattedDate);

                window.location.href = "/presence/jour/" + formattedDate + "/" + div_calendrier.dataset.equipe + "/" + info.event.title + "/" + eventId;
            
            }

        });

        calendar.render();

});
