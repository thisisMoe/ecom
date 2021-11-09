<template>
  <div id="appContainer">
    <div v-if="!empty">
      <section class="pt-3">
        <div class="mx-auto" style="max-width: 1130px">
          <!-- Spinner -->
          <div
            v-if="loading"
            class="
              h-100vh
              d-flex
              flex-column
              justify-content-center
              align-items-center
            "
          >
            <div
              class="spinner-border"
              style="width: 5rem; height: 5rem; position: relative; top: -95px"
              role="status"
            >
              <span class="sr-only" v-if="this.$locale == 'fr'"
                >Loading...</span
              >
              <span class="sr-only" v-if="this.$locale == 'ar'">تحميل...</span>
            </div>
            <div class="text-center">
              <p v-if="this.$locale == 'fr'">
                Veuillez patienter pendant le chargement des données
                d’AliExpress
              </p>
              <p v-if="this.$locale == 'ar'">
                الرجاء الانتظار لحظة أثناء تحميل البيانات من AliExpress
              </p>
            </div>
          </div>
          <div v-else class="row justify-content-center mb-3 mb-lg-4">
            <div class="col-md-6">
              <div
                v-if="!imagesLoaded"
                class="h-100 d-flex justify-content-center align-items-center"
                style="height: 413px !important"
              >
                <div
                  class="spinner-border"
                  style="width: 3rem; height: 3rem"
                  role="status"
                >
                  <span class="sr-only">Loading...</span>
                </div>
              </div>

              <div
                v-else
                id="Carousel2"
                class="carousel slide mb-4"
                data-ride="carousel"
              >
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      class="d-block w-100"
                      ref="image"
                      :src="images[0]"
                      alt="slide"
                    />
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" :src="images[1]" alt="slide" />
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" :src="images[2]" alt="slide" />
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" :src="images[3]" alt="slide" />
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" :src="images[4]" alt="slide" />
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" :src="images[5]" alt="slide" />
                  </div>
                </div>
                <a
                  class="carousel-control-prev"
                  href="#Carousel2"
                  role="button"
                  data-bs-slide="prev"
                >
                  <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                    style="
                      background-color: #222;
                      padding: 3px 11px;
                      border-radius: 4px;
                    "
                  ></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a
                  class="carousel-control-next"
                  href="#Carousel2"
                  role="button"
                  data-bs-slide="next"
                >
                  <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                    style="
                      background-color: #222;
                      padding: 3px 11px;
                      border-radius: 4px;
                    "
                  ></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <div></div>
            </div>

            <div class="col-md-6 px-4">
              <div v-html="title" class="mb-2"></div>
              <div
                class=""
                style="background: #f5f9fc; padding: 25px; border-radius: 10px"
              >
                <div class="mb-1">
                  <span class="fas fa-store-alt text-tertiary"></span>
                  <span class="fw-bold">{{ storeName }}</span>
                </div>
                <div class="d-flex flex-column mb-2">
                  <div class="font-small mb-0 d-flex gap-2 align-items-center">
                    <strong>{{ positiveRate }}</strong>
                    <span class="text-muted" v-if="this.$locale == 'fr'"
                      >Évaluations positives
                    </span>
                    <span class="text-muted" v-if="this.$locale == 'ar'"
                      >تقييما إيجابيا</span
                    >
                  </div>
                  <div class="font-small">
                    <strong>{{ followingNumber }} </strong>
                    <span class="text-muted" v-if="this.$locale == 'fr'"
                      >Abonneés</span
                    >
                    <span class="text-muted" v-if="this.$locale == 'ar'"
                      >مشترك</span
                    >
                  </div>
                </div>
                <div class="d-flex gap-1 align-items-center">
                  <div
                    class="Stars"
                    :style="
                      '--rating: ' +
                      parsedScript.titleModule.feedbackRating.averageStar +
                      ';'
                    "
                  ></div>
                  <p class="mb-0">
                    <span class="fw-bold">{{
                      parsedScript.titleModule.feedbackRating.averageStar
                    }}</span>
                    -
                    <span class="fw-bold"
                      >{{ parsedScript.titleModule.tradeCount }}
                      <span v-if="locale == 'ar'">طلبات</span>
                      <span v-else>Commandes</span>
                    </span>
                  </p>
                </div>
              </div>
              <hr class="my-4" />
              <div class="">
                <!-- if no chosen price -->
                <div class="text-center mb-3" v-if="!chosenPrice">
                  <p
                    class="
                      d-flex
                      justify-content-center
                      align-items-center
                      fw-bold
                      fs-2
                      my-1
                    "
                    v-if="equalPrice > 0"
                  >
                    {{
                      new Intl.NumberFormat().format(Math.round(equalPrice))
                    }}DA
                    <span v-if="discount > 0" class="badge bg-danger ms-2"
                      >-{{ discount }}%</span
                    >
                  </p>
                  <p
                    v-else
                    class="
                      d-flex
                      justify-content-center
                      align-items-center
                      fw-bold
                      fs-2
                      my-1
                    "
                  >
                    {{ minPrice }}<span v-show="this.$locale == 'fr'">DA</span
                    ><span v-show="this.$locale == 'ar'">دج</span> -
                    {{ maxPrice }}<span v-if="this.$locale == 'fr'">DA</span
                    ><span v-if="this.$locale == 'ar'">دج</span>
                    <span v-if="discount" class="badge bg-danger ms-2 me-2"
                      >-{{ discount }}%</span
                    >
                  </p>
                </div>
                <!-- if chosen price -->
                <div
                  v-else
                  class="
                    d-flex
                    justify-content-center
                    align-items-center
                    gap-2
                    mb-4
                  "
                >
                  <p class="fw-bold fs-2 my-1">
                    {{ new Intl.NumberFormat().format(Math.round(chosenPrice))
                    }}<span v-if="this.$locale == 'fr'">DA</span
                    ><span v-if="this.$locale == 'ar'">دج</span>
                  </p>
                  <div v-if="discount">
                    <span class="fw-bold"
                      ><mark
                        ><del>{{
                          new Intl.NumberFormat().format(
                            Math.ceil(
                              (Math.round(chosenPrice) * 100) /
                                (100 - discount) /
                                10
                            ) * 10
                          )
                        }}</del
                        ><span v-if="this.$locale == 'fr'">DA</span
                        ><span v-if="this.$locale == 'ar'">دج</span></mark
                      ></span
                    >
                    <span class="badge bg-danger">-{{ discount }}%</span>
                  </div>
                </div>
                <div>
                  <p class="mb-0 font-small text-muted" v-if="shippingCost">
                    <span v-if="this.$locale == 'ar'" class="fw-bold"
                      >تكاليف الشحن:
                    </span>
                    <span v-else class="fw-bold">Frais de Livraison:</span>
                    <span class="fw-bold"
                      >{{
                        new Intl.NumberFormat().format(
                          Math.round(shippingCost)
                        )
                      }}<span v-if="this.$locale == 'fr'">DA</span
                      ><span v-if="this.$locale == 'ar'">دج</span></span
                    >
                  </p>
                  <p class="mb-0 font-small text-muted" v-else>
                    <span class="fw-bold" v-if="this.$locale == 'ar'"
                      >تكاليف الشحن: سيتم التأكيد</span
                    >
                    <span v-else class="fw-bold"
                      >Frais de Livraison: A Confirmer</span
                    >
                  </p>
                  <p
                    class="mb-0 font-small text-muted"
                    v-if="shippingTime !== 'N/A'"
                  >
                    <span class="fw-bold" v-if="this.$locale == 'ar'"
                      >مدة الشحن: {{ shippingTime }} يوم
                    </span>
                    <span class="fw-bold" v-else
                      >Livraison: {{ shippingTime }} Jours.</span
                    >
                  </p>
                  <p class="mb-0 font-small text-muted" v-else>
                    <span v-if="this.$locale == 'ar'"
                      >مدة الشحن: سيتم التأكيد
                    </span>
                    <span v-else>Livraison: A Confirmer.</span>
                  </p>
                </div>
              </div>
              <div class="card shadow mb-4 mt-4">
                <div class="text-center" v-if="options">
                  <p class="text-muted fw-bold p-3" v-if="this.$locale == 'fr'">
                    Couleur: {{ this.chosenColor }}
                  </p>
                  <p class="text-muted fw-bold p-3" v-if="this.$locale == 'ar'">
                    اللون: {{ this.chosenColor }}
                  </p>
                </div>

                <div v-if="!options" class="card-body">
                  <div>
                    <input
                      type="radio"
                      class="btn-check"
                      autocomplete="off"
                      id="noOptionsButton"
                      v-on:change="checkNoOptions"
                    />
                    <label
                      class="btn btn-outline-primary btn-lg"
                      for="noOptionsButton"
                      >Chine</label
                    >
                  </div>
                </div>

                <div
                  class="card-body"
                  v-for="option in options"
                  :key="option.skuPropertyId"
                >
                  <fieldset class="mb-4">
                    <legend class="h5" v-html="option.skuPropertyName"></legend>

                    <div
                      class="d-flex flex-wrap gap-2 flex-md-row flex-sm-fill"
                    >
                      <div
                        v-for="(item, index) in option.skuPropertyValues"
                        :key="index"
                        class="btn-group"
                        role="group"
                        aria-label="Basic radio toggle button group"
                      >
                        <div v-if="item.skuPropertyImageSummPath">
                          <input
                            type="radio"
                            v-on:change="
                              setPropsId(
                                $event,
                                option.skuPropertyName,
                                options.length,
                                item.propertyValueDisplayName,
                                (isImage = true)
                              )
                            "
                            :name="option.skuPropertyName"
                            :id="item.propertyValueDisplayName"
                            class="d-none imgbgchk"
                            :value="item.propertyValueDisplayName"
                            autocomplete="off"
                            :data-propId="item.propertyValueId"
                          />
                          <label
                            :for="item.propertyValueDisplayName"
                            style="
                              margin-right: 0.6rem;
                              border: 1px solid #ccc;
                              border-radius: 6px;
                            "
                          >
                            <img
                              :src="item.skuPropertyImageSummPath"
                              alt="Image 4"
                              style="border-radius: 6px"
                              v-bind:class="{ 'no-options': noOptions }"
                            />
                            <div class="tick_container">
                              <div class="tick">
                                <i class="fa fa-check"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                        <div v-else>
                          <input
                            type="radio"
                            class="btn-check"
                            :name="option.skuPropertyName"
                            :value="item.propertyValueDisplayName"
                            autocomplete="off"
                            :data-propId="item.propertyValueId"
                            :id="item.propertyValueDisplayName"
                            v-on:change="
                              setPropsId(
                                $event,
                                option.skuPropertyName,
                                options.length,
                                item.propertyValueDisplayName,
                                (isImage = false)
                              )
                            "
                          />
                          <label
                            v-html="item.propertyValueDisplayName"
                            class="btn btn-outline-primary btn-lg"
                            :for="item.propertyValueDisplayName"
                            v-bind:class="{ 'no-options': noOptions }"
                          ></label>
                        </div>
                      </div>
                    </div>
                    <!-- End of Radio -->
                  </fieldset>
                </div>
                <div
                  class="d-flex justify-content-center mb-4 mt-4"
                  v-bind:class="{ 'flex-row-reverse': this.$locale == 'ar' }"
                >
                  <form @submit.prevent="addToCart" class="d-flex">
                    <button
                      class="
                        btn btn-lg btn-primary
                        fs-5
                        text-uppercase
                        px-5
                        py-2
                      "
                      style="
                        border-top-right-radius: 0;
                        border-right: 1px solid #f5f9fc;
                        border-bottom-right-radius: 0;
                        display: inline;
                      "
                      type="submit"
                      :disabled="addingToCart"
                    >
                      <div
                        v-if="!addingToCart"
                        class="d-flex gap-2 align-items-center"
                      >
                        <span v-if="this.$locale == 'ar'">أضف إلى السلة</span>
                        <span v-if="this.$locale == 'fr'">Ajouter</span>
                        <span
                          class="fas fa-cart-arrow-down d-inlineblock"
                        ></span>
                      </div>
                      <div v-else>
                        <div class="spinner-border text-light" role="status">
                          <span class="visually-hidden">Chargement...</span>
                        </div>
                      </div>
                    </button>
                  </form>
                  <div>
                    <button
                      @click="showModal = true"
                      class="btn btn-primary py-2 fs-5"
                      style="
                        border-top-left-radius: 0;
                        border-left: 1px solid #f5f9fc;
                        border-bottom-left-radius: 0;
                        display: inline;
                      "
                    >
                      <i class="fas fa-shopping-cart"></i>

                      <span class="">({{ orderItems.length }})</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-center mt-2">
                <span v-show="noOptions" class="text-small text-danger"
                  >الرجاء تحديد خيارات المنتج قبل المواصلة</span
                >
                <span
                  v-show="addedToCart"
                  class="text-small text-success fw-bold fs-5"
                  >تم إضافة منتجك إلى عربة التسوق</span
                >
              </div>
            </div>
          </div>
          <!-- specs -->
          <div class="accordion mx-1 mb-5" id="accordionSpecs">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                  aria-expanded="false"
                  aria-controls="collapseOne"
                >
                  <span class="fw-bold" v-if="this.$locale == 'fr'"
                    ><i class="d-inline-block mx-2 far fa-file-alt"></i
                    >Specifications</span
                  >
                  <span class="fw-bold" v-if="this.$locale == 'ar'"
                    >المواصفات</span
                  >
                </button>
              </h2>
              <div
                id="collapseOne"
                class="accordion-collapse collapse"
                aria-labelledby="headingOne"
                data-bs-parent="#accordionSpecs"
                style=""
              >
                <div class="accordion-body">
                  <div class="d-flex flex-wrap gap-2">
                    <div
                      class="flex-fill p-2"
                      v-for="(prop, index) in specs"
                      :key="index"
                    >
                      <span
                        class="text-muted"
                        v-html="`${prop.attrName}: `"
                      ></span>
                      <span class="" v-html="prop.attrValue"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card shadow mx-1">
            <div class="card-body px-3 py-3 text-center">
              <p v-if="this.$locale == 'ar'">
                الرجاء الاتصال بنا إذا كنت بحاجة إلى مساعدة مع خدماتنا
              </p>
              <p v-else>
                Veuillez nous appeler Si vous avez besoin d’aide concernant nos
                services
              </p>
              <p v-if="this.$locale == 'ar'" class="fw-bold">
                الهاتف:
                <a href="tel:+213558494325">213558494325+</a>
              </p>
              <p v-else class="fw-bold">
                Téléphone: <a href="tel:+213558494325">+213558494325</a>
              </p>
            </div>
          </div>
        </div>
      </section>

      <div
        style="
          position: fixed;
          top: calc(100vh - 151px);
          right: 1rem;
          z-index: 1055;
        "
      >
        <!-- <button id="show-modal" @click="showModal = true">Show Modal</button> -->
        <button
          id="showModal"
          style="
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            border-radius: 50%;
          "
          @click="showModal = true"
          class="btn btn-primary position-relative"
        >
          <div style="">
            <i
              style="font-size: 1.5em; color: rgb(245, 249, 252)"
              class="fas py-2 fa-shopping-cart me-2"
            ></i>
            <span class="cart-number-2">
              {{ orderItems.length }}
            </span>
          </div>
        </button>

        <modal
          :locale="this.$locale"
          v-if="showModal"
          @close="showModal = false"
        >
          <div slot="body">
            <div v-if="orderItems.length">
              <div v-for="orderItem in orderItems" :key="orderItem.id">
                <div class="card shadow text-center mb-4">
                  <div class="card-header bg-white p-3">
                    <h5
                      class="text-primary mb-4"
                      v-html="orderItem.title.substring(0, 70) + '...'"
                    ></h5>
                    <span class="d-block">
                      <span class="display-1 text-dark fw-bold">
                        {{ orderItem.totalSum }}
                        <span
                          v-if="locale == 'fr'"
                          class="align-top font-medium"
                          >DA</span
                        >
                        <span
                          v-if="locale == 'ar'"
                          class="align-top font-medium"
                          >دج</span
                        >
                      </span>
                      <span class="d-block text-gray"
                        >+ {{ orderItem.shippingCost }}
                        <span v-if="locale == 'fr'" class="font-small">DA</span>
                        <span v-if="locale == 'ar'" class="font-small">دج</span>

                        <span class="fas fa-shipping-fast"></span>
                      </span>
                      <span class="d-block text-gray mt-3">
                        <strong>
                          <span v-if="locale == 'fr'" class="">Total:</span>
                          <span v-if="locale == 'ar'" class="">المجموع:</span>
                          {{ orderItem.shippingCost + orderItem.totalSum }}
                          <span v-if="locale == 'fr'" class="font-small"
                            >DA</span
                          >
                          <span v-if="locale == 'ar'" class="font-small"
                            >دج</span
                          >
                        </strong>
                      </span>
                    </span>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled mb-4">
                      <li
                        class="list-item pb-3"
                        v-for="selectedProp in orderItem.selectedProps"
                        :key="selectedProp.value"
                      >
                        <strong v-html="selectedProp.name + ':'"></strong>
                        {{ selectedProp.selected }}
                      </li>
                    </ul>
                    <div class="">
                      <button
                        @click="deleteOrderItem(orderItem.id)"
                        class="btn btn-danger animate-up-1"
                      >
                        <span class="fas fa-trash-alt"></span>
                        <span v-if="locale == 'fr'">Supprimer</span>
                        <span v-if="locale == 'ar'">حذف</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-else class="">
              <p v-if="this.$locale == 'fr'" class="fw-bold fs-5">
                Panier Vide, Veuillez ajouter un produit a votre panier avant de
                passer une commande.
              </p>
              <p v-if="this.$locale == 'ar'" class="fw-bold fs-5">
                سِلَتُك فارغة ، يرجى إضافة المنتجات التي تريد شرائها إلى السِلَة
                قبل ارسال طلبك الينا.
              </p>
              <div class="mx-auto text-center my-3">
                <img
                  src="/assets/img/empty-package.png"
                  style="width: 90px"
                  alt="Empty Package"
                />
              </div>
            </div>
          </div>
          <div slot="footer" class="d-flex">
            <button
              v-if="orderItems.length"
              class="btn btn-success fs-6 text-white"
              @click="addOrder"
            >
              <span v-if="this.$locale == 'fr'">Passez ma commande</span>
              <span v-if="this.$locale == 'ar'">أرسل طلبك الآن</span>
            </button>
          </div>
        </modal>
      </div>
    </div>
    <div v-else>
      <div class="container my-4">
        <blockquote class="blockquote text-center">
          <span v-if="this.$locale == 'fr'">
            C’est là que vous verrez les détails du produit, juste après avoir
            collé le lien du produit désiré dans la barre de recherche ci-dessus
          </span>
          <span v-if="this.$locale == 'ar'">
            هنا سترون تفاصيل المنتج ، مباشرة بعد لصق أو نسخ رابط المنتج المنشود
            من AliExpress في شريط البحث أعلاه
          </span>
          <footer class="mt-3 text-primary">
            <!-- <img
              src="/assets/img/lamp-icon.png"
              style="max-width: 150px"
              alt="Lamp Icon"
            /> -->
            <video
              loop
              autoplay
              playsinline
              muted
              style="
                border-radius: 16px;
                box-shadow: 0 0 60px 10px rgba(70, 70, 70, 0.03),
                  -10px 10px 50px rgba(0, 0, 0, 0.1),
                  -50px 50px 70px rgba(0, 0, 0, 0.05),
                  -100px 100px 100px rgba(0, 0, 0, 0.03),
                  -150px 150px 150px rgba(0, 0, 0, 0.02);
                max-width: 25%;
              "
            >
              <source src="assets/img/step1.mp4" type="video/mp4" />
            </video>

            <button
              @click="reloadPage"
              class="btn btn-info d-block mx-auto my-3"
            >
              Actualiser
            </button>
          </footer>
        </blockquote>
      </div>
    </div>
    <div
      class="
        fixed-bottom-bar
        fw-bold
        text-primary
        d-flex
        w-100
        align-items-center
        justify-content-between
        px-2 px-md-3
        d-md-none
      "
    >
      <!-- todoo -->
      <div
        class="
          d-flex
          fw-bold
          flex-column
          justify-content-start
          align-items-center
          pb-1
        "
      >
        <div v-if="!chosenPrice">
          <div class="font-small" v-show="this.$locale == 'fr'">
            veuillez sélectionner les spécs. de votre produit
          </div>
          <div class="font-small" v-show="this.$locale == 'ar'">
            الرجاء اختيار مواصفات المنتج
          </div>
        </div>
        <div v-else>
          <div class="" style="font-size:1rem;" v-show="this.$locale == 'fr'">
            {{ chosenPrice }} DA
          </div>
          <div class="" style="font-size:1rem;" v-show="this.$locale == 'ar'">
            <span>{{ chosenPrice }} دج</span>
          </div>
        </div>
        <div class="text-muted" v-if="this.$locale == 'fr'">
          Frais de Livraison: {{ shippingCost }}
        </div>
        <div class="text-muted" v-if="this.$locale == 'ar'">
          تكاليف الشحن: {{ shippingCost }}
        </div>
        <div class="text-muted" v-if="this.$locale == 'fr'">
          Livraison: {{ shippingTime }} Jours.
        </div>
        <div class="text-muted" v-if="this.$locale == 'ar'">
          مدة الشحن: {{ shippingTime }} يوم
        </div>
      </div>
      <div class="">
        <form @submit.prevent="addToCart">
          <button
            class="btn btn-primary fs-6 text-uppercase px-3 py-2"
            type="submit"
            :disabled="addingToCart"
          >
            <div v-if="!addingToCart" class="d-flex gap-2 align-items-center" style="font-size:14px;">
              <span v-if="this.$locale == 'ar'">أضف إلى السلة</span>
              <span v-if="this.$locale == 'fr'">Ajouter</span>
              <span class="fas fa-cart-arrow-down d-inlineblock"></span>
            </div>
            <div v-else>
              <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Chargement...</span>
              </div>
            </div>
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["uri"],
  data() {
    return {
      empty: false,
      link: "",
      showModal: false,
      loading: true,
      productId: null,
      title: "",
      images: [],
      options: [],
      script: null,
      parsedScript: null,
      imagesLoaded: false,
      selectedProps: [],
      obj: null,
      propsIdString: "",
      minPrice: 0,
      maxPrice: 0,
      equalPrice: 0,
      chosenPrice: null,
      fields: {},
      userId: this.$userId,
      orderItems: [],
      fee: 0,
      firstPrice: 0,
      usdP: null,
      shippingCost: 0,
      shippingTime: "N/A",
      discount: 0,
      oldPrice: 0,
      locale: this.$locale,
      noOptions: false,
      addingToCart: false,
      storeName: "",
      positiveRate: "",
      followingNumber: 0,
      specs: [],
      rate: 1.37,
      chosenColor: "",
      addedToCart: false,
      mainCatId: null,
      catId: null,
      subCatId: null,
      mainCatName: "",
      catName: "",
      subCatName: "",
    };
  },
  mounted() {
    this.loadInfo();
    this.fetchOrderItems();
  },
  updated() {
    var image = new Image();
    image.src = this.images[0];
    image.onload = () => {
      this.imagesLoaded = true;
    };
  },
  methods: {
    reloadPage() {
      window.location.reload();
    },
    checkNoOptions() {
      if (this.minPrice <= 2000) {
        this.fee = (this.minPrice + this.shippingCost) * 0.1 + 400;
      } else {
        this.fee = (this.minPrice + this.shippingCost) * 0.1 + 200;
      }
      this.chosenPrice = this.minPrice;
      this.usdP = 0;
    },
    loadInfo: function () {
      if (this.uri == "") {
        return (this.empty = true);
      }
      axios
        .get("/api/info", { params: { q: this.uri, locale: this.$locale } })
        .then((response) => {
          this.images = response.data.images;
          this.script = response.data.script;
          this.link = response.data.uri;
          this.shippingCost = Number(response.data.shippingCost) * 191;
          this.shippingCost = Math.ceil(this.shippingCost / 10) * 10;
          if (response.data.shippingTime) {
            this.shippingTime = response.data.shippingTime;
          }
        })
        .then(() => {
          var cleanedScript = this.getStringBetween(
            this.script,
            "data: ",
            ", csrfToken:"
          );
          this.parsedScript = JSON.parse(cleanedScript);
          console.log(this.parsedScript);

          this.title = this.parsedScript.titleModule.subject;
          this.productId = this.parsedScript.commonModule.productId;

          if (
            this.parsedScript.crossLinkModule.breadCrumbPathList.length == 3
          ) {
            this.mainCatId =
              this.parsedScript.crossLinkModule.breadCrumbPathList[2].cateId;
            this.mainCatName =
              this.parsedScript.crossLinkModule.breadCrumbPathList[2].name;
            this.catId = null;
            this.catName = null;
            this.subCatId = null;
            this.subCatName = null;
          }

          if (
            this.parsedScript.crossLinkModule.breadCrumbPathList.length == 4
          ) {
            this.mainCatId =
              this.parsedScript.crossLinkModule.breadCrumbPathList[2].cateId;
            this.mainCatName =
              this.parsedScript.crossLinkModule.breadCrumbPathList[2].name;
            this.catId =
              this.parsedScript.crossLinkModule.breadCrumbPathList[3].cateId;
            this.catName =
              this.parsedScript.crossLinkModule.breadCrumbPathList[3].name;
            this.subCatId = null;
            this.subCatName = null;
          }
          if (
            this.parsedScript.crossLinkModule.breadCrumbPathList.length >= 5
          ) {
            this.mainCatId =
              this.parsedScript.crossLinkModule.breadCrumbPathList[2].cateId;
            this.mainCatName =
              this.parsedScript.crossLinkModule.breadCrumbPathList[2].name;
            this.catId =
              this.parsedScript.crossLinkModule.breadCrumbPathList[3].cateId;
            this.catName =
              this.parsedScript.crossLinkModule.breadCrumbPathList[3].name;
            this.subCatId =
              this.parsedScript.crossLinkModule.breadCrumbPathList[4].cateId;
            this.subCatName =
              this.parsedScript.crossLinkModule.breadCrumbPathList[4].name;
          }

          this.storeName = this.parsedScript.storeModule.storeName;
          this.followingNumber = this.parsedScript.storeModule.followingNumber;
          this.positiveRate = this.parsedScript.storeModule.positiveRate;

          this.discount = this.parsedScript.priceModule.discount;

          this.options = this.parsedScript.skuModule.productSKUPropertyList;
          this.specs = this.parsedScript.specsModule.props;
        })
        .then(() => {
          this.loading = false;
        })
        .then(() => {
          this.setMinMaxPrice();
          this.searchInput();
        })
        .catch((err) => {
          console.log(err);
          if (err.response.status == 500) {
            this.empty = true;
          }
        });
    },
    searchInput: function () {
      axios
        .post(`api/searches/add/${this.productId}`, {
          title: this.title.substring(0, 100),
          link: this.link,
          productId: this.productId,
          image: this.images[0],
          minPrice: this.minPrice,
          maxPrice: this.maxPrice,
          equalPrice: this.equalPrice,
          mainCatId: this.mainCatId,
          catId: this.catId,
          subCatId: this.subCatId,
          mainCatName: this.mainCatName,
          catName: this.catName,
          subCatName: this.subCatName,
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getStringBetween: function (str, start, end) {
      const string = " " + str;
      let ini = string.indexOf(start);
      if (0 == ini) {
        return "";
      }
      ini += start.length;
      const len = string.indexOf(end, ini) - ini;
      return string.substr(ini, len);
    },
    setPropsId: function (
      e,
      propName,
      numberOfOptions,
      selectedPropertyName,
      isImage
    ) {
      var propValue = e.target.getAttribute("data-propId");
      if (!this.selectedProps.length) {
        this.addProp(propName, propValue, selectedPropertyName);
      }

      var result = this.selectedProps.find((prop) => prop.name == propName);

      if (result) {
        result.value = propValue;
      } else {
        this.addProp(propName, propValue, selectedPropertyName);
      }
      this.setPropsIdString();
      this.setChosenPrice();
      if (isImage) {
        this.chosenColor = selectedPropertyName;
      }
    },
    addProp: function (propName, value, selectedPropertyName) {
      this.obj = {
        name: propName,
        value: value,
        selected: selectedPropertyName,
      };
      this.selectedProps = [...this.selectedProps, this.obj];
      this.obj = null;
    },
    setPropsIdString: function () {
      this.selectedProps.forEach((prop, index) => {
        if (index == 0) {
          this.propsIdString = prop.value;
        } else {
          this.propsIdString += "," + prop.value;
        }
      });
    },
    setChosenPrice: function () {
      var selectedPack = this.parsedScript.skuModule.skuPriceList.filter(
        (item) => {
          return (
            item.skuPropIds.split("").sort().join("") ==
            this.propsIdString.split("").sort().join("")
          );
        }
      );
      console.log("selectedPack", selectedPack);
      if (selectedPack.length) {
        if (selectedPack[0].skuVal.isActivity) {
          var price =
            selectedPack[0].skuVal.skuActivityAmount.value * this.rate;
          console.log("price 1", price / this.rate);
          if (
            selectedPack[0].skuVal.discount == "99" ||
            selectedPack[0].skuVal.isActivity
          ) {
            // price = selectedPack[0].skuVal.skuCalPrice * 191;
            // price = selectedPack[0].skuVal.skuActivityAmount.value * this.rate;
            price = selectedPack[0].skuVal.skuAmount.value * this.rate;
            console.log("price 1.1", price / this.rate);
          } else if (price < 200) {
            price = 200 * this.rate;
            console.log("price 1.2", price / this.rate);
          }
          var oldPrice = selectedPack[0].skuVal.skuCalPrice * 191;
          oldPrice += (oldPrice + this.shippingCost) * 0.1;
          if (oldPrice <= 2000) {
            oldPrice = (oldPrice + this.shippingCost) * 0.1 + 400;
          } else {
            oldPrice = (oldPrice + this.shippingCost) * 0.1 + 200;
          }
          oldPrice = Math.ceil(oldPrice / 100) * 100;
          this.oldPrice = oldPrice;
          if (price <= 2000) {
            this.fee = (price + this.shippingCost) * 0.1 + 400;
          } else {
            this.fee = (price + this.shippingCost) * 0.1 + 200;
          }
          console.log("fee", this.fee);
          console.log("price before", price);
          price += this.fee;
          price = Math.ceil(price / 100) * 100;
          console.log("price after", price);
          this.chosenPrice = price;

          this.usdP = Number(selectedPack[0].skuVal.actSkuCalPrice);
        } else {
          var price = selectedPack[0].skuVal.skuAmount.value * this.rate;
          console.log("price 2", price / this.rate);
          if (price <= 2000) {
            this.fee = (price + this.shippingCost) * 0.1 + 400;
            console.log("price 2.1", price / this.rate);
          } else {
            this.fee = (price + this.shippingCost) * 0.1 + 200;
            console.log("price 2.2", price / this.rate);
          }
          price += this.fee;
          price = Math.ceil(price / 100) * 100;
          this.chosenPrice = price;

          this.usdP = Number(selectedPack[0].skuVal.skuCalPrice);
        }
      }
    },
    setMinMaxPrice: function () {
      console.log("activity", this.parsedScript.priceModule.activity);
      console.log("discountTips", this.parsedScript.priceModule.discountTips);
      if (
        this.parsedScript.priceModule.discountPromotion == true ||
        this.parsedScript.priceModule.discountTips.includes("-99%")
      ) {
        this.minPrice =
          this.parsedScript.priceModule.minAmount.value * this.rate;
        console.log("1", this.minPrice);
        this.minPrice = Math.ceil(this.minPrice / 100) * 100;
        console.log("2", this.minPrice);

        //price equals (price + shipping) * 0.1 + price
        if (this.minPrice <= 2000) {
          this.minPrice += (this.minPrice + this.shippingCost) * 0.1 + 400;
        } else {
          this.minPrice += (this.minPrice + this.shippingCost) * 0.1 + 200;
          console.log("3", this.minPrice);
        }

        this.minPrice = Math.ceil(this.minPrice / 100) * 100;
        console.log("4", this.minPrice);

        this.maxPrice =
          this.parsedScript.priceModule.maxAmount.value * this.rate;
        console.log("1", this.maxPrice);
        this.maxPrice = Math.ceil(this.maxPrice / 100) * 100;
        console.log("2", this.maxPrice);
        //price equals (price + shipping) * 0.1 + price
        if (this.maxPrice <= 2000) {
          this.maxPrice += (this.maxPrice + this.shippingCost) * 0.1 + 400;
        } else {
          this.maxPrice += (this.maxPrice + this.shippingCost) * 0.1 + 200;
          console.log("3", this.maxPrice);
        }
        this.maxPrice = Math.ceil(this.maxPrice / 100) * 100;
        console.log("4", this.maxPrice);
      } else if (
        this.parsedScript.priceModule.activity == true &&
        !this.parsedScript.priceModule.discountTips.includes("-99%")
      ) {
        if (this.parsedScript.priceModule.minActivityAmount.value <= 200) {
          this.minPrice = 200 * this.rate;
        } else {
          this.minPrice =
            this.parsedScript.priceModule.minActivityAmount.value * this.rate;
        }
        console.log("5", this.minPrice);
        //price equals (price + shipping) * 0.1 + price
        this.minPrice = Math.ceil(this.minPrice / 100) * 100;
        console.log("6", this.minPrice);
        if (this.minPrice <= 2000) {
          this.minPrice =
            this.minPrice + (this.minPrice + this.shippingCost) * 0.1 + 400;
          console.log("7.1", this.minPrice);
        } else {
          this.minPrice =
            this.minPrice + (this.minPrice + this.shippingCost) * 0.1 + 200;
          console.log("7.2", this.minPrice);
        }
        this.minPrice = Math.ceil(this.minPrice / 100) * 100;
        console.log("8", this.minPrice);

        this.maxPrice =
          this.parsedScript.priceModule.maxActivityAmount.value * this.rate;
        console.log("5", this.maxPrice);
        this.maxPrice = Math.ceil(this.maxPrice / 100) * 100;
        console.log("6", this.maxPrice);

        //price equals (price + shipping) * 0.1 + price
        if (this.maxPrice <= 2000) {
          this.maxPrice += (this.maxPrice + this.shippingCost) * 0.1 + 400;
          console.log("7.1", this.maxPrice);
        } else {
          this.maxPrice += (this.maxPrice + this.shippingCost) * 0.1 + 200;
          console.log("shippingcost", this.shippingCost);
          console.log("7.2", this.maxPrice);
        }
        this.maxPrice = Math.ceil(this.maxPrice / 100) * 100;
        console.log("8", this.maxPrice);

        var minOldPrice =
          this.parsedScript.priceModule.minAmount.value * this.rate;
        //price equals (price + shipping) * 0.1 + price
        if (minOldPrice <= 2000) {
          minOldPrice += (minOldPrice + this.shippingCost) * 0.1 + 400;
        } else {
          minOldPrice += (minOldPrice + this.shippingCost) * 0.1 + 200;
        }
        minOldPrice = Math.ceil(minOldPrice / 100) * 100;
        var maxOldPrice =
          this.parsedScript.priceModule.maxAmount.value * this.rate;
        //price equals (price + shipping) * 0.1 + price
        if (maxOldPrice <= 2000) {
          maxOldPrice += (maxOldPrice + this.shippingCost) * 0.1 + 400;
        } else {
          maxOldPrice += (maxOldPrice + this.shippingCost) * 0.1 + 200;
        }
        maxOldPrice = Math.ceil(maxOldPrice / 100) * 100;

        this.oldPrice = `${minOldPrice}DA - ${maxOldPrice}DA`;
      }

      if (this.minPrice == this.maxPrice) {
        this.equalPrice = this.minPrice;
        this.equalPrice = Math.ceil(this.minPrice / 100) * 100;
      }
    },
    addToCart: function () {
      this.addingToCart = true;
      axios
        .post(`api/addToCart/${this.userId}`, {
          title: this.title,
          totalSum: this.chosenPrice,
          selectedProps: JSON.stringify(this.selectedProps),
          user_id: this.$userId,
          uri: this.link,
          productId: this.productId,
          usdP: this.usdP,
          fee: this.fee,
          shippingCost: this.shippingCost,
          shippingTime: this.shippingTime,
        })
        .then((response) => {
          this.fields = {};
          this.fetchOrderItems();
          this.noOptions = false;
          this.addingToCart = false;
          this.addedToCart = true;
        })
        .catch((error) => {
          if (error.response.status == 404) {
            var container = document.getElementById("appContainer");
            window.scrollTo(0, container.scrollHeight + 150);
            this.addingToCart = false;
          } else if (error.response.status == 422) {
            this.noOptions = true;
            this.addingToCart = false;
          } else {
            console.log(error.response.status);
          }
        });
    },
    fetchOrderItems: function () {
      axios
        .get(`api/fetchOrderItems/${this.$userId}`)
        .then((response) => {
          this.orderItems = response.data;
        })
        .then(() => {
          this.setOrderItemsOptions();
        })
        .catch((error) => {
          if (error.response.status == 404) {
            this.orderItems = [];
          }
        });
    },
    setOrderItemsOptions: function () {
      this.orderItems.forEach((item) => {
        item.selectedProps = JSON.parse(item.selectedProps);
      });
    },
    deleteOrderItem: function (id) {
      axios
        .delete(`/api/deleteOrderItem/${id}`)
        .then((response) => {
          this.fetchOrderItems();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    addOrder: function () {
      axios
        .post(`/api/addOrder/${this.$userId}`)
        .then((response) => {
          window.location.href = "/account";
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>