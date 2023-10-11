<template>
<Teleport to='body'>
  <div class="fixed top-0 bottom-0 left-0 right-0 bg-[#00000051] flex justify-center content-center flex-wrap" @click="setDeleteBookModal" v-if="isDeleteBookModal">
    <div class="bg-white p-4 relative" @click.stop>
      <span class="absolute top-0 right-0 block cursor-pointer" @click="setDeleteBookModal" v-if="$attrs.closable">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>

      </span>
      <div>
        <p class="text-2xl mb-4">Вы действительно хотите удалить книгу?</p>
        <div class="flex flex-wrap justify-around">
          <my-button @click="setDeleteBookModal">Нет</my-button>
          <my-button @click="$emit('onDeleteBook')">Да</my-button>
        </div>
      </div>
    </div>
  </div>
</Teleport>
</template>

<script>
import {mapState, mapMutations} from "vuex"
export default {
    name: 'my-delete-book-modal',
    props: {
      post: Object
    },
    data(){
        return {
            
        }
    },
    computed: mapState(['isDeleteBookModal']),
    methods: {
      ...mapMutations(['setDeleteBookModal'])
    },
}
</script>

<style>

</style>