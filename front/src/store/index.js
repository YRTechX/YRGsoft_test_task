const store = {
    state: {
        isAddBookModal: false,
        isEditBookModal: false,
        isDeleteBookModal: false,
        isAddAuthorModal: false,
        isEditAuthorModal: false,
        isDeleteAuthorModal: false,
        authorToDelete: 0,
        authorToEdit: '',
        isLoading: false,
        genreListObjects: [],
        genreListArray: [],
        authorListObjects: [],
        authorListArray: [],
        bookToDelete: '',
        bookToEdit: '',
        isFilters: false
    },
    mutations: {
        setAddBookModal(state){
            state.isAddBookModal = !state.isAddBookModal
        },
        setEditBookModal(state, book){
            if(state.isEditBookModal){
                state.bookToEdit = ''
            } else {
                state.bookToEdit = book
            }
            state.isEditBookModal = !state.isEditBookModal
        },
        setDeleteBookModal(state, book){
            if(state.isDeleteBookModal){
                state.bookToDelete = ''
            } else {
                state.bookToDelete = book
            }
            state.isDeleteBookModal = !state.isDeleteBookModal
        },
        setAddAuthorModal(state){
            state.isAddAuthorModal = !state.isAddAuthorModal
        },
        setEditAuthorModal(state, author){
            if(state.isEditAuthorModal){
                state.authorToEdit = ''
            } else {
                state.authorToEdit = author
            }
            state.isEditAuthorModal = !state.isEditAuthorModal
        },
        setDeleteAuthorModal(state, id){
            if(state.isDeleteAuthorModal){
                state.authorToDelete = 0
            } else {
                state.authorToDelete = id
            }
            state.isDeleteAuthorModal = !state.isDeleteAuthorModal
        },
        setLoading(state){
            state.isLoading = !state.isLoading
        },
        setGenreListObjects(state, genresObj){
            state.genreListObjects = genresObj
        },
        setGenreListArray(state, genresArr){
            state.genreListArray = genresArr
        },
        setAuthorListObjects(state, authorObj){
            state.authorListObjects = authorObj
        },
        setAuthorListArray(state, authorArr){
            state.authorListArray = authorArr
        },
        setFilters(state){
            state.isFilters = !state.isFilters
        }
    },
    actions: {

    }
}
export default store