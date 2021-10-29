@extends('layouts.custom')

@section('content')
    <div class="container mb-5 pt-7">
        {{-- <h2 class="text-tertiary">Qui sommes nous:</h2>
        <p class="fs-5 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum sunt eius vitae repellat excepturi blanditiis, doloribus fugit
            quo pariatur in quas magnam ullam fugiat perferendis id odit! Placeat, saepe vel?</p> --}}

        <h2 class="text-tertiary">{{ __('Le rôle de Dz-AliExpress:') }}</h2>
        <p class="fs-5 mb-5">
            {{ __("Notre rôle est d'offrir la possibilité d'achat et de suivi de produits Ali express conforme à la règlementation algérienne des produits importés à tous les citoyens algériens sur tout le territoire national.") }}
        </p>

        <h2 class="text-tertiary">{{ __('Conditions Générales:') }}</h2>
        <h4>{{ __('1. Faire une recherche:') }}</h4>
        <p class="fs-5">{{ __("- Vous devez copier l'URL 'le lien' de l'article choisit sur") }} <strong>{{ __('Aliexpress.com') }}</strong>
            {{ __(', sur la barre de recherche de') }}<strong>dz-ali.express</strong> {{ __('puis sélectionner rechercher') }} <i class="fas fa-search"></i>
        </p>
        <p class="fs-5">
            {{ __('- Le lien doit être copié à partir du site') }} <strong>{{ __('Aliexpress.com') }}</strong>
            {{ __('et ne doit contenir aucune erreur ou modification.') }}
        </p>

        <h4>{{ __('2. Faire une commande:') }}</h4>
        <p class="fs-5">
            {{ __('une fois la recherche effectuée vous aurez comme résultat le même produit') }}
            <strong>{{ __("d'AliExpress") }}</strong>{{ __(", vous devez sélectionner les détails de l'article 'couleur, type de pack, dimension, taille…' puis l'ajouter au panier") }}
            <i class="fas fa-shopping-cart"></i> {{ __('via le bouton') }} <strong>{{ __('Ajouter au panier') }}</strong>
        </p>
        <p class="fs-5">
            - {{ __("Vous devez vous inscrire en fournissant Votre nom complet, adresse exacte,  numéro de téléphone et un mot de passe pour se connecter avec' la première fois avant qavant d’ajouter un produit au panier") }}
        </p>
        <p class="fs-5">
            {{ __("- Toutes les informations personnelles saisies au moment de l'inscription doivent être") }}
            <strong>{{ __('correctes') }}</strong>{{ __(', se tromper sur ces informations risque de vous faire perdre vos commandes.') }}
        </p>
        <p class="fs-5">
            {{ __("- Après inscription, vous n'avez plus qu'à envoyer votre commande via le bouton 'Passer ma commande' qui se trouve sur la page du panier de votre profil.") }}
        </p>

        <h4>{{ __('3. Effectuer un paiement:') }}</h4>
        <p class="fs-5">
            {{ __("- Une fois la commande envoyée, vous recevrez SMS contenant tous les détails nécessaires, les options de votre produit, sa valeur total (prix de l'article avec un change de") }}
            <code>1$ = 186{{ __('DA') }}</code> + {{ 'une commission de' }} <code>350{{ __('DA') }} ~
                2500{{ __('DA') }}</code>
            {{ __("selon le prix de l'article + les frais de livraison) et les coordonnées des méthodes de paiement acceptés") }} <strong>"CCP,
                BaridiMob"</strong>.
        </p>
        <p class="fs-5">
            {{ __('- Après réception du') }}
            <strong>{{ __('SMS') }}</strong>{{ ', vous serai contacté par notre équipe via appel pour confirmation de commande et assistance.' }}
        </p>
        <p class="fs-5">
            {{ __("- Une fois la méthode de paiement choisie et effectuée, vous devez envoyer un justificatif acceptable via le bouton") }}
            <strong>"{{ __('Confirmer Paiement') }}"</strong> {{ __('qui se trouve sur votre profil.') }} <br> <i class="far fa-user"></i> =>
            <strong>{{ __('Mes Commandes') }}</strong>
        </p>
        <p class="fs-5">
            {{ __('- Dès confirmation du paiement total par notre équipe, votre commande sera effectuée.') }}
        </p>

        <h4>{{ __('4. Suivi et tracking:') }}</h4>
        <p class="fs-5">
            {{ __('- Vous recevrez par message le numéro de tracking de votre produit dès sa création par le vendeur Aliexpress, cela peut prendre 1 à 4 jours.') }}
        </p>
        <p class="fs-5">
            {{ __('- Le tracking code vous permet de suivre votre colis du point de départ') }} "<strong>{{ __('Chine') }}</strong>"
            {{ __("jusqu'au point d'arriver") }} "<strong>{{ __('la poste la plus proche de votre résidence') }}</strong>",
        </p>

        <h4>{{ __('5. Réception du colis:') }}</h4>
        <p class="fs-5">
            - {{ __('Vous recevrez une lettre recommandé de la poste la plus proche de votre domicile qui vous indiquera de venir récupérer votre colis') }}
        </p>


        <h4>{{ __('6. Protections et garanties:') }}</h4>
        <p class="fs-5">
            - {{ __('Vous disposez de toutes les protections et garanties offertes par') }} <strong>Aliexpress.com</strong>
            {{__("et notre service assistance sera toujours à l'écoute de vos questionnements et
            préoccupations et interviendra en cas de problèmes de délais de livraison.")}}
        </p>
        <p class="fs-5">
            - {{ __("Le délai de livraison ne dépassera pas les 75 jours selon la protection client d'Aliexpress, au cas contraire, notre service assistance contactera") }} <strong>Aliexpress</strong> {{__('pour le remboursement et vous serez rembourser.')}}
        </p>

        <h4>{{ __('7. Objets Interdis:') }}</h4>
        <ul class="mb-5">
            <li class="fw-bold">{{ __('Alcool') }}</li>
            <li class="fw-bold">{{ __('Armes et couteaux') }}</li>
            <li class="fw-bold">{{ __("Equipements médicaux d'occasion") }}</li>
            <li class="fw-bold">{{ __('Tabac') }}</li>
            <li class="fw-bold">{{ __("Feux d'artifice") }}</li>
            <li class="fw-bold">{{ __('Marchandises interdites ou réglementées') }}</li>
            <li class="fw-bold">{{ __("Matériels destinés à l'ouverture des serrures") }}</li>
            <li class="fw-bold">{{ __('Cartes de crédit') }}</li>
            <li class="fw-bold">{{ __('Armes à feu et explosifs') }}</li>
            <li class="fw-bold">{{ __('Billets de loterie') }}</li>
            <li class="fw-bold">{{ __('Drogues et stupéfiants') }}</li>
            <li class="fw-bold">{{ __('Equipements de surveillance interdits') }}</li>
            <li class="fw-bold">{{ __('Médicaments et parapharmacie') }}</li>
            <li class="fw-bold">{{ __('Substances dangereuses et illicites') }}</li>
        </ul>

        <h2 class="text-tertiary">{{ __('Respect de votre vie privée/données personnelles:') }}</h2>
        <p class="fs-5">
            - {{ __('Tous vos données personnelles sont cryptées et sécurisées') }}
        </p>
        <p class="fs-5">
            - {{ __('Nous sommes les seuls destinataires des données qui nous sont transmises.') }}
        </p>
        <p class="fs-5">
            - {{ __("Vous disposez d'un droit d'accès, de modification, de rectification et de suppression des données qui vous concernent tant que votre disposer d'un compte valide et actif")}}
        </p>
    </div>
@endsection
