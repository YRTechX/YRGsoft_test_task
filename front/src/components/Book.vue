<template>
    <div class="shdw p-2 bg-white w-[calc(50%-8px)] md:w-[calc(33.3333%-8px)] lg:w-[calc(25%-8px)] xl:w-[calc(20%-8px)] m-1 flex flex-col">
        <div class="flex-1">
            <img class="h-full w-full object-cover" :src="book.image_url"/>
        </div>
        <p class=" leading-6">{{book.title}}</p>
        <p class="text-[#707783] text-xs leading-6">{{book.author}}</p>
        <p class="text-sm leading-6">{{book.genre}}</p>
        <p class="text-sm leading-6">{{book.year_published}}</p>
        <div class="gap-1 flex flex-wrap justify-between">
            <my-button @click="setEditBookModal(book)">Редактировать</my-button>
            <my-button @click="setDeleteBookModal(book)">Удалить</my-button>
        </div>
    </div>
</template>

<script>
import {mapState, mapMutations} from "vuex"
export default {
    name: 'my-book',
    props: {
        book: Object
    },
    data() {
        return {

        }
    },
    computed: {
      ...mapState(['isAddBookModal', 'genreListArray', 'authorListArray', 'genreListObjects', 'authorListObjects']),  
    },
    methods: {
        ...mapMutations(['setEditBookModal', 'setDeleteBookModal']),
    }
}
</script>
<style>

</style>
