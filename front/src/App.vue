<template>
<div class="flex">
  <my-sidebar></my-sidebar>
  <div class="w-full p-3 lg:ml-[200px] ml-[50px] flex-1">
    <router-view></router-view>
  </div>
</div>
<my-loading></my-loading>
</template>

<script>
import {mapMutations} from "vuex"
export default {
  name: 'App',
  methods: {
    ...mapMutations(['setGenreListObjects', 'setGenreListArray', 'setAuthorListObjects', 'setAuthorListArray']),
    async getGenres(){
        try {
            const response = await this.axios('/genres')
            const genresObj = response.data
            const genresArr = genresObj.map(genre => genre.genre_name)
            this.setGenreListObjects(genresObj)
            this.setGenreListArray(genresArr)
        } catch (error) {
            console.error(error)
        }
      },
      async getAuthors(){
        try {
            const response = await this.axios('/authors')
            const authorsObj = response.data
            const authorsArr = authorsObj.map(author => `${author.first_name } ${author.last_name}`)
            this.setAuthorListObjects(authorsObj)
            this.setAuthorListArray(authorsArr)
        } catch (error) {
            console.error(error)
        }
      }
  },
  mounted() {
    this.getGenres()
    this.getAuthors()
  }
}
</script>

<style>
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
.shdw {
    box-shadow:  0px 3px 4px rgba(0,8,29,5%),0px 2px 4px rgba(0,8,29,6%),0px 1px 5px rgba(0,8,29,8%);
}
body {
  background-color: #FAFAFA;
}
</style>
