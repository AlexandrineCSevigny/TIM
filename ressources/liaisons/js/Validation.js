/**
 * @file Validation
 * @author Alexandrine C. Sévigny <asevigny@hotmail.fr>
 * @version 1
 */
define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    var Validation = /** @class */ (function () {
        function Validation(messagesValidation) {
            // Les inputs
            this.refNom = null;
            this.refCourriel = null;
            this.refDestinataire = null;
            this.refSujet = null;
            this.refMessage = null;
            //---- Attributs écouteurs d'événements -----
            this.validerChamp_lier = null;
            this.validerListe_lier = null;
            this.messagesValidation = messagesValidation;
            this.initialiser();
        }
        // Initialisation des evenements et de la valdiation
        Validation.prototype.initialiser = function () {
            //---- Initialisation des écouteurs d'événements ----
            this.validerChamp_lier = this.validerChamp.bind(this);
            this.validerListe_lier = this.validerListe.bind(this);
            //---- Initialisation des attributs ----
            this.refNom = document.querySelector('.form__nom');
            this.refCourriel = document.querySelector('.form__courriel');
            this.refDestinataire = document.querySelector('.form__destinataire');
            this.refSujet = document.querySelector('.form__sujet');
            this.refMessage = document.querySelector('.form__message');
            //---- Écouteurs d'événements ----
            this.refNom.addEventListener("blur", this.validerChamp_lier);
            this.refCourriel.addEventListener("blur", this.validerChamp_lier);
            this.refDestinataire.addEventListener("blur", this.validerListe_lier);
            this.refSujet.addEventListener("blur", this.validerChamp_lier);
            this.refMessage.addEventListener("blur", this.validerChamp_lier);
        };
        // Validation des input de type texte
        Validation.prototype.validerChamp = function (evenement) {
            var element = evenement.currentTarget;
            var valeurChamp = element.value;
            var motif = "";
            if (element.name == 'message') {
                // Les textareas ne prennent pas de motif, donc je lui en fourni un
                motif = "^[a-zA-ZÀ-ÿ\\-\!\@\$\%\?\&\*\(\)\.\;\:\+\:\{\}\<\>\^\'\" ]{1,1000}$";
            }
            else {
                motif = element.pattern;
            }
            if (valeurChamp === '') {
                this.afficherErreur(element, 'vide');
            }
            else {
                var resultatMotif = this.verifierMotif(valeurChamp, motif);
                if (resultatMotif === true) {
                    this.afficherSucces(element);
                }
                else {
                    this.afficherErreur(element, 'motif');
                }
            }
        };
        // Validation des input de type select
        Validation.prototype.validerListe = function (evenement) {
            var element = evenement.currentTarget;
            var valeurChamp = element.value;
            if (valeurChamp == '') {
                this.afficherErreur(element, 'vide');
            }
            else {
                this.afficherSucces(element);
            }
        };
        // Validation des patterns
        Validation.prototype.verifierMotif = function (valeurChamp, motif) {
            var regExp = new RegExp(motif);
            return regExp.test(valeurChamp);
        };
        // Méthode qui gère le succès d'un champs
        Validation.prototype.afficherSucces = function (element) {
            var conteneurFormulaire = $(element).closest('.ctnForm');
            var champValidation = conteneurFormulaire.find('.validation__message');
            // Retire l'icone d'erreur s'il est présent
            champValidation.html('');
            // Ajout de l'icone de succès
            champValidation.addClass('validation__message--succes');
            conteneurFormulaire.find('.input').addClass('input--succes');
            conteneurFormulaire.find('.input').removeClass('input--erreur');
        };
        // Affichage de l'erreur et retrait de l'icone de succès
        Validation.prototype.afficherErreur = function (element, typeMessage) {
            var conteneurFormulaire = $(element).closest('.ctnForm');
            var champValidation = conteneurFormulaire.find('.validation__message');
            // Ajout de l'icone d'erreur
            champValidation.removeClass('validation__message--succes');
            champValidation.html(this.messagesValidation[element.name]['erreurs'][typeMessage]);
            conteneurFormulaire.find('.input').removeClass('input--succes');
            conteneurFormulaire.find('.input').addClass('input--erreur');
        };
        return Validation;
    }());
    exports.Validation = Validation;
});
//# sourceMappingURL=Validation.js.map