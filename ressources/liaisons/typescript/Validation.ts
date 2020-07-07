/**
 * @file Validation
 * @author Alexandrine C. Sévigny <asevigny@hotmail.fr>
 * @version 1
 */

export class Validation {

    // Message d'erreur des champs
    private messagesValidation: JSON;

    // Les inputs
    private refNom: HTMLInputElement = null;
    private refCourriel: HTMLInputElement = null;
    private refDestinataire: HTMLSelectElement = null;
    private refSujet: HTMLInputElement = null;
    private refMessage: HTMLInputElement = null;

    //---- Attributs écouteurs d'événements -----
    private validerChamp_lier: any = null;
    private validerListe_lier: any = null;

    public constructor(messagesValidation) {
        this.messagesValidation = messagesValidation;
        this.initialiser();
    }

    // Initialisation des evenements et de la valdiation
    private initialiser(): void {

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
    }

    // Validation des input de type texte
    private validerChamp(evenement): void {
        const element = evenement.currentTarget;
        const valeurChamp = element.value;
        var motif = "";

        if (element.name == 'message') {
            // Les textareas ne prennent pas de motif, donc je lui en fourni un
            motif = "^[a-zA-ZÀ-ÿ\\-\!\@\$\%\?\&\*\(\)\.\;\:\+\:\{\}\<\>\^\'\" ]{1,1000}$";
        } else {
            motif = element.pattern;
        }

        if (valeurChamp === '') {
            this.afficherErreur(element, 'vide');
        } else {
            let resultatMotif = this.verifierMotif(valeurChamp, motif);

            if (resultatMotif === true) {
                this.afficherSucces(element);
            } else {
                this.afficherErreur(element, 'motif');
            }
        }
    }

    // Validation des input de type select
    private validerListe(evenement): void {
        const element = evenement.currentTarget;
        const valeurChamp = element.value;

        if (valeurChamp == '') {
            this.afficherErreur(element, 'vide');
        } else {
            this.afficherSucces(element);
        }
    }

    // Validation des patterns
    private verifierMotif(valeurChamp, motif): boolean {
        const regExp = new RegExp(motif);
        return regExp.test(valeurChamp);
    }

    // Méthode qui gère le succès d'un champs
    private afficherSucces(element): void {
        const conteneurFormulaire = $(element).closest('.ctnForm');
        const champValidation = conteneurFormulaire.find('.validation__message');

        // Retire l'icone d'erreur s'il est présent
        champValidation.html('');

        // Ajout de l'icone de succès
        champValidation.addClass('validation__message--succes');
        conteneurFormulaire.find('.input').addClass('input--succes');
        conteneurFormulaire.find('.input').removeClass('input--erreur');
    }

    // Affichage de l'erreur et retrait de l'icone de succès
    private afficherErreur(element, typeMessage): void {
        const conteneurFormulaire = $(element).closest('.ctnForm');
        const champValidation = conteneurFormulaire.find('.validation__message');

        // Ajout de l'icone d'erreur
        champValidation.removeClass('validation__message--succes');
        champValidation.html(this.messagesValidation[element.name]['erreurs'][typeMessage]);
        conteneurFormulaire.find('.input').removeClass('input--succes');
        conteneurFormulaire.find('.input').addClass('input--erreur');
    }
}