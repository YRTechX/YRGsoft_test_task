<template>
    <div class="flex justify-between mb-2 gap-3">
        <h2 class="text-2xl">Cписок авторов</h2>
        <v-text-field
        density="compact"
        variant="solo"
        label="Поиск автора"
        append-inner-icon="mdi-magnify"
        single-line
        hide-details
        class="max-w-[500px] w-full"
        v-model="searchText"
      ></v-text-field>
        <my-button @click="setAddAuthorModal">Добавить автора</my-button>
    </div>
    <div class="" v-if="authorList.length">
        <my-author :key="index" v-for="(author, index) in filteredAuthors" :author="author"></my-author>
    </div>
    <div class="" v-else>
        <p class="text-xl">Авторов пока что нет</p>
    </div>
    <my-add-author-modal @onAddAuthor = "addAuthor" closable="true" ref="addAuthorModal"></my-add-author-modal>
    <my-delete-author-modal @onDeleteAuthor = "deleteAuthor" ref="deleteAuthorModal"></my-delete-author-modal>
    <my-edit-author-modal @onEditAuthor = "editAuthor" closable="true"></my-edit-author-modal>
</template>

<script>

import {mapMutations, mapState} from "vuex"
export default {

    name: 'my-author-list',
    data() {
        return {
            authorList: [],
            searchText: ''
        }
    },
    computed: mapState({
        idToDelete: state => state.authorToDelete,
        idToEdit: state => state.authorToEdit.id,
        filteredAuthors() {
            const normalizedSearchText = this.searchText.toLowerCase().trim();
            return this.authorList.filter(author =>
                author.first_name.toLowerCase().includes(normalizedSearchText) ||
                author.last_name.toLowerCase().includes(normalizedSearchText)
            );
        },
    }),
    methods: {
      ...mapMutations(['setAddAuthorModal', 'setDeleteAuthorModal', 'setEditAuthorModal', 'setLoading', 'setAuthorListObjects', 'setAuthorListArray']),
      async getAuthors(){
        this.setLoading()
        try {
            const response = await this.axios('/authors')
            const authors = response.data
            console.log(authors)
            this.authorList = authors
            const authorsArr = authors.map(author => `${author.first_name } ${author.last_name}`)
            this.setAuthorListObjects(authors)
            this.setAuthorListArray(authorsArr)
        } catch (error) {
            console.error(error)
        }
        this.setLoading()
      },
      async deleteAuthor(){
        this.setLoading()
        if(this.idToDelete){
            try {
                await this.axios.delete(`/authors/delete/${this.idToDelete}`)
                this.setDeleteAuthorModal()
                this.getAuthors()
            } catch (error) {
                this.$refs.deleteAuthorModal.setError()
            }
        }
        this.setLoading()
      },
      async addAuthor(data){
        this.setLoading()
        const authorData = JSON.stringify(data)
        try {
            await this.axios.post(`/authors/create`, authorData ,{
                headers: {
                    'Content-Type': 'application/json'
                }   
            })
            this.setAddAuthorModal()
            this.getAuthors()
            this.$refs.addAuthorModal.clearModels()

        } catch (error) {
            console.error(error)
        }
        this.setLoading()
      },
      async editAuthor(data){
        this.setLoading()
        const authorData = JSON.stringify(data)
        try {
            const response = await this.axios.post(`/authors/edit/${this.idToEdit}`, authorData ,{
                headers: {
                    'Content-Type': 'application/json'
                }   
            })
            this.setEditAuthorModal()
            this.getAuthors()
            const authors = response.data
            this.authorList = authors
        } catch (error) {
            console.error(error)
        }
        this.setLoading()
      },
    },
    mounted(){
        this.getAuthors()
    }
    
}
</script>
<style>
.shdw {
    box-shadow: 0px 2px 2px rgba(0,8,29,5%),0px 0px 2px rgba(0,8,29,6%),0px 1px 3px rgba(0,8,29,8%);
}
</style>
