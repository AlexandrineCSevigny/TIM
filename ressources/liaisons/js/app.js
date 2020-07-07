/**
 * @Project Tim - App
 * @author Alexandrine C. Sevigny <asevigny@outlook.fr>
 * @date Septembre 2019 - Version 1.0.1
 */
define(["require", "exports", "./Validation"], function (require, exports, Validation_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    // On ajoute la classe js sur le body pour avoir un css en fallback
    document.body.classList.add('js');
    var conteneurPage = $('main');
    // On importe la validation
    if (conteneurPage.hasClass('joindre')) {
        new Validation_1.Validation(messagesValidationClient);
    }
});
//# sourceMappingURL=app.js.map