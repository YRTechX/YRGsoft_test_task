<template>
<Teleport to='body'>
  <div class="fixed top-0 bottom-0 left-0 right-0 bg-[#00000051] flex justify-center content-center flex-wrap" @click="setEditAuthorModal" v-if="isEditAuthorModal">
    <div class="bg-white p-3 min-w-[250px] w-full h-full sm:max-h-[500px] sm:max-w-[500px] sm:h-auto  min-h-[250px] relative" @click.stop>
      <span class="absolute top-0 right-0 block cursor-pointer" @click="setEditAuthorModal" v-if="$attrs.closable">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </span>
      <div>
        <p class="mb-3 text-2xl">Редактирование автора</p>
        <v-text-field label="Имя" variant="solo" density="compact" v-model="name"></v-text-field>
        <v-text-field label="Фамилия" variant="solo" density="compact" v-model="surname"></v-text-field>
        <my-button class="float-right disabled:opacity-60 disabled:cursor-not-allowed" :disabled="!isChanged" @click="onEditAuthor">Редактировать</my-button>
      </div>
    </div>
  </div>
</Teleport>
</template>

<script>

import {mapState, mapMutations} from "vuex"
export default {
    name: 'my-edit-author-modal',
    props: {
      post: Object
    },
    data(){
        return {
            name: '',
            surname: '',
        }
    },
    computed: {
      ...mapState(['isEditAuthorModal', 'authorToEdit']),
      isChanged(){
        return (this.name && this.name !== this.authorToEdit.first_name) || (this.surname && this.surname !== this.authorToEdit.last_name)
      }
    },
    methods: {
      ...mapMutations(['setEditAuthorModal']),
      onEditAuthor(){
        this.$emit('onEditAuthor', {first_name: this.capitalLetter(this.name), last_name: this.capitalLetter(this.surname)})
      }
    },
    watch: {
        authorToEdit: {
            immediate: true, 
            handler(newValue) {
                this.name = newValue ? newValue.first_name : '';
                this.surname = newValue ? newValue.last_name : '';
            },
        },
    },
}
</script>

<style>

</style>