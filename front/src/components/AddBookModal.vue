<template>
<Teleport to='body'>
  <div class="fixed top-0 bottom-0 left-0 right-0 bg-[#00000051] flex justify-center content-center flex-wrap" @click="setAddBookModal(); clearModels()" v-if="isAddBookModal">
    <div class="bg-white p-3 min-w-[250px] w-full h-full sm:h-auto sm:min-w-[400px] sm:w-auto min-h-[250px] relative" @click.stop>
      <span class="absolute top-0 right-0 block cursor-pointer" @click="setAddBookModal(); clearModels()" v-if="$attrs.closable">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>

      </span>
      <div>
        <p class="mb-3 text-2xl">Добавление книги</p>
        <v-text-field label="Название" variant="solo" density="compact" v-model.trim="title"></v-text-field>
        <v-select
          chips
          label="Автор"
          :items="authorListArray"
          v-model="author"
          variant="solo"
          density="compact"
        ></v-select>
        <v-text-field label="Год" type="number" variant="solo" density="compact" v-model.trim="year"></v-text-field>
        <v-select
          chips
          label="Жанр"
          :items="genreListArray"
          v-model="genre"
          variant="solo"
          density="compact"
        ></v-select>
        <v-file-input
          label="Выберите изображение"
          variant="solo"
          density="compact"
          prepend-icon="mdi-camera"
          v-model="image"
          accept="image/png, image/jpeg, image/bmp"
          @change="onImageChange"
        ></v-file-input>
        <v-alert
          color="error"
          variant="tonal"
          icon="$error"
          title="Ошибка!"
          text="Выберите фото в формате jpeg, png, gif"
          v-if="!isImageValid"
          class="mb-4"
        ></v-alert>
        <my-button class="float-right disabled:opacity-60 disabled:cursor-not-allowed" :disabled="!isValid" @click="onAddBook">Добавить</my-button>
      </div>
    </div>
  </div>
</Teleport>
</template>

<script>
import {mapState, mapMutations} from "vuex"
import { saveImage, checkType } from '@/services/images'
export default {
    name: 'my-add-book-modal',
    data(){
        return {
          title: '',
          year: '',
          author: [],
          genre: [],
          image: [],
          isImageValid: true,
        }
    },
    computed: {
        ...mapState(['isAddBookModal', 'genreListArray', 'authorListArray', 'genreListObjects', 'authorListObjects']),
        isValid(){
            return this.title !== '' &&
            this.year !== '' &&
            this.author.length &&
            this.genre.length &&
            this.isImageValid
        }
    },
    methods: {
        ...mapMutations(['setAddBookModal', 'setLoading']),
        onImageChange() {
            if (this.image.length) {
              const isImageValid = checkType(this.image[0])
              this.isImageValid = isImageValid
            } else {
              this.isImageValid = true
            }
        },
        async onAddBook(){
            this.setLoading()
            const bookObj = {
              title: this.capitalLetter(this.title),
              year_published: Number(this.year),
            }
            if(!this.image.length){
              bookObj.image_url = 'https://firebasestorage.googleapis.com/v0/b/testtaskyrgsoft.appspot.com/o/missingbook.webp?alt=media&token=2473afd0-256d-47d5-9416-bda8c939de71'
            } else {
              const link = await saveImage(this.image[0])
              bookObj.image_url = link
            }
            const genreId = this.genreListObjects.find((genreObj) => genreObj.genre_name == this.genre).id
            const authorId = this.authorListObjects.find((authorObj) => `${authorObj.first_name} ${authorObj.last_name}` == this.author).id
            bookObj.author_id = authorId
            bookObj.genre_id = genreId
            this.$emit('onAddBook', bookObj)
        },
        clearModels(){
            this.title = ''
            this.year = ''
            this.author = ''
            this.genre = ''
            this.image = []
            this.isImageValid = true
        }
    },
}
</script>

<style>

</style>