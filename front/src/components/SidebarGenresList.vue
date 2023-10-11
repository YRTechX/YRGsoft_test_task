<template>
<Transition name="slide-fade">
    <ul v-if="isOpened" class="pl-4 mt-1">
        <li class="hover:bg-slate-100 cursor-pointer transition ease-in-out" :key={index} v-for="(genre, index) in genreListObjects" @click="toggleGenres(); $router.push(`/books/${genre.id}`)">{{genre.genre_name}}</li>
    </ul>
</Transition>
</template>

<script>
import {mapState} from "vuex"
export default {
    name: 'my-sidebar-genres-list',
    data() {
        return {
            isOpened: false,
            //genres: ["Ужасы", 'Триллеры', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика', 'Фантастика']
        }
    },
    computed: {
        ...mapState(['genreListArray', 'genreListObjects'])
    },
    methods: {
        toggleGenres(e){
            this.isOpened = !this.isOpened
            this.$emit('updateState', this.isOpened)
            if(e){
                this.$emit('toggleGenres')
            }
            
        }
    }
}
</script>
<style>
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(-10px);
  opacity: 0;
}
</style>
