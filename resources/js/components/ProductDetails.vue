<template>
  <div id="appContainer">
    <!-- Preloader -->
    <!-- <div v-if="loading" class="">
      <div
        class="
          preloader
          bg-dark
          flex-column
          justify-content-center
          align-items-center
        "
      >
        <svg
          id="loader-logo"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          style="
            margin: auto;
            background: none;
            display: block;
            shape-rendering: auto;
          "
          width="200px"
          height="200px"
          viewBox="0 0 100 100"
          preserveAspectRatio="xMidYMid"
        >
          <path
            fill="none"
            stroke="#ffffff"
            stroke-width="8"
            stroke-dasharray="42.76482137044271 42.76482137044271"
            d="M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z"
            stroke-linecap="round"
            style="
              transform: scale(0.7100000000000001);
              transform-origin: 50px 50px;
            "
          >
            <animate
              attributeName="stroke-dashoffset"
              repeatCount="indefinite"
              dur="1.075268817204301s"
              keyTimes="0;1"
              values="0;256.58892822265625"
            ></animate>
          </path>
        </svg>
      </div>
    </div> -->

    <div v-if="!empty">
      <section class="pt-3">
        <div class="mx-auto" style="max-width: 1130px">
          <!-- Spinner -->
          <div
            v-if="loading"
            class="h-100vh d-flex flex-column justify-content-center align-items-center"
          >
            <div
              class="spinner-border"
              style="width: 5rem; height: 5rem; position: relative; top: -95px"
              role="status"
            >
              <span class="sr-only">Loading...</span>
            </div>
            <div class="text-center">
              <p>Recherche de produit...</p>
            </div>
          </div>
          <div v-else class="row justify-content-center mb-5 mb-lg-6">
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
                class="carousel slide mb-2"
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
              <hr class="my-4" />
              <div class="">
                <!-- if no chosen price -->
                <div class="text-center mb-4" v-if="!chosenPrice">
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
                    <span class="badge bg-danger ms-2 me-2"
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
                  <p class="mb-0" v-if="shippingCost">
                    <span v-if="this.$locale == 'ar'" class="fw-bold">تكاليف الشحن: </span>
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
                  <p class="mb-0" v-else>
                    <span class="fw-bold" v-if="this.$locale == 'ar'"
                      >تكاليف الشحن: سيتم التأكيد</span
                    >
                    <span v-else class="fw-bold"
                      >Frais de Livraison: A Confirmer</span
                    >
                  </p>
                  <p class="mb-0" v-if="shippingTime !== 'N/A'">
                    <span class="fw-bold" v-if="this.$locale == 'ar'"
                      >مدة الشحن: {{ shippingTime }} يوم
                    </span>
                    <span class="fw-bold" v-else
                      >Livraison: {{ shippingTime }} Jours.</span
                    >
                  </p>
                  <p class="mb-0" v-else>
                    <span v-if="this.$locale == 'ar'"
                      >مدة الشحن: سيتم التأكيد
                    </span>
                    <span v-else>Livraison: A Confirmer.</span>
                  </p>
                </div>
              </div>
              <div class="card shadow mb-4 mt-4">
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
                              item.propertyValueDisplayName
                            )
                          "
                        />
                        <label
                          v-html="item.propertyValueDisplayName"
                          class="btn btn-outline-primary btn-lg"
                          :for="item.propertyValueDisplayName"
                        ></label>
                      </div>
                    </div>
                    <!-- End of Radio -->
                  </fieldset>
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <form @submit.prevent="addToCart">
                  <button
                    class="btn btn-lg btn-primary fs-5 text-uppercase px-5 py-2"
                    type="submit"
                    :disabled="addingToCart"
                  >
                    <div v-if="!addingToCart" class="d-flex gap-2 align-items-center">
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
              <div class="d-flex justify-content-center mt-2">
                <span v-show="noOptions" class="text-small text-danger"
                  >Veuillez choisir vos options de produits avant de
                  continuer</span
                >
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
          top: calc(100vh - 120px);
          right: 2rem;
          z-index: 1055;
        "
      >
        <!-- <button id="show-modal" @click="showModal = true">Show Modal</button> -->
        <button
          id="showModal"
          style="box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1)"
          @click="showModal = true"
          target=""
          class="btn btn-tertiary position-relative"
        >
          <div style="">
            <i
              style="font-size: 2em"
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
                        <span
                          v-if="locale == 'fr'"
                          class="font-small"
                          >DA</span
                        >
                        <span
                          v-if="locale == 'ar'"
                          class="font-small"
                          >دج</span
                        >

                        <span class="fas fa-shipping-fast"></span>
                      </span>
                      <span class="d-block text-gray mt-3">
                        <strong>
                          <span
                            v-if="locale == 'fr'"
                            class=""
                            >Total:</span
                          >
                          <span
                            v-if="locale == 'ar'"
                            class=""
                            >المجموع:</span
                          >
                          {{ orderItem.shippingCost + orderItem.totalSum }}
                          <span
                            v-if="locale == 'fr'"
                            class="font-small"
                            >DA</span
                          >
                          <span
                            v-if="locale == 'ar'"
                            class="font-small"
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
            هنا سترون تفاصيل المنتج ، مباشرة بعد لصق أو نسخ رابط المنتج المنشود من AliExpress في
            شريط البحث أعلاه
          </span>
          <footer class="mt-3 text-primary">
            <img
              src="/assets/img/lamp-icon.png"
              style="max-width: 150px"
              alt="Lamp Icon"
            />
          </footer>
        </blockquote>
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
    };
  },
  mounted() {
    this.loadInfo();
    this.fetchOrderItems();
  },
  created() {
    console.log("created", this.$locale);
  },
  updated() {
    var image = new Image();
    image.src = this.images[0];
    image.onload = () => {
      this.imagesLoaded = true;
    };
  },
  methods: {
    loadInfo: function () {

      if(this.uri == '') {
        return this.empty = true;
      }
      axios
        .get("/api/info", { params: { q: this.uri, locale: this.$locale } })
        .then((response) => {
          console.log(response.data);
          this.images = response.data.images;
          this.script = response.data.script;
          this.shippingCost = Number(response.data.shippingCost) * 185;
          this.shippingCost = Math.ceil(this.shippingCost / 10) * 10;
          if (response.data.shippingTime) {
            this.shippingTime = response.data.shippingTime;
          }
          console.log("shipping cost", this.shippingCost);
          console.log("shipping time", this.shippingTime);
          // console.log(document.getElementsByClassName('carousel-item active')[0].childNodes[0].currentSrc);
        })
        .then(() => {
          var cleanedScript = this.getStringBetween(
            this.script,
            "data: ",
            ", csrfToken:"
          );
          this.parsedScript = JSON.parse(cleanedScript);
          // this.parsedScript = JSON.parse(this.script);
          // console.log(this.script)
          console.log(this.parsedScript);

          this.title = this.parsedScript.titleModule.subject;
          this.productId = this.parsedScript.commonModule.productId;
          console.log(this.productId);

          this.discount = this.parsedScript.priceModule.discount;
          console.log("isDiscount", this.discount);

          // const options = JSON.parse(
          //   this.getStringBetween(
          //     this.script,
          //     'productSKUPropertyList":',
          //     ',"skuPriceList"'
          //   )
          // );
          // this.options = options;
          this.options = this.parsedScript.skuModule.productSKUPropertyList;
        })
        .then(() => {
          this.loading = false;
        })
        .then(() => {
          this.setMinMaxPrice();
        })
        .catch((err) => {
          if (err.response.status == 500) {
            this.empty = true;
          }
          console.log(err.response.status);
          console.log(err.response);
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
    setPropsId: function (e, propName, numberOfOptions, selectedPropertyName) {
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
      console.log("selectedProps", this.selectedProps);
      this.setPropsIdString();
      this.setChosenPrice();
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
      console.log("propsIdString", this.propsIdString);
    },
    setChosenPrice: function () {
      var selectedPack = this.parsedScript.skuModule.skuPriceList.filter(
        (item) => {
          return item.skuPropIds == this.propsIdString;
        }
      );
      if (selectedPack.length) {
        if (selectedPack[0].skuVal.actSkuCalPrice) {
          console.log(selectedPack);
          var price = selectedPack[0].skuVal.actSkuCalPrice * 185;
          price = Math.ceil(price / 100) * 100;
          var oldPrice = selectedPack[0].skuVal.skuCalPrice * 185;
          oldPrice = Math.ceil(oldPrice / 10) * 10;
          this.oldPrice = oldPrice;
          console.log("oldPrice:", oldPrice);
          this.chosenPrice = price;
          //checking
          if (this.chosenPrice <= 2000) {
            this.fee = 400;
            this.fee = Math.ceil(this.fee / 100) * 100;
            console.log("fee: ", this.fee);
            this.firstPrice = this.chosenPrice;
            console.log("First Price: ", this.firstPrice);
            this.chosenPrice += this.fee;
          } else if (this.chosenPrice > 2000) {
            this.fee = this.chosenPrice * 0.08 + 400;
            this.fee = Math.ceil(this.fee / 100) * 100;
            console.log("fee: ", this.fee);
            this.firstPrice = this.chosenPrice;
            console.log("First Price:", this.firstPrice);
            this.chosenPrice += this.fee;
          }
          this.usdP = Number(selectedPack[0].skuVal.actSkuCalPrice);
          console.log("usdP", this.usdP);
        } else if (selectedPack[0].skuVal.skuCalPrice) {
          var price = selectedPack[0].skuVal.skuCalPrice * 185;
          price = Math.ceil(price / 100) * 100;
          this.chosenPrice = price;
          //checking
          if (this.chosenPrice <= 2000) {
            this.fee = 400;
            this.fee = Math.ceil(this.fee / 100) * 100;
            console.log("fee: ", this.fee);
            this.firstPrice = this.chosenPrice;
            console.log("First Price: ", this.firstPrice);
            this.chosenPrice += this.fee;
          } else if (this.chosenPrice > 2000) {
            this.fee = this.chosenPrice * 0.08 + 400;
            this.fee = Math.ceil(this.fee / 100) * 100;
            console.log("fee: ", this.fee);
            this.firstPrice = this.chosenPrice;
            console.log("First Price:", this.firstPrice);
            this.chosenPrice += this.fee;
          }
          this.usdP = Number(selectedPack[0].skuVal.skuCalPrice);
          console.log("usdP", this.usdP);
        }
      }
      console.log("chosen price", this.chosenPrice);
    },
    setMinMaxPrice: function () {
      this.parsedScript.skuModule.skuPriceList.forEach((item, index) => {
        console.log("item.skuVal.actSkuCalPrice: ", item.skuVal.actSkuCalPrice);
        // if no promotion
        if (!item.skuVal.actSkuCalPrice) {
          var price = Number(item.skuVal.skuCalPrice) * 185;
          console.log("price:", price);

          if (index == 0) {
            console.log("when index == 0");
            this.minPrice = price;
            console.log("minPrice:", this.minPrice);
            this.maxPrice = price;
            console.log("maxPrice:", this.maxPrice);
          } else {
            console.log("index is > 0");
            if (price < this.minPrice) {
              this.minPrice = price;
              console.log("minPrice:", this.minPrice);
              console.log("maxPrice:", this.maxPrice);
            } else if (price > this.maxPrice) {
              this.maxPrice = price;
              console.log("minPrice:", this.minPrice);
              console.log("maxPrice:", this.maxPrice);
            }
          }
        } else if (item.skuVal.actSkuCalPrice) {
          // if promotion
          var price = Number(item.skuVal.actSkuCalPrice) * 185;
          var oldPrice = Number(item.skuVal.skuCalPrice) * 185;
          var oldPrice = Math.ceil(oldPrice / 100) * 100;
          console.log("oldPrice:", oldPrice);
          // price = Math.ceil(price/100)*100
          console.log("price:", price);
          if (index == 0) {
            console.log("when index == 0");
            this.minPrice = price;
            console.log("minPrice:", this.minPrice);
            this.maxPrice = price;
            console.log("maxPrice:", this.maxPrice);
          } else {
            console.log("index is > 0");
            if (price < this.minPrice) {
              this.minPrice = price;
              console.log("minPrice:", this.minPrice);
              console.log("maxPrice:", this.maxPrice);
            } else if (price > this.maxPrice) {
              this.maxPrice = price;
              console.log("minPrice:", this.minPrice);
              console.log("maxPrice:", this.maxPrice);
            }
          }
        }
      });

      if (this.minPrice == this.maxPrice) {
        this.equalPrice = this.minPrice;
        this.equalPrice = Math.ceil(this.minPrice / 100) * 100;
        //checking
        if (this.equalPrice <= 2000) {
          this.fee = 400;
          this.fee = Math.ceil(this.fee / 100) * 100;
          this.equalPrice += this.fee;
        } else if (this.equalPrice > 2000) {
          this.fee = this.equalPrice * 0.08 + 400;
          this.fee = Math.ceil(this.fee / 100) * 100;
          this.equalPrice += this.fee;
        }
        console.log("equalPrice", this.equalPrice);
      }

      //checking
      if (this.minPrice <= 2000) {
        this.minPrice = Math.ceil(this.maxPrice / 100) * 100;
        this.minPrice = this.minPrice + 400;
      } else if (this.minPrice > 2000) {
        this.minPrice += 400 + this.minPrice * 0.08; //400da + 8% of price
        this.minPrice = Math.ceil(this.minPrice / 100) * 100;
      }

      if (this.maxPrice <= 2000) {
        this.maxPrice = Math.ceil(this.maxPrice / 100) * 100;
        this.maxPrice = this.maxPrice + 400;
      } else if (this.maxPrice > 2000) {
        this.maxPrice += 400 + this.maxPrice * 0.08; //400da + 8% of price
        this.maxPrice = Math.ceil(this.maxPrice / 100) * 100;
      }
      this.minPrice += 100;
      this.maxPrice += 100;
      this.minPrice = new Intl.NumberFormat().format(Math.round(this.minPrice));
      this.maxPrice = new Intl.NumberFormat().format(Math.round(this.maxPrice));
    },
    addToCart: function () {
      this.addingToCart = true;
      axios
        .post(`api/addToCart/${this.userId}`, {
          title: this.title,
          totalSum: this.chosenPrice,
          selectedProps: JSON.stringify(this.selectedProps),
          user_id: this.$userId,
          uri: this.uri,
          productId: this.productId,
          usdP: this.usdP,
          fee: this.fee,
          shippingCost: this.shippingCost,
          shippingTime: this.shippingTime,
        })
        .then((response) => {
          this.fields = {}; //Clear input fields.
          console.log("added to cart");
          this.fetchOrderItems();
          this.noOptions = false;
          this.addingToCart = false;
        })
        .catch((error) => {
          if (error.response.status == 404) {
            //SCroll to signup/signin if not authenticated
            var container = document.getElementById("appContainer");
            window.scrollTo(0, container.scrollHeight + 150);
            this.addingToCart = false
          } else if (error.response.status == 422) {
            this.noOptions = true;
            this.addingToCart = false
          } else {
            console.log(error.response.status);
          }
        });
    },
    fetchOrderItems: function () {
      axios
        .get(`api/fetchOrderItems/${this.$userId}`)
        .then((response) => {
          console.log("fetch", response.data);
          this.orderItems = response.data;
        })
        .then(() => {
          this.setOrderItemsOptions();
        })
        .catch((error) => {
          if (error.response.status == 404) {
            this.orderItems = [];
            console.log("Please register or login to make an order");
            console.log(
              "Veuillez vous inscrire ou vous connecter pour passer une commande"
            );
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
          console.log(response.data);
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
          console.log("=====Order======", response.data);
          this.fetchOrderItems();
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