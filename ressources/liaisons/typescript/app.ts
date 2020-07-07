/**
 * @Project Tim - App
 * @author Alexandrine C. Sevigny <asevigny@outlook.fr>
 * @date Septembre 2019 - Version 1.0.1
 */

import {Validation} from "./Validation";

// On ajoute la classe js sur le body pour avoir un css en fallback
document.body.classList.add('js');

let conteneurPage = $('main');

// On importe la validation
if (conteneurPage.hasClass('joindre')) {
    new Validation(messagesValidationClient);
}


