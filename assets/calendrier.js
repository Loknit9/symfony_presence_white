import "./styles/calendrier.css";

import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";

import axios from "axios";


//pour lancer le code js quand le dom est chargé
document.addEventListener("DOMContentLoaded", function() {

    //obtenir les donnees (JSON) du controller
    let div_calendrier = document.getElementById("div_calendrier");
    
    let eventsJSON = div_calendrier.dataset.calendrier;

    HTMLFormControlsCollection.log (eventsJSON);


    // creer l'objet calendar (fullcalendar)



    // mettre le calendar ds le div



    //fixer le format



    // fixer les evts (click) charger una autre page (avec la ate et l'equipe ds l'url)







})