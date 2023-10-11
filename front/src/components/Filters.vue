<template>
    <v-overlay v-model="isFilters" class="flex justify-end" @click="setFilters">
        <div class="w-screen min-h-screen sm:w-[400px] p-3 pl-6 bg-white relative" @click.stop>
            <span class="absolute top-0 right-0 block cursor-pointer" @click="setFilters">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
            <div class="gap-5">
                <p class="mb-4 text-center">Фильтры</p>
                <v-select
                label="Авторы"
                :items="authorListObjects"
                v-model="filterAuthors"
                variant="solo"
                density="compact"
                clearable
                multiple
                item-value="id"
                item-title="first_name"
                class="min-w-[150px] !text-xs"
                >
                 <template v-slot:item="{ props, item }">
                    <v-list-item v-bind="props" :subtitle="item.raw.last_name"></v-list-item>
                </template>
                </v-select>
                <v-select
                label="Жанры"
                :items="genreListObjects"
                v-model="filterGenres"
                variant="solo"
                density="compact"
                multiple
                clearable
                class="min-w-[120px]"
                item-title="genre_name"
                item-value="id"
                ></v-select>
                <my-button class="float-right" @click="onFilters(); setFilters()">Показать</my-button>
            </div>
        </div>
    </v-overlay>
</template>

<script>
import { mapState, mapMutations } from 'vuex'
export default {
    name: 'my-filters',
    props: {

    },
    data(){
        return {
            filterAuthors: [],
            filterGenres: []
        }
    },
    computed: {
        ...mapState(['authorListObjects', 'genreListObjects', 'isFilters']),
    },
    methods: {
        ...mapMutations(['setFilters']),
        onFilters(){
            this.$emit('onFilters', {authors: this.filterAuthors, genres: this.filterGenres})
        },
        clearModels(){
            this.filterAuthors = [],
            this.filterGenres = []
        }
    },
    watch: {
        $route(){
            this.clearModels()
        }
    }
}
</script>

<style>

</style>