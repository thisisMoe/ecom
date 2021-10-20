@extends('layouts.custom')

@section('content')
    <div class="container mb-5 pt-7">
                <h1 class="mb-5 text-center">Questions Fréquentes</h1>
            <div class="row justify-content-center mt-4">
                <div class="col-12 col-lg-8">
                    <div class="accordion" id="accordionExample1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button accordion-button-rtl collapsed" style="" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1"><strong>{{ __('Quelles sont nos garanties ?') }}</strong></button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1" style="">
                                <div class="accordion-body">
                                    {{ __('en plus de nos excellents services d’assistance, nous fournissons à nos chers clients toutes les garanties qu’AliExpress fournit aux clients Algériens. Nous passons également par tous les avis des vendeurs pour s’assurer que vous n’achetez pas d’un vendeur avec une mauvaise réputation (Nous faisons de notre mieux pour assurer aucun produit cassé, ou mauvais emballage pour les produits de nos clients)') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2"><strong>{{ __('Quelles sont nos méthodes de paiement acceptées?') }}</strong></button></h2>
                            <div id="faq2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1" style="">
                                <div class="accordion-body">
                                    {{ __('Nous acceptons: ') }} <strong>CCP, BaridiMob</strong>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq8" aria-expanded="false" aria-controls="faq8"><strong>{{ __('Comment puis-je confirmer ma commande?') }}</strong></button></h2>
                            <div id="faq8" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Après avoir effectué votre paiement, vous devrez nous envoyer soit le reçu de paiement en cliquant sur ') }}
                                    <strong>{{ __('"Confirmer le paiement" ') }}</strong>
                                    <a class="text-underline" href="{{ route('account') }}">{{ __('ici') }} <i class="far fa-user"></i></a>
                                    {{ __(', ou nous envoyer un email contenant la confirmation de BaridiMob') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq9" aria-expanded="false" aria-controls="faq9"><strong>{{ __('Dois-je payer avant ou après avoir reçu le produit?') }}</strong></button></h2>
                            <div id="faq9" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Le paiement de l’argent doit être fait avant de passer votre commande à AliExpress.') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3"><strong>{{ __('Que puis-je faire si ma commande n’arrive pas dans les délais de livraison garantis par le vendeur ?') }}</strong></button></h2>
                            <div id="faq3" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1" style="">
                                <div class="accordion-body">
                                    {{ __('Dans le cadre des garanties AliExpress, Nous pouvons soumettre des demandes de remboursement jusqu’à 15 jours après la fin de votre commande. nous pouvons le faire en ouvrant un litige auprès d’AliExpress.') }}
                                    <strong>
                                        {{ __('Veuillez noter que nous ne pouvons ouvrir qu’un seul litige par commande.') }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4"><strong><strong>{{ __('Les articles que j’ai reçus n’étaient pas tels que décrit par le vendeur. Que puis-je faire?') }}</strong></strong></button></h2>
                            <div id="faq4" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Tout produit livré qui ne correspond pas à la description du vendeur est admissible à un remboursement. Nous pouvons également trouver une solution qui convient à la fois à vous et au vendeur.') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5"><strong>{{ __('Comment puis-je m’assurer que les produits que j’achète sont authentiques?') }}</strong></button></h2>
                            <div id="faq5" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Sur AliExpress.com, vous pouvez trouver de nombreux vendeurs qui offrent des produits authentiques garantis.') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6"><strong>{{ __('Quelles autres protections puis-je obtenir pour des produits qui ne sont pas authentiques?') }}</strong></button></h2>
                            <div id="faq6" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Tous les produits (Guaranteed Genuine) ont été vérifiés par AliExpress. Si vous recevez toujours un produit contrefait, vous obtiendrez un remboursement complet (frais d’expédition inclus).') }}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq7" aria-expanded="false" aria-controls="faq7"><strong>{{ __('Quels sont nos frais?') }}</strong></button></h2>
                            <div id="faq7" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    {{ __('Nos frais varient en fonction du prix du produit, mais en règle générale, nous l’avons fixé à un minimum de 350DA et à un maximum de 2500DA, ce petit montant nous aide à fournir les meilleurs services d’achat en ligne tout en le rendant aussi facile que possible pour vous.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
