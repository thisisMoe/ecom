<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <slot name="header">
              <div slot="header" class="d-flex justify-content-between w-100">
                <h3 v-if="locale == 'fr'">Mon Panier</h3>
                <h3 v-if="locale == 'ar'">سلَتي</h3>
                <button
                  @click="$emit('close')"
                  class="btn btn-icon-only btn-primary"
                  type="button"
                  aria-label="Close Modal"
                  title="love button"
                >
                  <span aria-hidden="true" class="fas fa-times"></span>
                </button>
              </div>
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body"> default body </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              default footer
              <button class="modal-default-button" @click="$emit('close')">
                OK
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
export default {
  props: ['locale'],
};
</script>

<style>
</style>