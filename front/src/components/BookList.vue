<template>
    <div class="flex justify-between mb-2">
        <h2 class="text-2xl">Cписок книг</h2>
        <div class="flex gap-3">
        <my-button class="hidden sm:block" @click="setFilters">Фильтры</my-button>
        <my-button @click="setAddBookModal">Добавить книгу</my-button>
        </div>
    </div>
    <div class="flex flex-wrap" v-if="bookListWithNames.length">
        <my-book :key="index" v-for="(book, index) in bookListWithNames" :book="book"></my-book>
    </div>
    <div class="flex flex-wrap" v-else>
        <p class="text-xl">Книг пока что нет</p>
    </div>
    <my-add-book-modal ref="addBookModal" closable="true" @onAddBook="addBook"></my-add-book-modal>
    <my-delete-book-modal @onDeleteBook="deleteBook"></my-delete-book-modal>
    <my-edit-book-modal closable="true" @onEditBook="editBook"></my-edit-book-modal>
    <my-filters @onFilters="getFilteredBooks"></my-filters>
    <Teleport to="body">
    <span class="fixed right-0 bottom-[20%] block sm:hidden border rounded-md cursor-pointer hover:scale-[1.05] transition" @click="setFilters">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
        </svg>
    </span>
    </Teleport>
</template>

<script>
import {mapMutations, mapState} from "vuex"
import {deleteImage} from "@/services/images"
export default {
    name: 'my-book-list',
    data() {
        return {
            bookList: []
        }
    },
    computed: {
        ...mapState(['genreListObjects', 'authorListObjects', 'bookToDelete', 'bookToEdit']),
        bookListWithNames() {
            return this.bookList.map((book) => ({
                ...book,
                genre: this.getGenreName(book.genre_id),
                author: this.getAuthorName(book.author_id),
            }));
        },
    },
    watch: {
        $route(){
            this.getBooks()
        }
    },
    methods: {
        ...mapMutations(['setAddBookModal', 'setDeleteBookModal', 'setEditBookModal', 'setLoading', 'setFilters']),
        getGenreName(genreId) {
            const genre = this.genreListObjects.find(genre => genre.id === genreId)
            return genre ? genre.genre_name : 'Unknown Genre'
        },
        getAuthorName(authorId) {
            const author = this.authorListObjects.find(author => author.id === authorId)
            return author ? `${author.first_name} ${author.last_name}` : 'Unknown Author'
        },
        async getFilteredBooks(filters){
            this.setLoading()
            try {
                let requestUrl = new URL(`${this.baseURL}books`)
                if(filters.genres.length){
                    requestUrl.searchParams.append('genreId', filters.genres.join(','))
                }
                if(filters.authors.length){
                    requestUrl.searchParams.append('authorId', filters.authors.join(','))
                }
                requestUrl = decodeURI(requestUrl.href).split("/api")[1]
                console.log(requestUrl)
                const response = await this.axios(requestUrl)
                const books = response.data
                this.bookList = books
            } catch (error) {
                console.error(error)
            }
            this.setLoading()
        },
        async getBooks(){
            this.setLoading()
            try {
                let requestUrl = '/books'
                if(this.$route.params.genreId){
                    requestUrl += `?genreId=${this.$route.params.genreId}`
                }
                const response = await this.axios(requestUrl)
                const books = response.data
                this.bookList = books
            } catch (error) {
                console.error(error)
            }
            this.setLoading()
        },
        async deleteBook(){
            this.setLoading()
            if(this.bookToDelete){
                try {
                    await this.axios.delete(`/books/delete/${this.bookToDelete.id}`)
                    if(this.bookToDelete.image_url !== 'https://firebasestorage.googleapis.com/v0/b/testtaskyrgsoft.appspot.com/o/missingbook.webp?alt=media&token=2473afd0-256d-47d5-9416-bda8c939de71'){
                        await deleteImage(this.bookToDelete.image_url)
                    }
                    this.setDeleteBookModal()
                    this.getBooks()
                } catch (error) {
                    console.error(error)
                }
            }
            this.setLoading()
        },
        async addBook(data){
            const bookData = JSON.stringify(data)
            try {
                await this.axios.post(`/books/create`, bookData ,{
                    headers: {
                        'Content-Type': 'application/json'
                    }   
                })
                this.setAddBookModal()
                this.$refs.addBookModal.clearModels()
                this.getBooks()
            } catch (error) {
                console.error(error)
            }
            this.setLoading()
        },
        async editBook(data){
            const bookData = JSON.stringify(data)
            try {
                await this.axios.post(`/books/edit/${this.bookToEdit.id}`, bookData ,{
                    headers: {
                        'Content-Type': 'application/json'
                    }   
                })
                this.setEditBookModal()
                this.getBooks()
            } catch (error) {
                console.error(error)
            }
            this.setLoading()
        },
    },
    mounted(){
        this.getBooks()
    }
}
</script>
<style>

</style>
