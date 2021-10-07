<template>
<transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <slot name="header">
             <div slot="header" class="d-flex justify-content-between w-100">
          <h3>Mon Panier</h3>
          <button class="btn btn-primary px-3" @click="$emit('close')"><span class="fas fa-times"></span></button>
        </div>
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
              default body
            </slot>
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

  }
</script>

<style>
</style>