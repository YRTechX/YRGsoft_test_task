<template>
    <div class="p-1 top:0 left:0 h-screen bg-white shdw flex flex-col flex-wrap fixed lg:w-[200px]" :class="{'min-[481px]:w-[200px]': isOpened, 'max-[480px]:w-screen': isOpened }">
        <div class="content-center pt-1 pb-2 border-b flex flex-wrap lg:hidden">
            <button class="border p-1 rounded-md" @click="toggleNav">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="pt-2 hidden lg:block pl-3 pr-3" :class="{'!block' : isOpened}">
            <ul>
                <router-link to="/" @click="toggleNav"><li class="leading-10 cursor-pointer transition ease-in-out hover:bg-slate-100">Книги</li></router-link>
                <router-link to="/authors" @click="toggleNav"><li class="leading-10 cursor-pointer transition ease-in-out hover:bg-slate-100">Авторы</li></router-link>
                <li class="leading-10 cursor-pointer transition ease-in-out hover:bg-slate-100 flex justify-between" @click="$refs.sidebarGenresList.toggleGenres()">Жанры 
                    <div class="flex content-center justify-center flex-wrap" v-if="!isGenresListOpened">
                        <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                    <div class="flex content-center justify-center flex-wrap" v-else>
                        <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>  
                    </div>
                </li>
            </ul>
            <my-sidebar-genres-list @updateState="updateStateGenresList" @toggleGenres="toggleNav"  ref="sidebarGenresList"></my-sidebar-genres-list>
        </div>
    </div>
</template>

<script>

export default {
    name: 'my-sidebar',
    data() {
        return {
            isOpened: false,
            isGenresListOpened: false
        }
    },
    methods: {
        toggleNav(){
            console.log('toggleNav')
            this.isOpened = !this.isOpened
        },
        updateStateGenresList(isOpened){
            this.isGenresListOpened = isOpened
        }
    }
}
</script>
<style>
</style>
