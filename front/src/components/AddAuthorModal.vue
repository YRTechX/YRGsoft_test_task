<template>
<Teleport to='body'>
  <div class="fixed top-0 bottom-0 left-0 right-0 bg-[#00000051] flex justify-center content-center flex-wrap" @click="setAddAuthorModal(); clearModels()" v-if="isAddAuthorModal">
    <div class="bg-white p-3 min-w-[350px] w-full h-full sm:max-h-[500px] sm:max-w-[500px] sm:w-auto sm:h-auto min-h-[250px] relative" @click.stop>
      <span class="absolute top-0 right-0 block cursor-pointer" @click="setAddAuthorModal(); clearModels()" v-if="$attrs.closable">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>

      </span>
      <div>
        <p class="mb-3 text-2xl">Добавление автора</p>
        <v-text-field label="Имя" variant="solo" density="compact" v-model.trim="name" :rules="[() => !!name || 'Заполните это поле']"></v-text-field>
        <v-text-field label="Фамилия" variant="solo" density="compact" v-model.trim="surname" :rules="[() => !!surname || 'Заполните это поле']"></v-text-field>
        <my-button class="float-right disabled:opacity-60 disabled:cursor-not-allowed" :disabled="!isValid" @click="onAddAuthor">Добавить</my-button>
      </div>
    </div>
  </div>
</Teleport>
</template>

<script>
import {mapState, mapMutations} from "vuex"
export default {

    
    name: 'my-add-author-modal',
    data(){
        return {
            name: '',
            surname: '',
        }
    },
    computed: {
      ...mapState(['isAddAuthorModal']),
      isValid(){
        return this.name !== '' && this.surname !== ''
      }
    },
    
    methods: {
      ...mapMutations(['setAddAuthorModal']),
      onAddAuthor(){
          this.$emit('onAddAuthor', {first_name: this.capitalLetter(this.name), last_name: this.capitalLetter(this.surname)})
      },
      clearModels(){
        this.name = ''
        this.surname = ''
      }
    },
}
</script>

<style>

</style>